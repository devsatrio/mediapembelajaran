@extends('layouts/base_user')

@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4 mt-4">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @php $i=1; @endphp
                            @foreach($dataslider as $dsld)
                            @if($i==1)
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{asset('images/slider/'.$dsld->gambar)}}" alt="">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>{{$dsld->judul}}</h3>
                                    <p>{{$dsld->isi}}</p>
                                    @if($dsld->link!='')
                                    <a href="{{$dsld->link}}" target="blank()">
                                        <button class="btn btn-primary" type="button">{{$dsld->link_text}}</button>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @else
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{asset('images/slider/'.$dsld->gambar)}}" alt="">
                                <div class="carousel-caption d-none d-md-block">
                                    <h3>{{$dsld->judul}}</h3>
                                    <p>{{$dsld->isi}}</p>
                                    @if($dsld->link!='')
                                    <a href="{{$dsld->link}}" target="blank()">
                                        <button class="btn btn-primary" type="button">{{$dsld->link_text}}</button>
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @php $i++; @endphp
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                @foreach($kontenterbaru as $kbr)
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title m-0"><i class="fas fa-file"></i> {{$kbr->judul}}</h5>
                        </div>
                        <div class="card-body">
                            <img class="img-thumbnail" src="{{asset('images/konten/'.$kbr->gambar)}}" alt="Photo"
                                width="100%">
                            <p class="card-text">{{$kbr->sub_judul}}</p>
                            <a href="{{url('view-media/show/'.$kbr->slug)}}" class="btn btn-primary">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection