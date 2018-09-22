<?php

use App\Models\Minuman;
use App\Repositories\MinumanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MinumanRepositoryTest extends TestCase
{
    use MakeMinumanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MinumanRepository
     */
    protected $minumanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->minumanRepo = App::make(MinumanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMinuman()
    {
        $minuman = $this->fakeMinumanData();
        $createdMinuman = $this->minumanRepo->create($minuman);
        $createdMinuman = $createdMinuman->toArray();
        $this->assertArrayHasKey('id', $createdMinuman);
        $this->assertNotNull($createdMinuman['id'], 'Created Minuman must have id specified');
        $this->assertNotNull(Minuman::find($createdMinuman['id']), 'Minuman with given id must be in DB');
        $this->assertModelData($minuman, $createdMinuman);
    }

    /**
     * @test read
     */
    public function testReadMinuman()
    {
        $minuman = $this->makeMinuman();
        $dbMinuman = $this->minumanRepo->find($minuman->id);
        $dbMinuman = $dbMinuman->toArray();
        $this->assertModelData($minuman->toArray(), $dbMinuman);
    }

    /**
     * @test update
     */
    public function testUpdateMinuman()
    {
        $minuman = $this->makeMinuman();
        $fakeMinuman = $this->fakeMinumanData();
        $updatedMinuman = $this->minumanRepo->update($fakeMinuman, $minuman->id);
        $this->assertModelData($fakeMinuman, $updatedMinuman->toArray());
        $dbMinuman = $this->minumanRepo->find($minuman->id);
        $this->assertModelData($fakeMinuman, $dbMinuman->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMinuman()
    {
        $minuman = $this->makeMinuman();
        $resp = $this->minumanRepo->delete($minuman->id);
        $this->assertTrue($resp);
        $this->assertNull(Minuman::find($minuman->id), 'Minuman should not exist in DB');
    }
}
