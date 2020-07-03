<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Log;

class GalleryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    public function index()
    {
        return Gallery::all();
    }

    public function finddata($id){
        return Gallery::find($id);
    }

    public function store(Request $request){
        if ($files = $request->file('imagepath')) {
            $uploadimg = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $uploadimg);
            $savepath = 'images' . '\\' . $uploadimg;
        }
        // Log::info($savepath);
        $gallery = Gallery::create([
            'imagepath' => $savepath, 
            'description' => $request->get('description'),
        ]);
        return response() ->json($gallery,201);
    }

    public function update(Request $request,Gallery $gallery){
        // $article = Article::findOrFail($id);
        $gallery ->update($request->all());
        return response()->json($gallery,200);
    }

    public function delete(Gallery $gallery)
    {
        $gallery->delete();
        return response()->json(null,204);
    }
}
