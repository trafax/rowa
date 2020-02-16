<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmailTemplateController extends Controller
{
    public function index()
    {
        $templates = EmailTemplate::all();

        return view('emailtemplates.admin.index')->with('templates', $templates);
    }

    public function create()
    {
        return view('emailtemplates.admin.create');
    }

    public function store(Request $request)
    {
        $emailTemplate = new EmailTemplate();
        $emailTemplate->fill($request->all());
        $emailTemplate->save();

        return redirect()->route('admin.emailTemplates.index')->with('message', 'E-mail template succesvol aangemaakt.');
    }

    public function edit(EmailTemplate $emailTemplate)
    {
        return view('emailtemplates.admin.edit')->with('template', $emailTemplate);
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->fill($request->all());
        $emailTemplate->save();

        return redirect()->route('admin.emailTemplates.index')->with('message', 'E-mail template succesvol aangepast.');
    }

    public function delete_selected(Request $request)
    {
        EmailTemplate::destroy($request->get('ids'));

        Session::flash('message', 'Geselecteerde e-mail templates succesvol verwijderd.');

        echo 1;
    }
}
