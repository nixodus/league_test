<?php

namespace AppBundle\DataFixtures\ORM;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;


class LoadSystemUserData extends Fixture implements OrderedFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');

        $password = $this->encoder->encodePassword($user, '!@WQSDFFF');
        $user->setPassword($password);
        $user->setEmail('boo@email.com');

        $manager->persist($user);
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }

}