<?php
namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Page;
use App\Entity\User;
use function MongoDB\BSON\toJSON;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends Controller
{
    /**
     * @Route("/get_all_comments/{page_id}")
     */
    public function getAll($page_id){
        $rep = $this->getDoctrine()->getRepository(Comment::class);
        $all_com = $rep->findBy(['page'=>$page_id]);
        $comment = [];
        for($i = 0; $i <count($all_com);$i++){
            $comment[] = $all_com[$i]->toJSON();
        }
        return new Response(json_encode($comment));
    }

    /**
     * @Route("/add_comment/{page_id}")
     */
    public function addComment(Request $request,$page_id){
        $doc = $this->getDoctrine();
        $page = $doc->getRepository(Page::class)->find($page_id);
        if($page == null) return new Response("not found page", 404);
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user == null) return new Response("not found user", 404);
        $text = $request->request->get('text');
        if(strlen($text) < 1) return new Response("text is empty", 404);

        $comm = new Comment();
        $comm->setPage($page);
        $comm->setAutor($user);
        $comm->setText($text);
        $date = new \DateTime();
        $date = $date->add(new \DateInterval('PT5H'));
        $comm->setDate($date);

        $doc->getManager()->persist($comm);
        $doc->getManager()->flush();
        return new Response($comm->getDate()->format("d-m-Y H:i:s"), 200);
    }
}