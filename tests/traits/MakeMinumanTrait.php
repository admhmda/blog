<?php

use Faker\Factory as Faker;
use App\Models\Minuman;
use App\Repositories\MinumanRepository;

trait MakeMinumanTrait
{
    /**
     * Create fake instance of Minuman and save it in database
     *
     * @param array $minumanFields
     * @return Minuman
     */
    public function makeMinuman($minumanFields = [])
    {
        /** @var MinumanRepository $minumanRepo */
        $minumanRepo = App::make(MinumanRepository::class);
        $theme = $this->fakeMinumanData($minumanFields);
        return $minumanRepo->create($theme);
    }

    /**
     * Get fake instance of Minuman
     *
     * @param array $minumanFields
     * @return Minuman
     */
    public function fakeMinuman($minumanFields = [])
    {
        return new Minuman($this->fakeMinumanData($minumanFields));
    }

    /**
     * Get fake data of Minuman
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMinumanData($minumanFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'desc' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $minumanFields);
    }
}
