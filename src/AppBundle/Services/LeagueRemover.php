<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\League;
use AppBundle\Entity\FootballTeam;


class LeagueRemover
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

    public function deleteLeague($leagueId){

        /** @var League|null $league */
        $league = $this->entityManager->getRepository(League::class)
            ->find($leagueId);

        if($league){
            $this->entityManager->remove($league);
            $this->entityManager->flush();

            return true;
        }else{
            throw new \Exception('League not found!');
        }
    }

}
