<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

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
}
