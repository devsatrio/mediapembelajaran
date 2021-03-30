<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @php
    $datasetting = DB::table('web_setting')->orderby('id')->limit(1)->get();
    @endphp
    @foreach($datasetting as $dst)
    <title>{{$dst->singkatan}}</title>
    <link rel="shortcut icon" type="image/jpg" href="{{asset('images/setting/'.$dst->favicon)}}" />
    <meta name="description" content="{{$dst->moto}}">
    @endforeach
    @yield('token')
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    @yield('customcss')
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-primary">
            <div class="container">
                @php
                $datasetting = DB::table('web_setting')->orderby('id')->limit(1)->get();
                @endphp
                @foreach($datasetting as $dst)
                <a href="{{url('/')}}" class="navbar-brand">
                    <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                    <span class="brand-text font-weight-light">{{$dst->nama}}</span>
                </a>
                @endforeach

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{url('/')}}" class="nav-link">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">Artikel</a>
                        </li> -->
                        @php
                        $datamenu = DB::table('menu')->orderby('id')->get();
                        @endphp
                        @foreach($datamenu as $dtm)
                        @if($dtm->status=='Halaman')
                        @php
                        $datahalaman = DB::table('halaman')->where('id',$dtm->halaman_id)->orderby('id')->get();
                        @endphp
                        @foreach($datahalaman as $dth)
                        @if($dth->bentuk=='Majemuk')
                        <li class="nav-item">
                            <a href="{{url('view-media/'.$dth->slug)}}" class="nav-link">{{$dtm->nama}}</a>
                        </li>
                        @else
                        @php
                        $datakontenhalaman = DB::table('konten_halaman')->where('id_halaman',$dth->id)->get();
                        @endphp
                        @foreach($datakontenhalaman as $dkh)
                        <li class="nav-item">
                            <a href="{{url('view-media/show/'.$dkh->slug)}}" class="nav-link">{{$dtm->nama}}</a>
                        </li>
                        @endforeach
                        @endif
                        @endforeach
                        @else
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">{{$dtm->nama}}</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                @php
                                $datasubmenu = DB::table('submenu')->where('id_menu',$dtm->id)->get();
                                @endphp
                                @foreach($datasubmenu as $dsm)

                                @php
                                $datahalaman = DB::table('halaman')->where('id',$dsm->id_halaman)->orderby('id')->get();
                                @endphp
                                @foreach($datahalaman as $dth)

                                @if($dth->bentuk=='Majemuk')
                                <li><a href="{{url('view-media/'.$dth->slug)}}" class="dropdown-item">{{$dsm->nama}}
                                    </a></li>
                                @else
                                @php
                                $datakontenhalaman = DB::table('konten_halaman')->where('id_halaman',$dth->id)->get();
                                @endphp
                                @foreach($datakontenhalaman as $dkh)
                                <li><a href="{{url('view-media/show/'.$dkh->slug)}}"
                                        class="dropdown-item">{{$dsm->nama}} </a></li>
                                @endforeach
                                @endif
                                @endforeach

                                @endforeach
                            </ul>
                        </li>
                        @endif
                        @endforeach

                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
    </div>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @yield('customjs')
    <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>
    @yield('customscripts')
</body>

</html>