<?php

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\League;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadLeagueData extends Fixture implements OrderedFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $league = new League();
        $league->setName('Premier League');

        $this->addReference('_reference_League_1', $league);

        $manager->persist($league);
        $manager->flush();
    }

    public function getOrder()
    {
        return 11;
    }

}