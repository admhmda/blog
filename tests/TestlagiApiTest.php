<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestlagiApiTest extends TestCase
{
    use MakeTestlagiTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTestlagi()
    {
        $testlagi = $this->fakeTestlagiData();
        $this->json('POST', '/api/v1/testlagis', $testlagi);

        $this->assertApiResponse($testlagi);
    }

    /**
     * @test
     */
    public function testReadTestlagi()
    {
        $testlagi = $this->makeTestlagi();
        $this->json('GET', '/api/v1/testlagis/'.$testlagi->id);

        $this->assertApiResponse($testlagi->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTestlagi()
    {
        $testlagi = $this->makeTestlagi();
        $editedTestlagi = $this->fakeTestlagiData();

        $this->json('PUT', '/api/v1/testlagis/'.$testlagi->id, $editedTestlagi);

        $this->assertApiResponse($editedTestlagi);
    }

    /**
     * @test
     */
    public function testDeleteTestlagi()
    {
        $testlagi = $this->makeTestlagi();
        $this->json('DELETE', '/api/v1/testlagis/'.$testlagi->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/testlagis/'.$testlagi->id);

        $this->assertResponseStatus(404);
    }
}
