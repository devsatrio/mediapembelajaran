<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\backend\KontenhalamanModel;
use App\models\backend\HalamanModel;
use Auth;
use Image;
use DB;
use File;

class KontenhalamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=========================================================================================
    public function updatekonten(Request $request, $kode){
        $data = KontenhalamanModel::where('id',$kode)->first();
        if($request->hasFile('gambar')) {
            
            if($data->gambar != ''){
                File::delete('images/konten/'.$data->gambar);
                File::delete('images/konten/thumbnail/'.$data->gambar);
            } 

            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('images/konten/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('images/konten');
            $image->move($destinationPath, $input['imagename']);
            
            KontenhalamanModel::where('id',$kode)
            ->update([
                'judul'=>$request->judul,
                'sub_judul'=>$request->subjudul,
                'slug'=>strtolower(str_replace(' ','-',$request->judul)),
                'isi'=>$request->isi,
                'pembuat'=>Auth::user()->id,
                'gambar'=>$input['imagename'],
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }else{
            KontenhalamanModel::where('id',$kode)
            ->update([
                'judul'=>$request->judul,
                'sub_judul'=>$request->subjudul,
                'slug'=>strtolower(str_replace(' ','-',$request->judul)),
                'isi'=>$request->isi,
                'pembuat'=>Auth::user()->id,
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }
        return redirect('manage-halaman/'.$data->id_halaman)->with('status','Berhasil mengubah konten halaman');
    }

    //=========================================================================================
    public function editkonten($kode){
        $data = KontenhalamanModel::where('id',$kode)->first();
        $datahalaman = HalamanModel::where('id',$data->id_halaman)->first();
        return view('backend.kontenhalaman.editmajemuk',['data'=>$data,'namahalaman'=>$datahalaman->nama,'kode'=>$kode]);
    }

    //=========================================================================================
    public function createmajemuk($kode)
    {
        $datahalaman = HalamanModel::where('id',$kode)->first();
        return view('backend.kontenhalaman.tambahmajemuk',['namahalaman'=>$datahalaman->nama,'kode'=>$kode]);
    }
    
    //=========================================================================================
    public function index($kode)
    {
        $datahalaman = HalamanModel::where('id',$kode)->first();
        if($datahalaman->bentuk=='Tunggal'){
            $cek = KontenhalamanModel::where('id_halaman',$kode)->count();
            if($cek>0){
                $data = KontenhalamanModel::where('id_halaman',$kode)->first();
                return view('backend.kontenhalaman.edittunggal',['namahalaman'=>$datahalaman->nama,'kode'=>$kode,'data'=>$data]);
            }else{
                
                return view('backend.kontenhalaman.tambahtunggal',['namahalaman'=>$datahalaman->nama,'kode'=>$kode]);
            }
            
        }else{
            $data = KontenhalamanModel::where('id_halaman',$kode)->orderby('id','desc')->get();
            return view('backend.kontenhalaman.tampilmajemuk',['namahalaman'=>$datahalaman->nama,'kode'=>$kode,'data'=>$data]);
        }
    }

    //=========================================================================================
    public function createtunggal(Request $request)
    {
        if($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('images/konten/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('images/konten');
            $image->move($destinationPath, $input['imagename']);
       
        }
        KontenhalamanModel::insert([
            'id_halaman'=>$request->kode,
            'judul'=>$request->judul,
            'sub_judul'=>$request->subjudul,
            'slug'=>strtolower(str_replace(' ','-',$request->judul)),
            'isi'=>$request->isi,
            'pembuat'=>Auth::user()->id,
            'gambar'=>$input['imagename'],
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        $datahalaman = HalamanModel::where('id',$request->kode)->first();
        return redirect('halaman')->with('status','Berhasil menambah konten halaman '.$datahalaman->nama);   
    }
    
    //=========================================================================================
    public function storemajemuk(Request $request)
    {
        if($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('images/konten/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('images/konten');
            $image->move($destinationPath, $input['imagename']);
       
        }
        KontenhalamanModel::insert([
            'id_halaman'=>$request->kode,
            'judul'=>$request->judul,
            'sub_judul'=>$request->subjudul,
            'slug'=>strtolower(str_replace(' ','-',$request->judul)),
            'isi'=>$request->isi,
            'pembuat'=>Auth::user()->id,
            'gambar'=>$input['imagename'],
            'created_at'=>date('Y-m-d H:i:s'),
        ]);

        return redirect('manage-halaman/'.$request->kode)->with('status','Berhasil menambah konten halaman');   
    }

    //=========================================================================================
    public function updatetunggal(Request $request, $kode){
        if($request->hasFile('gambar')) {
            $data = KontenhalamanModel::where('id',$request->kodehalaman)->first();
            if($data->gambar != ''){
                File::delete('images/konten/'.$data->gambar);
                File::delete('images/konten/thumbnail/'.$data->gambar);
            } 

            $image = $request->file('gambar');
            $input['imagename'] = time().'-'.$image->getClientOriginalName();
         
            $destinationPath = public_path('images/konten/thumbnail');
            $img = Image::make($image->getRealPath());
            $img->resize(150,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input['imagename']);

            $destinationPath = public_path('images/konten');
            $image->move($destinationPath, $input['imagename']);
            
            KontenhalamanModel::where('id',$request->kodehalaman)
            ->update([
                'judul'=>$request->judul,
                'sub_judul'=>$request->subjudul,
                'slug'=>strtolower(str_replace(' ','-',$request->judul)),
                'isi'=>$request->isi,
                'pembuat'=>Auth::user()->id,
                'gambar'=>$input['imagename'],
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }else{
            KontenhalamanModel::where('id',$request->kodehalaman)
            ->update([
                'judul'=>$request->judul,
                'sub_judul'=>$request->subjudul,
                'slug'=>strtolower(str_replace(' ','-',$request->judul)),
                'isi'=>$request->isi,
                'pembuat'=>Auth::user()->id,
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }
        $datahalaman = HalamanModel::where('id',$kode)->first();
        return redirect('halaman')->with('status','Berhasil mengubah konten halaman '.$datahalaman->nama);  
    }

    public function hapuskonten($kode,$halaman){
        $data = KontenhalamanModel::where('id',$kode)->first();
            if($data->gambar != ''){
                File::delete('images/konten/'.$data->gambar);
                File::delete('images/konten/thumbnail/'.$data->gambar);
            }
        KontenhalamanModel::where('id',$kode)->delete();
        return redirect('manage-halaman/'.$halaman)->with('status','Berhasil menghapus konten halaman');   
    }
}