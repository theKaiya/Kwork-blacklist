<?php

function deletedPicture ()
{
    return asset('/assets/images/deleted.png');
}

function u ()
{
    return auth()->user();
}

function l ($query)
{
    return "%".$query."%";
}

function clear ($string)
{
    return preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $string);
}