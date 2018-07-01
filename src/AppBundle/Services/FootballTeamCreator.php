<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\FootballTeam;
use AppBundle\Entity\League;

class FootballTeamCreator
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    public function __construct(
        EntityManager $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function addFootballTeam($idLeague, $name, $strip)
    {

        /** @var League|null $league */
        $league = $this->entityManager->getRepository(League::class)
            ->find($idLeague);

        /** @var FootballTeam|null $footballTeam */
        $footballTeamExist = $this->entityManager->getRepository(FootballTeam::class)
            ->findByName($name);
        if($footballTeamExist){
            throw new \Exception('Football Team: '.$name.' exist in DB!');
        }

        if(empty($league)) {
            throw new \Exception('League not found!');
        }

        /** @var FootballTeam|null $footballTeam */
        $footballTeam = new FootballTeam();

        if (!empty($name)) {
            $footballTeam->setName($name);
        }
        if (!empty($strip)) {
            $footballTeam->setStrip($strip);
        }

        $footballTeam->setLeague($league);

        $this->entityManager->persist($footballTeam);
        $this->entityManager->flush();

        return $footballTeam;

    }
}
