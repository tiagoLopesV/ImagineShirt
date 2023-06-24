<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\TshirtImage;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{

    public function index(): View
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $category = new Category();
        return view('categories.create')
            ->withCategory($category);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $newCategory = Category::create($request->validated());
        $url = route('categories.show', ['id' => $newCategory]);
        $htmlMessage = "Categoria <a href='$url'>#{$newCategory->id}</a>
                        <strong>\"{$newCategory->name}\"</strong> foi criada com sucesso!";
        return redirect()->route('categories.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        try {
            $category->delete();
            $htmlMessage = "Categoria #{$category->id}
                    <strong>\"{$category->name}\"</strong> foi apagada com sucesso!";
            return redirect()->route('categories.index')
                ->with('alert-msg', $htmlMessage)
                ->with('alert-type', 'success');
            
        } catch (\Exception $error) {
            $url = route('categories.index', ['category' => $category]);
            $htmlMessage = "Não foi possível apagar a categoria <a href='$url'>#{$category->id}</a>
                        <strong>\"{$category->name}\"</strong> porque ocorreu um erro!";
            $alertType = 'danger';
        }
        return back()
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', $alertType);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse{
        $formData = $request->validated();
        $category = DB::transaction(function () use ($formData, $category, $request) {
            $category->name = $formData['name'];
            $category->save();
            return $category;
        });
        $url = route('categories.index', ['category' => $category]);
        $htmlMessage = "A Categoria <a href='$url'>#{$category->id}</a>
                    <strong>\"{$category->name}\"</strong> foi alterado com sucesso!";
        return redirect()->route('categories.index')
            ->with('alert-msg', $htmlMessage)
            ->with('alert-type', 'success');
    }   
}
