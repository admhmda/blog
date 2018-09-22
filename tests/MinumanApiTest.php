<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MinumanApiTest extends TestCase
{
    use MakeMinumanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMinuman()
    {
        $minuman = $this->fakeMinumanData();
        $this->json('POST', '/api/v1/minumen', $minuman);

        $this->assertApiResponse($minuman);
    }

    /**
     * @test
     */
    public function testReadMinuman()
    {
        $minuman = $this->makeMinuman();
        $this->json('GET', '/api/v1/minumen/'.$minuman->id);

        $this->assertApiResponse($minuman->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMinuman()
    {
        $minuman = $this->makeMinuman();
        $editedMinuman = $this->fakeMinumanData();

        $this->json('PUT', '/api/v1/minumen/'.$minuman->id, $editedMinuman);

        $this->assertApiResponse($editedMinuman);
    }

    /**
     * @test
     */
    public function testDeleteMinuman()
    {
        $minuman = $this->makeMinuman();
        $this->json('DELETE', '/api/v1/minumen/'.$minuman->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/minumen/'.$minuman->id);

        $this->assertResponseStatus(404);
    }
}
