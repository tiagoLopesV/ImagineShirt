<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Category;
use Illuminate\Support\Facades\DB;



class CatalogController extends Controller
{

    public function index(Request $request): View
{
    $categories = Category::all();
    $filterByCategory = $request->id ?? '';
    $filterByName = $request->name ?? '';
    $filterByDescription = $request->description ?? '';
    $tshirtImageQuery = TshirtImage::query();

    if ($filterByCategory !== '') {
        $tshirtImageQuery->where('category_id', $filterByCategory);
    } else {
        if ($filterByName !== '') {
            $tshirtImageIds = TshirtImage::where('name', 'like', "%$filterByName%")->pluck('id');
            $tshirtImageQuery->whereIn('id', $tshirtImageIds);
        }

        if ($filterByDescription !== '') {
            $tshirtImageIds = TshirtImage::where('description', 'like', "%$filterByDescription%")->pluck('id');
            $tshirtImageQuery->whereIn('id', $tshirtImageIds);
        }
    }

    $tshirt_images = $tshirtImageQuery->paginate(10);
    return view('catalog', compact('categories', 'tshirt_images', 'filterByCategory', 'filterByName', 'filterByDescription'));
}



}
