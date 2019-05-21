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
        $productModel->getAll();

        echo '<pre>';
//        var_dump($productModel->find(1));
//        var_dump($productModel->delete(1));
//        var_dump($productModel->create([
//            'name' => 'TOY',
//            'price' => 4.5
//        ]));

        var_dump($productModel->update(
            5,
            [
                'name' => 'THE GREAT TOY',
                'price' => 24.5
            ]
        ));

//        return new View('frontend/index.php');
    }
}