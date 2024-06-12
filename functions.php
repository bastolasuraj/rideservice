<?php

function getFileName()
{
    $filepath = $_SERVER['PHP_SELF'];
    $filename = basename($filepath);
    return $filename;
}

function isIndex()
{
    if (getFileName() === 'index.php'):
        return true;
    endif;
}