<?php

namespace Core;

class View
{
    public function __construct($path = 'global/404.php', $parameters = [])
    {
        extract($parameters);
        require(Config::getPrivatePath('Views/' . $path));
    }
}