<?php
namespace App\Controller;


use App\Entity\Comment;
use App\Entity\User;
use function MongoDB\BSON\toJSON;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}