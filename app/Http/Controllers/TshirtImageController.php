<?php

namespace App\Http\Controllers;

use App\Models\TshirtImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\TshirtImageRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TshirtImageController extends Controller
{

    public function index()
    {
        $tshirt_images = TshirtImage::all();

        return view('tshirt_images.index', ['tshirt_images' => $tshirt_images]);
    }

    public function show(TshirtImage $tshirt_image): View
    {
        return view('tshirt_images.show', compact('tshirt_image'));
    }
    
    public function edit(TshirtImage $tshirt_image): View
    {
        return view('tshirt_images.edit', compact('tshirt_image'));
    }

    public function update(TshirtImageRequest $request, TshirtImage $tshirt_image): RedirectResponse
    {
        $formData = $request->validated();
        $tshirt_image = DB::transaction(function () use ($formData, $tshirt_image, $request) {
            $tshirt_image->name = $formData['name'];
            $tshirt_image->description = $formData['description'];
            if ($request->hasFile('photo_file')) {
                $path = $request->photo_file->store('public/tshirt_images');
                $tshirt_image->image_url = basename($path);
                $tshirt_image->save();
            }
            $tshirt_image->save();
            return $tshirt_image;
        });
        $url = route('tshirt_images.show', ['tshirt_image' => $tshirt_image]);
        $htmlMessage = "Image <a href='$url'>#{$tshirt_image->id}</a>
                        <strong>\"{$tshirt_image->name}\"</strong> foi alterada com sucesso!";
        return redirect()->route('catalog')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

}