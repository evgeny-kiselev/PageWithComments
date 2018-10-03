<?php
/**
 * Created by PhpStorm.
 * User: zheny
 * Date: 02.10.2018
 * Time: 15:38
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestLoginController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function admin(){
        return new Response("Вы зашли!");
    }
}