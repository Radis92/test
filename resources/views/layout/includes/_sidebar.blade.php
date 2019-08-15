<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="/dashboard" class="active"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                @if(auth()->user()->role=='admin')
                <li><a href="/karyawan" class=""><i class="lnr lnr-user"></i> <span>Karyawan</span></a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>

{{-- <div id="sidebar-nav" class="sidebar">
 <div class="sidebar-scroll">
   <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Inventaris</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../index.html"><i class="fa fa-file-code-o"></i> Jenis</a></li>
            <li><a href="../../index2.html"><i class="fa fa-bookmark-o"></i> Ruang</a></li>
          </ul>
        </li>

        <li>
          <a href="../mailbox/mailbox.html">
            <i class="fa fa-user">
            </i> <span>Pegawai</span>
          </a>
       </li>

       <li>
            <a href="../mailbox/mailbox.html">
              <i class="fa fa-google-wallet">
              </i> <span>Pinjaman</span>
            </a>
         </li>
    </div>
</div> --}}