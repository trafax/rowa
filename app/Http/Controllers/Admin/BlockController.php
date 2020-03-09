<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function create(Request $request)
    {
        return view('blocks.admin.create', [
            'request' => $request
        ]);
    }

    public function store(Request $request)
    {
        $block = new Block();
        $block->fill($request->all());
        $block->save();

        return redirect()->to($request->get('referrer'));
    }

    public function edit(Request $request, Block $block)
    {
        return view('blocks.admin.edit', [
            'request' => $request,
            'block' => $block
        ]);
    }

    public function update(Request $request, Block $block)
    {
        $block->fill($request->all());
        $block->save();

        return redirect()->to($request->get('referrer'));
    }

    public function sort(Request $request)
    {
        foreach ($request->get('items') as $index => $id)
        {
            Block::find($id)->update(['sort' => $index]);
        }
    }

    public function delete(Request $request)
    {
        $block = Block::find($request->get('id'));
        $block->delete();

        echo 'OK';
    }
}
