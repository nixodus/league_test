<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['username' => $request->getUser()]);
        if (!$user) {
            throw $this->createNotFoundException();
        }
        $isValid = $this->get('security.password_encoder')
            ->isPasswordValid($user, $request->getPassword());

        if (!$isValid) {
            throw new BadCredentialsException();
        }

        $token = $this->get('lexik_jwt_authentication.encoder')
            ->encode([
                'username' => $user->getUsername(),
                'exp' => time() + 3600
            ]);
        return new JsonResponse(['token' => $token]);
    }
}
