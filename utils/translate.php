<?php

require("./vendor/autoload.php");

use Stichoza\GoogleTranslate\GoogleTranslate;

function translate($target, $text)
{

    $tr = new GoogleTranslate($target); // target bahasa: Indonesia
    return $tr->translate($text); // Output: Halo, apa kabar?
}
