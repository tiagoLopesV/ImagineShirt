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
use App\Models\Category;

class TshirtImageController extends Controller
{

    public function index()
    {
        return redirect()->route('catalog');
    }

    public function show(TshirtImage $tshirt_image): View
    {
        return view('tshirt_images.show', compact('tshirt_image'));
    }

    public function create(): View
    {
       
        $categories = Category::all();
        $tshirt_image = new TshirtImage();
        return view('tshirt_images.create', compact('tshirt_image','categories'));
    }

    public function store(TshirtImageRequest $request): RedirectResponse
    {
        $formData = $request->validated();
        $tshirt_image = DB::transaction(function () use ($formData, $request) {
            $newTshirtImage = new TshirtImage();
            $newTshirtImage->name = $formData['name'];
            $newTshirtImage->description = $formData['description'];
            $newTshirtImage->category_id = $formData['category_id'];
            $newTshirtImage->image_url = "a";
            $newTshirtImage->save();
            if ($request->hasFile('photo_file')) {
                $path = $request->photo_file->store('public/tshirt_images');
                $newTshirtImage->image_url = basename($path);
                $newTshirtImage->save();
            }
            return $newTshirtImage;
        });
        $url = route('tshirt_images.show', ['tshirt_image' => $tshirt_image]);
        $htmlMessage = "Utilizador <a href='$url'>#{$tshirt_image->id}</a>
                        <strong>\"{$tshirt_image->name}\"</strong> foi criado com sucesso!";
        return redirect()->route('home')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
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

    public function destroy(TshirtImage $tshirt_image): RedirectResponse
    {
        try {
            DB::transaction(function () use ($tshirt_image) {
                $tshirt_image->delete();
                Storage::delete('public/tshirt_images/' . $tshirt_image->photo_url);
            });
            $htmlMessage = "Imagem #{$tshirt_image->id}
                    <strong>\"{$tshirt_image->name}\"</strong> foi apagada com sucesso!";
            return redirect()->route('tshirt_images.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
            
        } catch (\Exception $error) {
            $url = route('tshirt_images.show', ['tshirt_image' => $tshirt_image]);
            $htmlMessage = "Não foi possível apagar a imagem <a href='$url'>#{$tshirt_image->id}</a>
                        <strong>\"{$tshirt_image->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }

}