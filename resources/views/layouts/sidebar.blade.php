<!-- add the php code cus dont know where to put in the controller -->
@php
$user_role_pengguna= DB::table('user_role_pengguna')
->join('users', 'users.id', '=', 'user_role_pengguna.id_user')
->where('user_role_pengguna.id_user','=',Auth::user()->id)
->get();
@endphp

<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}"><img width="30%" src="{{ asset('landpage/images/logo.png') }}" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="{{ asset('landpage/images/logo2.png') }}" alt="Logo"></a><br>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="active">
                    <a href="{{ route('home') }}"><i class="menu-icon fa fa-home"></i> Laman Utama </a>
                </li>

                <!-- Pengurusan Mesyuarat -->
                <h3 class="menu-title">Pengurusan Mesyuarat</h3><!-- /.menu-title -->
                <!-- Mesyuarat -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-calendar-o"></i>Mesyuarat</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('p_carianAhliMesyuarat') }}">Selenggara Ahli Mesyuarat</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_tambah') }}">Selenggara Mesyuarat & Aktiviti</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_PanggilanMesyuarat') }}">Panggilan Mesyuarat</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('p_pengurusanMesyuarat') }}">Senarai Mesyuarat & Aktiviti</a></li>
                    </ul>
                </li>

                <!-- Templat Dokumen -->
                @forelse ($user_role_pengguna as $counter2 => $role_pengguna)
                @if ($role_pengguna->id_user == Auth::user()->id && $role_pengguna->id_peranan == 2)
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-folder"></i>Templat Dokumen</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_NotisMesyuarat') }}">Notis Panggilan</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_PindaanTarikh') }}">Notis Pindaan</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_EdaranDokumen') }}">Surat Edaran Dokumen </a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_EdaranMinit') }}">Surat Edaran Minit </a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_AgendaMesyuarat') }}">Agenda Mesyuarat</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('p_CetakanPilihan') }}">Pilihan Mesyuarat</a></li>
                        {{-- <li><i class="fa fa-list-ul"></i><a href="{{ route('p_KawalanDokumen') }}">Kawalan Dokumen</a></li> --}}
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('p_StickerAlamat') }}">Sticker Alamat</a></li>
                    </ul>
                </li>
                @endif
                @empty
                @endforelse

                <!-- Kehadiran -->
                @forelse ($user_role_pengguna as $counter2 => $role_pengguna)
                @if ($role_pengguna->id_user == Auth::user()->id && $role_pengguna->id_peranan == 2)
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-id-badge"></i>Kehadiran</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('m_pengesahan') }}">Pengesahan Kehadiran</a></li>
                        <!-- <li><i class="fa fa-list-ul"></i><a href="{{ route('m_QRPapar') }}">Pengesahan Kehadiran QR Code</a></li> -->
                    </ul>
                </li>
                @endif
                @empty
                @endforelse

                <!-- Tetapan & Rujukan -->
                @forelse ($user_role_pengguna as $counter2 => $role_pengguna)
                @if ($role_pengguna->id_user == Auth::user()->id && $role_pengguna->id_peranan == 1)
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-cogs"></i>Tetapan & Rujukan</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('p_pengurusanJawatan') }}">Pengurusan Jawatan</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('p_pengurusanKementerian') }}">Pengurusan Kementerian</a></li>
                    </ul>
                </li>
                @endif
                @empty
                @endforelse

                <!-- Pelaporan Mesyuarat -->
                <h3 class="menu-title">Pelaporan Mesyuarat</h3><!-- /.menu-title -->
                <!-- Laporan -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="menu-icon fa fa-file"></i>Laporan</a>
                    <ul class="sub-menu children dropdown-menu">
                        @forelse ($user_role_pengguna as $counter2 => $role_pengguna)
                        @if ($role_pengguna->id_user == Auth::user()->id && $role_pengguna->id_peranan == 2)
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('lap_Susunan') }}">Senarai Tempat Duduk Ahli Mesyuarat</a></li>
                        <li><i class="fa fa-list-ul"></i><a href="{{ route('lap_Statistik') }}">Statistik Kehadiran Ahli Mesyuarat</a></li>
                        @endif
                        @empty
                        @endforelse
                        @forelse ($user_role_pengguna as $counter2 => $role_pengguna)
                        @if ($role_pengguna->id_user == Auth::user()->id && $role_pengguna->id_peranan == 1)
                        <li><a href="{{ route('log-aktiviti') }}" class="{{ Route::currentRouteName() == 'log-aktiviti' ? 'active' : '' }}"><i class="fa fa-list-ul"></i>Log Aktiviti</a></li>
                        <li><a href="{{ route('log-login') }}" class="{{ Route::currentRouteName() == 'log-login' ? 'active' : '' }}"><i class="fa fa-list-ul"></i>Log Login</a></li>
                        @endif
                        @empty
                        @endforelse
                    </ul>
                </li>

                <!-- Pentadbiran -->
                @forelse ($user_role_pengguna as $counter2 => $role_pengguna)
                @if ($role_pengguna->id_user == Auth::user()->id && $role_pengguna->id_peranan == 1)
                <h3 class="menu-title">Pentadbiran Mesyuarat</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ route('senarai.pengguna') }}"><i class="menu-icon fa fa-user"></i>Pengguna Sistem</a>
                </li>
                @endif
                @empty
                @endforelse

                <li>
                    <a href="{{ route('manual_Prime2.pdf') }}"><i class="menu-icon fa fa-book"></i>Manual Pengguna</a>
                </li>
            </ul>
        </div>
    </nav>
</aside>
