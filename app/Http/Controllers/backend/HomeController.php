<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use File;
use Auth;
use Hash;
use DB;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $jumlahmenu = DB::table('menu')->count();
        $jumlahsubmenu = DB::table('submenu')->count();
        $jumlahhalaman = DB::table('halaman')->count();
        return view('backend.dashboard.index',compact('jumlahmenu','jumlahsubmenu','jumlahhalaman'));
    }

    //==================================================================
    public function editprofile(){
        $data = User::find(Auth::user()->id);
        return view('backend.dashboard.editprofile',['data'=>$data]);
    }

    //==================================================================
    public function aksieditprofile(Request $request,$id){
        if($request->hasFile('gambar')){
            File::delete('img/admin/'.$request->gambar_lama);
            $nameland=$request->file('gambar')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/admin');
            $request->file('gambar')->move($destination,$finalname);

            if($request->password==''){
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'gambar'=>$finalname,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'gambar'=>$finalname,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }else{
            if($request->password==''){
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'level'=>$request->level,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }

        return redirect('/home')->with('status','Sukses memperbarui profile');
    }
}
