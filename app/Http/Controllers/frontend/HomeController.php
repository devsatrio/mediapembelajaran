<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    //=================================================================
    public function index()
    {
        $dataslider = DB::table('slider')->orderby('id','desc')->get();
        $kontenterbaru = DB::table('konten_halaman')->orderby('id','desc')->limit(8)->get();
        return view('frontend.index',compact('dataslider','kontenterbaru'));
    }

    //=================================================================
    public function tampilmedia($slug)
    {
        dd('halo');
    }

    //=================================================================
    public function tampillistkonten($slug)
    {
        $datahalaman = DB::table('halaman')->where('slug',$slug)->first();
        $datakontenhalaman = DB::table('konten_halaman')->where('id_halaman',$datahalaman->id)->paginate(8);
        return view('frontend.listkonten',compact('datakontenhalaman','datahalaman'));
    }

    //=================================================================
    public function tampilkonten($slug)
    {
        $datakontenhalaman = DB::table('konten_halaman')->where('slug',$slug)->get();
        $datakontenhalamanlain = DB::table('konten_halaman')->inrandomorder()->limit(4)->get();
        return view('frontend.konten',compact('datakontenhalaman','datakontenhalamanlain'));
    }
    
    //=================================================================
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
