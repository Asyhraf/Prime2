<!-- Header-->
<header id="header" class="header" style="background-image: url('{{asset('landpage/images/banner3.jpg') }} '); background-repeat: no-repeat; background-size: cover;">
    <div class="header-menu">
        <div class="col-4">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
            <h5 class="font-weight-bold" >APLIKASI PRIME 2.0 </h5>
        </div>

        <div class="col-8">
            <div class="dropdown-user user-area" style="margin-top: 0.6rem;">
                <h7><b>Selamat datang, {{ Auth::user()->name }} </b></h7>
                <div class="dropdown-content">
                    <ul>
                        <li style="margin-top: 0.5rem;">
                            <a class="dropdown-item" href="#">
                                <i class="menu-icon fa fa-user"></i>&nbsp;&nbsp;{{ Auth::user()->Unit->nama_unit }} </a>
                        </li>
                        <hr class="dropdown-divider">
                        @if (Route::has('password.request'))
                        <li>
                            <a class="dropdown-item" href="{{ route('edit-password-pengguna', Auth::user()->id) }}">
                                <i class="menu-icon fa fa-key"></i>&nbsp;&nbsp;<span>{{ __('Tukar Kata Laluan') }}</span></a>
                        </li>
                        @endif
                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="menu-icon fa fa-sign-out"></i>&nbsp;&nbsp;<span>{{ __('Log Keluar') }}</span></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Header Ends  -->
