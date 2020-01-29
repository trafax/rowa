<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AssetController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('assets'),$imageName);

        $asset = new Asset();
        $asset->parent_id = $request->get('parent_id');
        $asset->file = $imageName;
        $asset->save();

        return response()->json(['success'=>$imageName]);
    }

    public function upload_onthefly(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('assets'),$imageName);

        return response()->json(['success'=>$imageName]);
    }

    public function delete(Asset $asset)
    {
        File::delete('./assets/'. $asset->file);
        $asset->delete();

        return redirect()->back();
    }

    public function single_dropzone(Request $request)
    {
        return view('assets.admin.dropzone_single_modal')->with('request', $request);
    }

    public function sort(Request $request)
    {
        //dd($request->get('items'));

        foreach ($request->get('items') as $index => $id)
        {
            Asset::find($id)->update(['sort' => $index]);
        }
    }

    public function edit(Asset $asset)
    {
        return view('assets.admin.edit')->with('asset', $asset);
    }

    public function update(Request $request, Asset $asset)
    {
        $asset->fill($request->all());
        $asset->save();

        return redirect()->back();
    }
}
