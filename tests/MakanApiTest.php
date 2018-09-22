<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MakanApiTest extends TestCase
{
    use MakeMakanTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateMakan()
    {
        $makan = $this->fakeMakanData();
        $this->json('POST', '/api/v1/makans', $makan);

        $this->assertApiResponse($makan);
    }

    /**
     * @test
     */
    public function testReadMakan()
    {
        $makan = $this->makeMakan();
        $this->json('GET', '/api/v1/makans/'.$makan->id);

        $this->assertApiResponse($makan->toArray());
    }

    /**
     * @test
     */
    public function testUpdateMakan()
    {
        $makan = $this->makeMakan();
        $editedMakan = $this->fakeMakanData();

        $this->json('PUT', '/api/v1/makans/'.$makan->id, $editedMakan);

        $this->assertApiResponse($editedMakan);
    }

    /**
     * @test
     */
    public function testDeleteMakan()
    {
        $makan = $this->makeMakan();
        $this->json('DELETE', '/api/v1/makans/'.$makan->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/makans/'.$makan->id);

        $this->assertResponseStatus(404);
    }
}
