<?php

namespace Core;

class View
{
    public function __construct($path = 'global/404.php', $parameters = [])
    {
        extract($parameters);
        require($_SERVER['DOCUMENT_ROOT'] . '/../private/Views/' . $path);
    }
}