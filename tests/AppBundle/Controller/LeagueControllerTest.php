<?php

namespace Tests\AppBundle\Controller;

use AppBundle\TestHelper\AbstractApiTestCase;


class LeagueControllerTest extends AbstractApiTestCase
{
    public function testGETLeagueGetFootballTeam()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');
        $league = $this->createLeague('Premier');
        $footballTeam1 = $this->createFootballTeam('team1', 'strip1', $league);
        $footballTeam2 = $this->createFootballTeam('team2', 'strip2', $league);

        $response = $this->client->get($this->baseUrl.'/api/league-get-football-team-list/'.$league->getId(), [
            'headers' => $this->getAuthorizedHeaders('testtokenuser')
        ]);

        $resultArray = json_decode((string)$response->getBody(),true);


        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(2, count($resultArray));

    }


    public function testDELETELeague()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');
        $league = $this->createLeague('Premier');
        $footballTeam1 = $this->createFootballTeam('team1', 'strip1', $league);
        $footballTeam2 = $this->createFootballTeam('team2', 'strip2', $league);

        $response = $this->client->delete($this->baseUrl.'/api/league/'.$league->getId(), [
            'headers' => $this->getAuthorizedHeaders('testtokenuser')
        ]);

        $resultDecoded = json_decode((string)$response->getBody(),true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('League deleted', $resultDecoded);

    }

    public function testGETLeagueGetFootballTeamBadRequest()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');
        $league = $this->createLeague('Premier');
        $footballTeam1 = $this->createFootballTeam('team1', 'strip1', $league);
        $footballTeam2 = $this->createFootballTeam('team2', 'strip2', $league);

        $response = $this->client->get($this->baseUrl.'/api/league-get-football-team-list/'.$league->getId().'1', [
            'headers' => $this->getAuthorizedHeaders('testtokenuser')
        ]);

        $resultDecoded = json_decode((string)$response->getBody(),true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('Caught exception: League not found!', $resultDecoded);

    }

    public function testDELETELeagueBadRequest()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');
        $league = $this->createLeague('Premier');
        $footballTeam1 = $this->createFootballTeam('team1', 'strip1', $league);
        $footballTeam2 = $this->createFootballTeam('team2', 'strip2', $league);

        $response = $this->client->delete($this->baseUrl.'/api/league/'.$league->getId().'1', [
            'headers' => $this->getAuthorizedHeaders('testtokenuser')
        ]);

        $resultDecoded = json_decode((string)$response->getBody(),true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals('Caught exception: League not found!', $resultDecoded);

    }



}
