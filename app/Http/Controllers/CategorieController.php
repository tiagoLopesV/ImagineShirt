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
    public function show(Request $request): View
    {

        $categories = Categorie::all();
        $filterByCategorie = $request->categorie ?? '';
        $filterByName = $request->name ?? '';
        $tshirtImageQuery = TshirtImage::query();
        if ($filterByCategorie !== '') {
            $tshirtImageQuery->where('category_id', $filterByCategorie);
        }else{
            $tshirtImageQuery->whereNotNull('category_id');
            if (auth()->check()) {
                $tshirtImageQuery->orWhere('customer_id',$request->user()->id );
            };
        }
        if ($filterByName !== '') {
            $tshirtImageQuery->where('description', 'like', "%$filterByName%");
        }
            
        $tshirtImages = $tshirtImageQuery->paginate(10);
        return view('categorie.show', compact('categories','tshirtImages', 'filterByCategorie', 'filterByName'));



    }
}
