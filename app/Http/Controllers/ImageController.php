<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store( Request $request )
    {
        // Obtiene la imagen del Request (Petición)
        $image = $request->file('file');
        // Se establece un nombre la la imagen
        $nameImage = Str::uuid() . "." . $image->extension();
        // Se crear la imagen en memoria mediante Intervation
        $imageServer = Image::make( $image );
        // Se manipula la imagen
        $imageServer->fit( 1000, 1000 );
        // Se establece le Path
        $imagePath = public_path('uploads') . '/' . $nameImage;
        // Se guarda la imagen
        $imageServer->save( $imagePath );

        return response()->json(['image' => $nameImage]);
    }
    public function destroyImage( Request $request )
    {
        return response()->json([
            'message' => 'Image deleted - Image Controller',
            'Request' => $request->image
        ]);
    }
}
