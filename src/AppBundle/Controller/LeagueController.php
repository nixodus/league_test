<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Services\LeagueRetriever;
use AppBundle\Services\LeagueRemover;
use AppBundle\Services\FootballTeamCreator;
use AppBundle\Services\FootballTeamEditor;
use Symfony\Component\HttpFoundation\JsonResponse;

class LeagueController extends Controller
{
    const BAD_REQUEST = 400;
    const OK = 200;

    public function getFootballTeamListAction(Request $request, $id)
    {

        /** @var LeagueRetriever $leagueRetriever */
        $leagueRetriever = $this->get('league.retriever');

        try {
            if(empty($id)){
                throw new \Exception('League id in not valid!');
            }

            $result = $leagueRetriever->getFootballTeamList($id);
            return new JsonResponse($result, self::OK);
        } catch (\Exception $e) {
            $message = 'Caught exception: ' .  $e->getMessage();
            return new JsonResponse($message, self::BAD_REQUEST);
        }
    }


    public function deleteAction(Request $request, $id)
    {

        /** @var LeagueRemover $leagueRemover */
        $leagueRemover = $this->get('league.remover');

        try {
            if(empty($id)){
                throw new \Exception('League id in not valid!');
            }

            $leagueRemover->deleteLeague($id);
            return new JsonResponse('League deleted', self::OK);
        } catch (\Exception $e) {
            $message = 'Caught exception: ' .  $e->getMessage();
            return new JsonResponse($message, self::BAD_REQUEST);
        }
    }
}
