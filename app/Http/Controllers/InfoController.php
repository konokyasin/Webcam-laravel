<?php

namespace App\Http\Controllers;

use App\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function create(Request $request)
    {
        $img =  $request->get('image');
        $folderPath = "uploads/";
        $image_parts = explode(";base64,", $img);

        foreach ($image_parts as $key => $image){
            $image_base64 = base64_decode($image);
        }

        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        Info::create([
            'name' => request('name'),
            'age' => request('age'),
            'image' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Data submitted Successfully');


    }
}
