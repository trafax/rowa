<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('search'))
        {
            $objects = Page::where('title', 'LIKE', '%'.$request->get('search').'%')->orderBy('sort')->get();
        }
        else
        {
            $objects = Page::where('parent_id', 0)->orderBy('sort')->get();
        }

        return view('pages.admin.index')->with('objects', $objects);
    }
    public function create()
    {
        return view('pages.admin.create');
    }

    public function store(Request $request)
    {
        $page = new Page;
        $request->request->set('slug', Str::slug($request->get('title')));
        $page->fill($request->all());
        $page->save();

        return redirect()->route('admin.page.index')->with('message', 'Pagina succesvol aangemaakt.');
    }

    public function edit(Page $page)
    {
        return view('pages.admin.edit')->with('obj', $page);
    }

    public function update(Request $request, Page $page)
    {
        $request->request->set('slug', Str::slug($request->get('title')));
        $page->fill($request->all());
        $page->save();

        return redirect()->route('admin.page.index')->with('message', 'Pagina succesvol aangepast.');
    }

    public function delete_selected(Request $request)
    {
        Page::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde pagina\'s succesvol verwijderd.');

        echo 1;
    }

    public function sort(Request $request)
    {
        foreach ($request->get('items') as $index => $id)
        {
            Page::find($id)->update(['sort' => $index]);
        }
    }
}
