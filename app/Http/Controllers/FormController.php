<?php

namespace App\Http\Controllers;

use App\Mail\Form as AppForm;
use App\Models\Block;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function block(Block $block)
    {
        $form = Form::find($block->block_data['form_id']);

        return view('form.block', compact('form', 'block'));
    }

    public static function parseForm($id)
    {
        $form = Form::find($id);

        return view('form.block', ['form' => $form])->render();
    }

    public function send(Request $request, Form $form)
    {
        $request->request->remove('_token');
        $request->request->remove('submit');

        $validationRules = [];
        $send_to_subscriber = NULL;

        foreach ($form->fields as $field)
        {
            if ($field->required == 1)
            {
                if ($field->type == 'checkbox')
                {
                    $validationRules = array_merge($validationRules, [Str::slug($field->title, '_') => 'required']);
                }
                else
                {
                    $validationRules = array_merge($validationRules, [Str::slug($field->title, '_') => 'required']);
                }
            }

            if ($field->type == 'email')
            {
                $send_to_subscriber = $request->get($field->title);
            }
        }

        if ($validationRules)
        {
            $request->validate($validationRules);
        }

        $email = Mail::to($form->send_to_email);

        if ($send_to_subscriber)
        {
            $email->cc($send_to_subscriber);
        }

        $email->send(new AppForm($form, $request));

        return redirect()->back()->with('message', $form->text_website);
    }

    public function getForms()
    {
        return response()->json(Form::get());
    }
}
