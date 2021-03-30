@extends('layouts/base')

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit {{$namahalaman}}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Edit Konten Halaman</h3>
                    </div>
                    <form method="POST" role="form" enctype="multipart/form-data"
                        action="{{url('manage-halaman/'.$kode)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" name="_method" value="put">
                                <input type="hidden" name="kodehalaman" value="{{$data->id}}"> 
                                <label for="exampleInputEmail1">Judul</label>
                                <input type="text" value="{{$data->judul}}" class="form-control" name="judul" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sub Judul</label>
                                <textarea name="subjudul" class="form-control">{!!$data->sub_judul!!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Isi</label>
                                <textarea name="isi" class="form-control textarea">{!!$data->isi!!}</textarea>
                            </div>
                            <div class="form-group">
                                @if($data->gambar!='')
                                <img src="{{asset('images/konten/'.$data->gambar)}}" class="img-thumbnail"><br>
                                @endif
                                <label for="exampleInputFile">Gambar Baru*</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
@endsection

@section('customscripts')

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection