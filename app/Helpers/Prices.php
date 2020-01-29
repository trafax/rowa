<?php

function price($price = 0)
{
    return number_format($price, 2, ',', '.');
}
