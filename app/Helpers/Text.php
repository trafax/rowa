<?php

use App\Models\Text;

function text($identifier)
{
    $text = Text::where('parent_id', $identifier)->first();

    return $text ? $text->content : '';
}
