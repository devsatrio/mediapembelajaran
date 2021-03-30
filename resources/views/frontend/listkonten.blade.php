@extends('layouts/base_user')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"> {{$datahalaman->nama}}</h1>
                    <span>List Data {{$datahalaman->nama}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                @foreach($datakontenhalaman as $dkh)
                <div class="col-lg-12">
                    <div class="card card-widget collapsed-card">
                        <div class="card-header">
                            <div class="user-block">
                                <img src="{{asset('assets/img/note.png')}}" alt="">
                                <span class="username"><a
                                        href="{{url('view-media/show/'.$dkh->slug)}}">{{$dkh->judul}}</a></span>
                                <span class="description">Shared publicly at {{$dkh->created_at}}</span>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <img class="img-thumbnail" src="{{asset('images/konten/'.$dkh->gambar)}}" alt="Photo"
                                width="100%">

                            <p class="mt-4">{!!$dkh->sub_judul!!}</p>
                            <a href="{{url('view-media/show/'.$dkh->slug)}}">
                                <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i>
                                    Read More</button>
                            </a>
                            <span class="float-right text-muted">Created By Admin</span>
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $datakontenhalaman->links() }}
            </div>
        </div>
    </div>
</div>
@endsection