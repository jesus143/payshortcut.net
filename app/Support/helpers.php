<?php

function changeDashToSpaceUcLetter($string)
{
    $string = str_replace('_', ' ', $string);
    return ucfirst($string);
}