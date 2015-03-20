<?php
    $skip = 0;
    $limit = 5;
    if(!empty($_GET['s']))
    {
        $skip = $_GET['s'];
    }
    if(!empty($_GET['l']))
    {
        $limit = $_GET['l'];
    }
    $path = $_SERVER['PHP_SELF'];
    $currentFile = basename($path);

    $currentPage = " class=\"current\"";