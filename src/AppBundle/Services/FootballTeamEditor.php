<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\FootballTeam;

class FootballTeamEditor
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

    public function updateFootballTeam($idFootballTeam, $name, $strip)
    {

        /** @var FootballTeam|null $footballTeam */
        $footballTeam = $this->entityManager->getRepository(FootballTeam::class)
            ->find($idFootballTeam);

        /** @var FootballTeam|null $footballTeam */
        $footballTeamExist = $this->entityManager->getRepository(FootballTeam::class)
            ->findByName($name);
        if($footballTeamExist){
            throw new \Exception('Football Team: '.$name.' exist in DB!');
        }

        if ($footballTeam) {
            if (!empty($name)) {
                $footballTeam->setName($name);
            }
            if (!empty($strip)) {
                $footballTeam->setStrip($strip);
            }
            $this->entityManager->persist($footballTeam);
            $this->entityManager->flush();

            return $footballTeam;

        } else {
            throw new \Exception('Football Team not found!');
        }
    }
}