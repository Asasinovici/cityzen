<?php


namespace Controllers;


use Core\Controller;
use Core\Request;
use Core\View;

class TestController extends Controller
{
    public function test(Request $request)
    {
        return new View('global/test.php', ['test' => 'this is a test']);
    }
}