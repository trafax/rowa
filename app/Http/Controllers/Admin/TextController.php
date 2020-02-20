<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Text;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function store(Request $request)
    {
        Text::updateOrCreate(
            ['parent_id' => $request->get('identifier')],
            ['parent_id' => $request->get('identifier'), 'content' => $request->get('content')]
        );
    }
}
