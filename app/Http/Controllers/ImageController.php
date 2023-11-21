<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $image = $request->file('file');

        $nameImage = Str::uuid() . '.' . $image->extension();

        $imageServer = Image::make($image);
        $imageServer->fit(1000, 1000);

        if(!file_exists('uploads')){
            mkdir( public_path('uploads'));
        }
        $imagePath = public_path('uploads') . '/' . $nameImage;
        $imageServer->save($imagePath);

        return response()->json(['imagen' => $nameImage]);
    }
}
