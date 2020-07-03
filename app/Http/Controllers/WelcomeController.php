<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Company;
use App\Gallery;

class WelcomeController extends Controller
{

    
    public function getSlider()
    {
        return Slider::all();
    }

    public function getCompany()
    {
        return Company::all();
    }

    public function getGallery()
    {
        return Gallery::all();
    }

    
}
