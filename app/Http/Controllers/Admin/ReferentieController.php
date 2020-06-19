<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferentieController extends Controller
{
    public function index()
    {
        return view('referenties.admin.index');
    }
}
