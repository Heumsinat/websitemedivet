<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    public function index()
    {
        return Slider::all();
    }

    public function finddata($id){
        return Slider::find($id);
    }

    public function store(Request $request){
        if ($files = $request->file('imagepath')) {
            $uploadimg = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $uploadimg);
            $savepath = 'images' . '\\' . $uploadimg;
        }
        $slider = Slider::create([
            'imagepath' => $savepath, 
            'description' => $request->get('description'),
        ]);
        return response() ->json($slider,201);
    }

    public function update(Request $request,Slider $slider){
        // $article = Article::findOrFail($id);
        $slider ->update($request->all());
        return response()->json($slider,200);
    }

    public function delete(Slider $slider)
    {
        $slider->delete();
        return response()->json(null,204);
    }
}
