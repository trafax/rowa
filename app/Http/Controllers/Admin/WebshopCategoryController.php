<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebshopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WebshopCategoryController extends Controller
{
    public function index()
    {
        $objects = WebshopCategory::where('parent_id', 0)->orderBy('sort')->get();

        return view('webshop.categories.admin.index')->with('objects', $objects);
    }

    public function create()
    {
        return view('webshop.categories.admin.create');
    }

    public function store(Request $request)
    {
        $webshopCategory = new WebshopCategory();
        $request->request->set('slug', Str::slug($request->get('title')));
        $webshopCategory->fill($request->all());
        $webshopCategory->save();

        return redirect()->route('admin.webshopCategory.index')->with('message', 'Categorie succesvol aangemaakt.');
    }

    public function edit(WebshopCategory $webshopCategory)
    {
        return view('webshop.categories.admin.edit')->with('object', $webshopCategory);
    }

    public function update(Request $request, WebshopCategory $webshopCategory)
    {
        $request->request->set('slug', Str::slug($request->get('title')));
        $webshopCategory->fill($request->all());
        $webshopCategory->save();

        return redirect()->route('admin.webshopCategory.index')->with('message', 'Categorie succesvol aangepast.');
    }

    public function delete_selected(Request $request)
    {
        WebshopCategory::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde categorieën succesvol verwijderd.');

        echo 1;
    }

    public function sort(Request $request)
    {
        foreach ($request->get('items') as $index => $id)
        {
            WebshopCategory::find($id)->update(['sort' => $index]);
        }
    }
}
