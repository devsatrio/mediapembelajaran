@extends('layouts/base_user')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        @foreach($datakontenhalaman as $dkh)
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">{{$dkh->judul}}</h1>
                    <span>Shared publicly at {{$dkh->created_at}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                @foreach($datakontenhalaman as $dkh)
                <div class="col-lg-8 mb-5">
                    <div class="card card-widget">
                        <div class="card-body">
                            <img class="img-thumbnail" src="{{asset('images/konten/'.$dkh->gambar)}}" alt="Photo"
                                width="100%">

                            <p class="mt-4">{!!$dkh->isi!!}</p>
                            <button type="button" onclick="history.go(-1)" class="btn btn-danger btn-sm">
                                Kembali</button>
                            <span class="float-right text-muted">Created By Admin</span>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-4">
                    <h5>Baca Juga Materi Lain</h5>
                    @foreach($datakontenhalamanlain as $dkhl)
                    <div class="card card-widget">
                        <div class="card-header">
                            <div class="user-block">
                                <img src="{{asset('assets/img/note.png')}}" alt="">
                                <span class="username"><a
                                        href="{{url('view-media/show/'.$dkh->slug)}}">{{$dkhl->judul}}</a></span>
                                <span class="description">Shared publicly at {{$dkhl->created_at}}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <img class="img-thumbnail" src="{{asset('images/konten/'.$dkhl->gambar)}}" alt="Photo"
                                width="100%">

                            <p class="mt-4">{!!$dkhl->sub_judul!!}</p>
                            <a href="{{url('view-media/show/'.$dkh->slug)}}">
                                <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>
                                    Read More</button>
                            </a>
                            <span class="float-right text-muted">Created By Admin</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection