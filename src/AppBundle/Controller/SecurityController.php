<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Entity\User;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $jwtManager = $this->container->get('lexik_jwt_authentication.encoder');

//        return new JsonResponse(['token' => $jwtManager->encode(['username'=>'aaa'])]);

        $entityManager = $this->getDoctrine()->getEntityManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['username' => 'admin']);


        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => 'admin']);
        if (!$user) {
            throw $this->createNotFoundException();
        }
//        $isValid = $this->get('security.password_encoder')
//            ->isPasswordValid($user, 'pass_1234');

        $token = $this->get('lexik_jwt_authentication.encoder')
            ->encode([
                'username' => $user->getUsername(),
                'exp' => time() + 3600 // 1 hour expiration
            ]);
        return new JsonResponse(['token' => $token]);


    }
}
