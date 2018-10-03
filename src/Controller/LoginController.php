<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login");
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        $lastError = $authUtils->getLastAuthenticationError();
        $lastUserName = $authUtils->getLastUsername();

        return $this->render('login.html.twig',[
            'error' => $lastError,
            'last_username' => $lastUserName
        ]);
    }
}