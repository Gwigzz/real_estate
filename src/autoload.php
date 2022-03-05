<?php

// Autoload
spl_autoload_register(function ($className) {
    require_once    'src' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . $className . '.class.php';
});
