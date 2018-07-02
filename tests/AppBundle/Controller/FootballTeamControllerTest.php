<?php

namespace Tests\AppBundle\Controller;

use AppBundle\TestHelper\AbstractApiTestCase;


class FootballTeamControllerTest extends AbstractApiTestCase
{
    public function testPOSTFootballTeamCreate()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');
        $league = $this->createLeague('Premier');

        $data['league_id'] = $league->getId();
        $data['name'] = 'nameX';
        $data['strip'] = 'stripX';


        $response = $this->client->post($this->baseUrl.'/api/football-team', [
            'headers' => $this->getAuthorizedHeaders('testtokenuser'),
            'body' => json_encode($data),
        ]);

        $resultDecoded = json_decode((string)$response->getBody(),true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Football Team created', $resultDecoded);

    }


    public function testPUTFootballTeamCreate()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');
        $league = $this->createLeague('Premier');
        $footballTeam1 = $this->createFootballTeam('team1', 'strip1', $league);

        $data['league_id'] = $league->getId();
        $data['name'] = 'nameX';
        $data['strip'] = 'stripX';


        $response = $this->client->put($this->baseUrl.'/api/football-team/'.$footballTeam1->getId(), [
            'headers' => $this->getAuthorizedHeaders('testtokenuser'),
            'body' => json_encode($data),
        ]);

        $resultDecoded = json_decode((string)$response->getBody(),true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Football Team updated', $resultDecoded);

    }

}
