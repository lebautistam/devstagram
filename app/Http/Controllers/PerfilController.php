<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' =>Str::slug($request->username)]);
        $this->validate($request, [
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:editar-perfil']
        ]);

        if($request->imagen){

            $image = $request->file('imagen');

            $nameImage = Str::uuid() . '.' . $image->extension();
    
            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);
    
            if(!file_exists('perfiles')){
                mkdir( public_path('perfiles'));
            }
            $imagePath = public_path('perfiles') . '/' . $nameImage;
            $imageServer->save($imagePath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nameImage ?? auth()->user()->imagen ?? '';
        $usuario->save();

        //Redireccionar

        return redirect()->route('post.index', $usuario->username);
    }
}
