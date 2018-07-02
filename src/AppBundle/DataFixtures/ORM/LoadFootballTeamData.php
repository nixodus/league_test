<?php

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\FootballTeam;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadFootballTeamData extends Fixture implements OrderedFixtureInterface
{


    public function load(ObjectManager $manager)
    {
        $footballTeam1 = new FootballTeam();
        $footballTeam1->setName('Team1');
        $footballTeam1->setStrip('Strip1');
        $footballTeam1->setLeague($this->getReference('_reference_League_1'));

        $manager->persist($footballTeam1);
        $manager->flush();


        $footballTeam2 = new FootballTeam();
        $footballTeam2->setName('Team2');
        $footballTeam2->setStrip('Strip2');
        $footballTeam2->setLeague($this->getReference('_reference_League_1'));

        $manager->persist($footballTeam2);
        $manager->flush();

    }

    public function getOrder()
    {
        return 12;
    }

}