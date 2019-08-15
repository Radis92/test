<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_karyawan = \App\Karyawan::where('nama_depan', 'LIKE', '%' . $request->cari . '%')->get();
        } else {
            $data_karyawan = \App\Karyawan::all();
        }
        return view('karyawan.index', ['data_karyawan' => $data_karyawan]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_depan' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'jenis_keklamin' => 'required',
            'agama' => 'required',
            'avatar' => 'mimes: jpg,png'
        ]);
        // insert ke table users
        $user = new \App\User;
        $user->role = 'karyawan';
        $user->name = $request->nama_depan;
        $user->email = $request->email;
        $user->password = bcrypt("rahasia");
        $user->remember_token = str_random(60);
        $user->save();

        // insert table karyawan
        $request->request->add(['user_id' => $user->id]);
        $karyawan = \App\Karyawan::create($request->all());
        $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
        $karyawan->avatar = $request->file('avatar')->getClientOriginalName();
        $karyawan->save();
        return redirect('/karyawan')->with('sukses', 'Berhasil !');
    }
    public function edit($id)
    {
        $karyawan = \App\Karyawan::find($id);
        return view('karyawan/edit', ['karyawan' => $karyawan]);
    }

    public function update(request $request, $id)
    {
        // dd($request->all());
        $karyawan = \App\Karyawan::find($id);
        $karyawan->update($request->all());
        if ($request->hasFile('avatar')) {
            $request->file('avatar')->move('images/', $request->file('avatar')->getClientOriginalName());
            $karyawan->avatar = $request->file('avatar')->getClientOriginalName();
            $karyawan->save();
        }
        return redirect('/karyawan')->with('sukses', 'Data Berhasil di update');
    }

    public function delete($id)
    {
        $karyawan = \App\Karyawan::find($id);
        $karyawan->delete();
        return redirect('/karyawan')->with('sukses', 'Data Berhasil di hapus');
    }

    public function profile($id)
    {
        $matapelajaran = \App\Mapel::all();
        $karyawan = \App\Karyawan::find($id);
        // data chart
        $catagories = [];
        $data = [];
        foreach ($matapelajaran as $mp) {
            if($karyawan->mapel()->wherePivot('mapel_id', $mp->id)->first()){
                $catagories[] = $mp->nama;
                $data[] = $karyawan->mapel()->wherePivot('mapel_id', $mp->id)->first()->pivot->nilai;
            }  
        }
        //  dd($data);

        return view('karyawan.profile', ['karyawan' => $karyawan, 'matapelajaran' => $matapelajaran, 'categories' => $catagories, 'data' => $data]);
    }

    public function addnilai(Request $request, $idkaryawan)
    {
        $karyawan = \App\Karyawan::find($idkaryawan);
        if ($karyawan->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('karyawan/' . $idkaryawan . '/profile')->with('error', 'Data Sudah ada');
        }
        $karyawan->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('karyawan/' . $idkaryawan . '/profile')->with('sukses', 'Data Berhasil Di Input');
    }
}
