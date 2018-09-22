<?php

use Faker\Factory as Faker;
use App\Models\Makan;
use App\Repositories\MakanRepository;

trait MakeMakanTrait
{
    /**
     * Create fake instance of Makan and save it in database
     *
     * @param array $makanFields
     * @return Makan
     */
    public function makeMakan($makanFields = [])
    {
        /** @var MakanRepository $makanRepo */
        $makanRepo = App::make(MakanRepository::class);
        $theme = $this->fakeMakanData($makanFields);
        return $makanRepo->create($theme);
    }

    /**
     * Get fake instance of Makan
     *
     * @param array $makanFields
     * @return Makan
     */
    public function fakeMakan($makanFields = [])
    {
        return new Makan($this->fakeMakanData($makanFields));
    }

    /**
     * Get fake data of Makan
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMakanData($makanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'desc' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $makanFields);
    }
}
