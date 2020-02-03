<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebshopFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class WebshopFilterController extends Controller
{
    public function index()
    {
        $webshopFilters = WebshopFilter::orderBy('sort')->get();

        return view('webshop.filters.admin.index')->with([
            'objects' => $webshopFilters
        ]);
    }

    public function create()
    {
        return view('webshop.filters.admin.create');
    }

    public function store(Request $request)
    {
        $webshopFilter = new WebshopFilter();
        $request->request->set('slug', Str::slug($request->title));
        $webshopFilter->fill($request->all());
        $webshopFilter->save();

        return redirect()->route('admin.webshopFilter.index')->with('message', 'Filter succesvol aangemaakt.');
    }

    public function edit(WebshopFilter $webshopFilter)
    {
        return view('webshop.filters.admin.edit')->with([
            'object' => $webshopFilter
        ]);
    }

    public function update(Request $request, WebshopFilter $webshopFilter)
    {
        $request->request->set('slug', Str::slug($request->title));
        $webshopFilter->fill($request->all());
        $webshopFilter->save();

        return redirect()->route('admin.webshopFilter.index')->with('message', 'Filter succesvol aangepast.');
    }

    public function delete_selected(Request $request)
    {
        WebshopFilter::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde filters succesvol verwijderd.');

        echo 1;
    }

    public function sort(Request $request)
    {
        foreach ($request->get('items') as $index => $id)
        {
            WebshopFilter::find($id)->update(['sort' => $index]);
        }
    }
}
