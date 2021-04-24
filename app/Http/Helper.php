<?php

function isLinkActive(array $links, $class = "active")
{
    foreach ($links as $link) {
        if (preg_match("/$link/", Route::current()->uri())) {
            return $class;
        }
    }
    return "";
}