@extends('layouts/base')

@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Halaman</h1>
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
                        <h3 class="card-title">Data Halaman</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah
                                Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Bentuk</th>
                                        <th class="text-center">QRCode</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1; @endphp
                                    @foreach($data as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->bentuk}}</td>
                                        <td class="text-center">
                                            @if($row->bentuk=='Majemuk')
                                            {!! QrCode::size(90)->generate(url('view-media/'.$row->slug)); !!}
                                            @else
                                            @php
                                            $datakonten =
                                            DB::table('konten_halaman')->where('id_halaman',$row->id)->get();
                                            @endphp
                                            @foreach($datakonten as $dkn)
                                            {!! QrCode::size(90)->generate(url('view-media/show/'.$dkn->slug)); !!}
                                            @endforeach
                                            @endif
                                            <br>
                                            @if($row->bentuk=='Majemuk')
                                            <a href="{{url('manage-halaman/downloadqr/'.$row->slug)}}"
                                                class="btn btn-sm btn-warning mt-3">
                                                Downlod QRCode
                                            </a>
                                            @else
                                            <a href="{{url('manage-halaman/downloadkontenqr/'.$row->slug)}}"
                                                class="btn btn-sm btn-warning mt-3">
                                                Downlod QRCode
                                            </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            
                                            <form action="{{url('halaman/'.$row->id)}}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete">
                                                <a href="{{url('manage-halaman/'.$row->id)}}" class="btn btn-info">
                                                    Manage
                                                </a>
                                                <button type="button" class="btn btn-success" data-toggle="modal"
                                                    data-target="#modal-edit{{$row->id}}">
                                                    Edit
                                                </button>
                                                <button type="submit" onclick="return confirm('Hapus Data ?')"
                                                    class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Bentuk</th>
                                        <th class="text-center">QRCode</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-tambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Halaman</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('halaman')}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bentuk Halaman</label>
                        <select name="bentuk" class="form-control">
                            <option value="Tunggal">Tunggal</option>
                            <option value="Majemuk">Majemuk</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($data as $row)
<div class="modal fade" id="modal-edit{{$row->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{url('halaman/'.$row->id)}}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="put">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama" value="{{$row->nama}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bentuk</label>
                        <select name="bentuk" class="form-control">
                            <option value="Tunggal" @if($row->bentuk=='Tunggal') selected @endif>Tunggal</option>
                            <option value="Majemuk" @if($row->bentuk=='Majemuk') selected @endif>Majemuk</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@section('customjs')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endsection

@section('customscripts')
<script>
$(function() {
    $('#list-data').DataTable();
});
</script>
<!-- <script src="{{asset('customjs/backend/admin.js')}}"></script> datatable plugin -->
@endsection