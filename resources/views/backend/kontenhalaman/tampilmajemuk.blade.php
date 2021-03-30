@extends('layouts/base')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
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
        @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4>Info!</h4>
            {{ session('status') }}
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Konten Halaman</h3>
                        <div class="card-tools">
                            <a href="{{url('manage-halaman-majemuk/'.$kode)}}">
                                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Tambah
                                    Data
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Gambar</th>
                                        <th>Judul</th>
                                        <th class="text-center">Tanggal Buat</th>
                                        <th class="text-center">kode QR</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($data as $row)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('images/konten/thumbnail/'.$row->gambar)}}"
                                                class="img-thumbnail" alt="">
                                        </td>
                                        <td>{{$row->judul}}</td>
                                        <td class="text-center">{{$row->created_at}}</td>
                                        <td class="text-center">
                                            {!! QrCode::size(100)->generate(url('view-media/show/'.$row->slug)); !!}
                                            <br>
                                            <a href="{{url('manage-halaman/downloadkontenqr/'.$row->slug)}}"
                                                class="btn btn-sm btn-warning mt-3">
                                                Downlod QRCode
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{url('edit-konten/'.$row->id)}}" class="btn btn-success"><i
                                                    class="fa fa-wrench"></i></a>
                                            <a href="{{url('hapus-konten/'.$row->id.'/'.$kode)}}" class="btn btn-danger"
                                                onclick="return confirm('Hapus Data?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
@endsection

@section('customscripts')
<script>
$(function() {
    $('#list-data').DataTable();
});
</script>
@endsection