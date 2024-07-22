<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset("storage/picture_profile/".auth()->user()->imageUrl) }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{auth()->user()->nama}}
                            <span class="user-level">{{auth()->user()->level}}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                @if (Route::currentRouteName() == 'admin-dashboard')
                    {{ $dashboard_status = 'active'}}
                @else
                    {{ $dashboard_status = 'inactive'}}
                @endif
                <li class="nav-item {{ $dashboard_status }}">
                    <a  href="{{ route('admin-dashboard') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data Master</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base" class="nav-links">
                        <i class="fas fa-user"></i>
                        <p>Data Pengguna</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('admin-management-users', ['level'=>'Admin'])}}">
                                    <span class="sub-item">Admin</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin-management-users', ['level'=>'Kepala Puskesmas'])}}">
                                    <span class="sub-item">Kepala Puskesmas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin-management-users', ['level'=>'Petugas UKM'])}}">
                                    <span class="sub-item">Petugas UKM</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a  href="{{ route('desa.index') }}" aria-expanded="false">
                        <i class="fas fa-location-arrow"></i>
                        <p>Desa</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a  href="{{ route('desa.index') }}" aria-expanded="false">
                        <i class="fas fa-pen"></i>
                        <p>Akses Petugas UKM</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Data UKM</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base2" class="nav-link active">
                        <i class="fas fa-th"></i>
                        <p>UKM Puskesmas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base2">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('ukm-essensial.index') }}">
                                    <span class="sub-item">UKM Essensial</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">UKM Pengembangan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a  href="{{route('logout')}}" aria-expanded="false">
                        <i class="fas fa-power-off"></i>
                        <p>Keluar</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->