<?php

use App\Models\Makan;
use App\Repositories\MakanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MakanRepositoryTest extends TestCase
{
    use MakeMakanTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MakanRepository
     */
    protected $makanRepo;

    public function setUp()
    {
        parent::setUp();
        $this->makanRepo = App::make(MakanRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateMakan()
    {
        $makan = $this->fakeMakanData();
        $createdMakan = $this->makanRepo->create($makan);
        $createdMakan = $createdMakan->toArray();
        $this->assertArrayHasKey('id', $createdMakan);
        $this->assertNotNull($createdMakan['id'], 'Created Makan must have id specified');
        $this->assertNotNull(Makan::find($createdMakan['id']), 'Makan with given id must be in DB');
        $this->assertModelData($makan, $createdMakan);
    }

    /**
     * @test read
     */
    public function testReadMakan()
    {
        $makan = $this->makeMakan();
        $dbMakan = $this->makanRepo->find($makan->id);
        $dbMakan = $dbMakan->toArray();
        $this->assertModelData($makan->toArray(), $dbMakan);
    }

    /**
     * @test update
     */
    public function testUpdateMakan()
    {
        $makan = $this->makeMakan();
        $fakeMakan = $this->fakeMakanData();
        $updatedMakan = $this->makanRepo->update($fakeMakan, $makan->id);
        $this->assertModelData($fakeMakan, $updatedMakan->toArray());
        $dbMakan = $this->makanRepo->find($makan->id);
        $this->assertModelData($fakeMakan, $dbMakan->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteMakan()
    {
        $makan = $this->makeMakan();
        $resp = $this->makanRepo->delete($makan->id);
        $this->assertTrue($resp);
        $this->assertNull(Makan::find($makan->id), 'Makan should not exist in DB');
    }
}
