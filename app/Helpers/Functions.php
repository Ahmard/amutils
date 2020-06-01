<?php

if(! function_exists('console')){
    function console()
    {
        return App::make('myapp.console.helper');
    }
}