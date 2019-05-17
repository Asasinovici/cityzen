<?php


namespace Core;


class Config
{
    static function getPrivatePath($path = '')
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/../private/' . $path;
    }

    static function getPublicPath($path = '')
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/' . $path;
    }
}