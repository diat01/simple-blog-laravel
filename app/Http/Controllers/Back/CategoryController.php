<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu == "true" ? 1 : 0;
        $category->save();
    }

    public function getData(Request $request)
    {
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function create(Request $request)
    {
        $isExist = Category::whereSlug(str_slug($request->name))->first();
        if ($isExist) {
            toastr()->error($request->name . ' adinda bir kategori zaten mevcut!');
            return redirect()->back();
        }
        $category = new Category;
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();
        toastr()->success('Kategori basariyla eklendi');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $isSlug = Category::whereSlug(str_slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isName = Category::whereName($request->name)->whereNotIn('id', [$request->id])->first();
        if ($isSlug or $isName) {
            toastr()->error($request->name . ' adinda bir kategori zaten mevcut!');
            return redirect()->back();
        }
        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->slug = str_slug($request->slug);
        $category->save();
        toastr()->success('Kategori basariyla guncellendi');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $category = Category::findOrFail($request->id);
        if ($category->id == 1) {
            toastr()->error('Bu kategori silinemez');
            return redirect()->back();
        }
        $message = '';
        $count = $category->articleCount();
        if ($count > 0) {
            Article::where('category_id', $category->id)->update(['category_id' => 1]);
            $defaultCategory = Category::find(1);
            $message = 'Bu kategoriye ait ' . $count . ' makale ' . $defaultCategory->name . ' kategorisine tasindi.';
        }
        $category->delete();
        toastr()->success($message, 'Kategori basariyla silindi');
        return redirect()->back();
    }
}
