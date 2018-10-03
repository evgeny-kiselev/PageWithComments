<?php
namespace App\Controller;


use App\Entity\Page;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{
    /**
     * @Route("/{page_id}", name = "page")
     */
    public function page($page_id){
        $doc = $this->getDoctrine()->getRepository(Page::class);
        $page = $doc->find($page_id);
        if($page != null) return $this->render('page.html.twig',['page'=>$page]);
        else return new Response("NOT FOUND!", 404);
    }

    /**
     * @Route("/", name = "p_load")
     */
    public function page_load(){
        $this->page(1);
    }
}