<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->get('search'))
        {
            $users = User::where('lastname', 'LIKE', '%'.$request->get('search').'%')->where('role', 'customer')->get();
        }
        else
        {
            $users = User::where('role', 'customer')->get();
        }

        return view('users.admin.index')->with('users', $users);
    }

    public function create()
    {
        return view('users.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'unique:users'
        ]);

        $user = new User();
        $request->request->set('password', Hash::make($request->get('password')));
        $request->request->set('role', 'customer');
        $user->fill($request->all());
        $user->save();

        return redirect()->route('admin.user.index')->with('message', 'Gebruiker succesvol aangemaakt.');
    }

    public function edit(User $user)
    {
        return view('users.admin.edit')->with('webuser', $user);
    }

    public function update(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        UserProduct::where('user_id', $user->id)->delete();

        foreach ($request->get('product_title') as $key => $title) {
            if ($title) {
                    $userProduct = new UserProduct();
                    $userProduct->user_id = $user->id;
                    $userProduct->title = $title;
                    $userProduct->qty = $request->get('product_qty')[$key];
                    $userProduct->collie = $request->get('product_collie')[$key];
                    $userProduct->image = $request->get('image')[$key];
                    $userProduct->email_no_stock = $request->get('product_email_no_stock')[$key];
                    $userProduct->save();
            }
        }

        return redirect()->route('admin.user.index')->with('message', 'Gebruiker succesvol aangepast.');
    }

    public function delete_selected(Request $request)
    {
        User::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde pagina\'s succesvol verwijderd.');

        echo 1;
    }
}
