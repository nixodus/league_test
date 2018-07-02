<?php

namespace Tests\AppBundle\Controller;

use AppBundle\TestHelper\AbstractApiTestCase;


class SecurityControllerTest extends AbstractApiTestCase
{
    public function testPOSTCreateToken()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');

        $response = $this->client->post($this->baseUrl.'/api/login_check', [
            'auth' => ['testtokenuser', '!@#$%^YTREWQ']
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->asserter()->assertResponsePropertyExists(
            $response,
            'token'
        );
    }

    public function testPOSTTokenInvalidCredentials()
    {
        $this->createUser('testtokenuser', '!@#$%^YTREWQ');


            $response = $this->client->post($this->baseUrl.'/api/login_check', [
                'auth' => ['testtokenuser', '!@#$%^YTREWQ!']
            ]);

            $this->assertEquals(401, $response->getStatusCode());

    }
}
