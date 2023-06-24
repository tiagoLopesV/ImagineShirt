<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\TshirtImage;
use Illuminate\Http\Request;
use App\Http\Requests\TshirtImageRequest;

class TshirtImageController extends Controller
{

    public function index()
    {
        $tshirtImages = TshirtImage::all();

        return view('tshirtImages.index', ['tshirtImages' => $tshirtImages]);
    }

    public function show(TshirtImage $tshirtImage): View
    {
        return view('tshirtImages.show', compact('tshirtImage'));
    }
    
    public function edit(TshirtImage $tshirtImage): View
    {
        return view('tshirtImages.edit', compact('tshirtImage'));
    }

    public function update(TshirtImageRequest $request, TshirtImage $tshirtImage): RedirectResponse
    {
        $formData = $request->validated();
        $tshirtImage = DB::transaction(function () use ($formData, $tshirtImage, $request) {
            $tshirtImage->name = $formData['name'];
            $tshirtImage->description = $formData['description'];
            $tshirtImage->save();
            // if ($request->hasFile('photo_file')) {
            //     if ($user->photo_url) {
            //         Storage::delete('public/photos/' . $user->photo_url);
            //     }
            //     $path = $request->photo_file->store('public/photos');
            //     $user->photo_url = basename($path);
            //     $user->save();
            // }
            return $user;
        });
        $url = route('tshirtimages.show', ['tshirtImage' => $tshirtImage]);
        $htmlMessage = "Image <a href='$url'>#{$tshirtImage->id}</a>
                        <strong>\"{$tshirtImage->name}\"</strong> foi alterada com sucesso!";
        return redirect()->route('catalog')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

}