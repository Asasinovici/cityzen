<?php


namespace Controllers;


use Core\Controller;
use Models\Product;
use Core\Request;
use Core\View;

class TestController extends Controller
{
    public function test(Request $request)
    {
        return new View('global/test.php', ['test' => 'this is a test']);
    }

    public function index(Request $request)
    {
        $productModel = new Product();
        $productModel->getAllRecords();

        echo '<pre>';
        var_dump($productModel->find(1));

//        return new View('frontend/index.php');
    }
}