<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;



class CategorieController extends Controller
{
    public function show(): View
    {

        $categories = Categorie::all();
        $filterByCategorie = $request->categorie ?? '';
        $filterByName = $request->name ?? '';
        $tshirtImageQuery = TshirtImage::query();
        if ($filterByCategorie !== '') {
            $tshirtImageQuery->where('category', $filterByCategorie);
        }else{
            $tshirtImageQuery = TshirtImage::whereNotNull('category_id');
            if (auth()->check()) {
                $tshirtImageQuery->orWhere( 'costumer_id',auth()->user()->id );
            };
        }
        if ($filterByName !== '') {
            $tshirtImageIds = ThshirtImages::where('name', 'like', "%$filterByName%")->pluck('id');
            $tshirtImageQuery->whereIntegerInRaw('id', $tshirtImageIds);
        }
            
        $tshirtImages = $tshirtImageQuery->paginate(10);
        return view('categorie.show', compact('categories','tshirtImages', 'filterByCategorie', 'filterByName'));



    }
}