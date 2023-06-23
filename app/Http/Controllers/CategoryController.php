<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Category;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    public function show(Request $request): View
    {

        $categories = Category::all();
        $filterByCategory = $request->id ?? '';
        $filterByName = $request->name ?? '';
        $filterByDescription = $request->description ?? '';
        $tshirtImageQuery = TshirtImage::query();
        if ($filterByCategory !== '') {
            $tshirtImageQuery->where('category_id', $filterByCategory);
        }else{
            $tshirtImageQuery->whereNotNull('category_id');
            if (auth()->check()) {
                $tshirtImageQuery->orWhere('customer_id',$request->user()->id );
            };
        }
        if ($filterByName !== '') {
            $tshirtImageIds = TshirtImage::where('name', 'like', "%$filterByName%")->pluck('id');
            $tshirtImageQuery->whereIntegerInRaw('id', $tshirtImageIds);
        }
        if ($filterByDescription !== '') {
            $tshirtImageIds = TshirtImage::where('description', 'like', "%$filterByDescription%")->pluck('id');
            $tshirtImageQuery->whereIntegerInRaw('id', $tshirtImageIds);
        }
          
        $tshirtImages = $tshirtImageQuery->paginate(10);
        return view('categories.show', compact('categories','tshirtImages', 'filterByCategory', 'filterByName', 'filterByDescription'));



    }
}
