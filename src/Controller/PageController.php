<?php
namespace App\Controller;


use App\Entity\Page;
use App\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{
    /**
     * @Route("/page/{page_id}", name = "page")
     */
    public function page($page_id){
        $doc = $this->getDoctrine()->getRepository(Page::class);
        $page = $doc->find($page_id);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($page != null)
            return $this->render('page.html.twig',['page'=>$page,'user'=>$user,'user_role'=>$user]);
        else return new Response("PAGE NOT FOUND!", 404);
    }

    /**
     * @Route("/", name = "p_load")
     */
    public function page_load(){
        return $this->page(1);
    }
}