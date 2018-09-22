<?php

use App\Models\Testlagi;
use App\Repositories\TestlagiRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestlagiRepositoryTest extends TestCase
{
    use MakeTestlagiTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TestlagiRepository
     */
    protected $testlagiRepo;

    public function setUp()
    {
        parent::setUp();
        $this->testlagiRepo = App::make(TestlagiRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTestlagi()
    {
        $testlagi = $this->fakeTestlagiData();
        $createdTestlagi = $this->testlagiRepo->create($testlagi);
        $createdTestlagi = $createdTestlagi->toArray();
        $this->assertArrayHasKey('id', $createdTestlagi);
        $this->assertNotNull($createdTestlagi['id'], 'Created Testlagi must have id specified');
        $this->assertNotNull(Testlagi::find($createdTestlagi['id']), 'Testlagi with given id must be in DB');
        $this->assertModelData($testlagi, $createdTestlagi);
    }

    /**
     * @test read
     */
    public function testReadTestlagi()
    {
        $testlagi = $this->makeTestlagi();
        $dbTestlagi = $this->testlagiRepo->find($testlagi->id);
        $dbTestlagi = $dbTestlagi->toArray();
        $this->assertModelData($testlagi->toArray(), $dbTestlagi);
    }

    /**
     * @test update
     */
    public function testUpdateTestlagi()
    {
        $testlagi = $this->makeTestlagi();
        $fakeTestlagi = $this->fakeTestlagiData();
        $updatedTestlagi = $this->testlagiRepo->update($fakeTestlagi, $testlagi->id);
        $this->assertModelData($fakeTestlagi, $updatedTestlagi->toArray());
        $dbTestlagi = $this->testlagiRepo->find($testlagi->id);
        $this->assertModelData($fakeTestlagi, $dbTestlagi->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTestlagi()
    {
        $testlagi = $this->makeTestlagi();
        $resp = $this->testlagiRepo->delete($testlagi->id);
        $this->assertTrue($resp);
        $this->assertNull(Testlagi::find($testlagi->id), 'Testlagi should not exist in DB');
    }
}
