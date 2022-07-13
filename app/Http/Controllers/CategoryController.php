<?php

namespace App\Http\Controllers;

use App\Exceptions\InvariantException;
use App\Http\Requests\CategoryAddRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('role:admin');
    }


    public function index()
    {
        $title = 'Category';
        $categories = Category::all();
        return view('categories.index', compact('title', 'categories'));
    }

    public function store(CategoryAddRequest $request)
    {
        try {
            $this->categoryService->add($request);
            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
        }catch (InvariantException $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit($id)
    {
        $title = 'Edit Kategori';
        $category = Category::find($id);
        return view('categories.edit', compact('title', 'category'));
    }


    public function update(CategoryAddRequest $request, $id)
    {
        try {
            $category = Category::find($id);
            $category->name = $request->input('name');
            $category->save();
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus');
        }catch (\Exception $exception) {
            return redirect()->route('categories.index')->with('error', 'Kategori gagal dihapus');
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::where('id',$id)->delete();
            return redirect()->back()->with('success', 'Kategori berhasil dihapus');
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Kategori gagal dihapus');
        }

    }
}
