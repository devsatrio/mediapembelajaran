<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;
use QrCode;
use DB;

class HalamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $data = DB::table('halaman')->orderby('id','desc')->get();
        return view('backend.halaman.index',['data'=>$data]);
    }

    //=================================================================
    public function create()
    {
        //
    }

    //=================================================================
    public function store(Request $request)
    {
        DB::table('halaman')
        ->insert([
            'nama'=>$request->nama,
            'slug'=>strtolower(str_replace(' ','-',$request->nama)),
            'bentuk'=>$request->bentuk,
        ]);
        return redirect('halaman')->with('status','Sukses menyimpan data');
    }

    //=================================================================
    public function show($id)
    {
        //
    }

    //=================================================================
    public function downloadqr($slug)
    {
        $image = QrCode::format('svg')
                 ->size(200)
                 ->generate(url('view-media/'.$slug));
        $output_file = '/img/qrcode/img-'.$slug.'.svg';
        Storage::disk('local')->put($output_file, $image);

        //$file=Storage::disk('public')->get('img/qrcode/img-'.$slug.'.svg');
        $path = storage_path().'/app/img/qrcode/img-'.$slug.'.svg';
        return response()->download($path);
		//return (new Response($file, 200))->header('Content-Type', 'image/svg');
    }

    //=================================================================
    public function downloadkontenqrs($slug)
    {
        $image = QrCode::format('svg')
                 ->size(200)
                 ->generate(url('view-media/show/'.$slug));
        $output_file = '/img/qrcode/img-'.$slug.'.svg';
        Storage::disk('local')->put($output_file, $image);

        //$file=Storage::disk('public')->get('img/qrcode/img-'.$slug.'.svg');
        $path = storage_path().'/app/img/qrcode/img-'.$slug.'.svg';
        return response()->download($path);
		//return (new Response($file, 200))->header('Content-Type', 'image/svg');
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('halaman')
        ->where('id',$id)
        ->update([
            'nama'=>$request->nama,
            'slug'=>strtolower(str_replace(' ','-',$request->nama)),
            'bentuk'=>$request->bentuk,
        ]);
        return redirect('halaman')->with('status','Sukses memperbarui data');
    }

    //=================================================================
    public function destroy($id)
    {
        DB::table('halaman')
        ->where('id',$id)
        ->delete();
        return redirect('halaman')->with('status','Sukses menghapus data');
    }
}