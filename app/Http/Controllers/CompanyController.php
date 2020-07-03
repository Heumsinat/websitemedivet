<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    public function index()
    {
        return Company::all();
    }

    public function finddata($id){
        return Company::find($id);
    }

    public function store(Request $request){
        if ($files = $request->file('imagepath')) {
            $uploadimg = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $uploadimg);
            $savepath = 'images' . '\\' . $uploadimg;
        }
        $company = Company::create([
            'title' => $request->get('title'),
            'subtitle' => $request->get('subtitle'),
            'imagepath' => $savepath, 
            'link' => $request->get('link'),
        ]);
        return response() ->json($company,201);
    }

    public function update(Request $request,Company $company){
        $company ->update($request->all());
        return response()->json($company,200);
    }

    public function delete(Company $company)
    {
        $company->delete();
        return response()->json(null,204);
    }

}
