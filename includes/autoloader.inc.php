<?php

spl_autoload_register('MyAutoLoader');

    function MyAutoLoader($ClassName){
        
        $path = 'classes/';
        $extension = '.class.php';
        $fullPath = $path . $ClassName . $extension;
        if(file_exists($fullPath)){
            include_once $fullPath;
        }
    }
