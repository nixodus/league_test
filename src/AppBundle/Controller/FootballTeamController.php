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


class FootballTeamController extends Controller
{

    const BAD_REQUEST = 400;
    const OK = 200;

    public function putAction(Request $request, $id)
    {

        $data = json_decode($request->getContent(), true);

        $name     = (string)$data['name'];
        $strip    = (string)$data['strip'];

        /** @var FootballTeamEditor $footballTeamEditor */
        $footballTeamEditor = $this->get('football.team.editor');

        try {
            if(empty($id)){
                throw new \Exception('Football team id is not valid!');
            }

            $footballTeamEditor->updateFootballTeam($id, $name, $strip);

            $response =  new JsonResponse('Football Team updated', self::OK);

            return $response;

        } catch (\Exception $e) {
            $message = 'Caught exception: ' .  $e->getMessage();
            return new JsonResponse($message, self::BAD_REQUEST);
        }
    }



    public function postAction(Request $request)
    {

        $data = json_decode($request->getContent(), true);

        $leagueId =  (int)$data['league_id'];
        $name     = (string)$data['name'];
        $strip    = (string)$data['strip'];

        /** @var FootballTeamCreator $footballTeamCreator */
        $footballTeamCreator = $this->get('football.team.creator');

        try {
            $validateString = '';
            if(empty($leagueId)){
                $validateString .= ' league_id, ';
            }
            if(empty($name)){
                $validateString .= ' name, ';
            }
            if(empty($strip)){
                $validateString .= ' strip, ';
            }

            if(!empty($validateString)){
                throw new \Exception('Football team: ('.$validateString.') is not valid!');
            }


            $footballTeamCreator->addFootballTeam($leagueId, $name, $strip);
            return new JsonResponse('Football Team created', self::OK);
        } catch (\Exception $e) {
            $message = 'Caught exception: ' .  $e->getMessage();
            return new JsonResponse($message, self::BAD_REQUEST);
        }
    }



}
