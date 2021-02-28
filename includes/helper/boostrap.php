<?php

    function bug(...$vars)
    {
        foreach ($vars as $var) {
            echo '<pre>';
            print_r($var);
            echo '</pre>';
        }
    }


    function h(?string $value): string
    {
        if($value === null){
            return '';
        }
        return htmlentities($value);
    }

    function e404(){
        header('location: index.php?page=404');
    }


    function render($parameters = []){
        extract($parameters);
    }
