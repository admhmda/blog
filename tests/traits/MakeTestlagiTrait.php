<?php

use Faker\Factory as Faker;
use App\Models\Testlagi;
use App\Repositories\TestlagiRepository;

trait MakeTestlagiTrait
{
    /**
     * Create fake instance of Testlagi and save it in database
     *
     * @param array $testlagiFields
     * @return Testlagi
     */
    public function makeTestlagi($testlagiFields = [])
    {
        /** @var TestlagiRepository $testlagiRepo */
        $testlagiRepo = App::make(TestlagiRepository::class);
        $theme = $this->fakeTestlagiData($testlagiFields);
        return $testlagiRepo->create($theme);
    }

    /**
     * Get fake instance of Testlagi
     *
     * @param array $testlagiFields
     * @return Testlagi
     */
    public function fakeTestlagi($testlagiFields = [])
    {
        return new Testlagi($this->fakeTestlagiData($testlagiFields));
    }

    /**
     * Get fake data of Testlagi
     *
     * @param array $postFields
     * @return array
     */
    public function fakeTestlagiData($testlagiFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nama' => $fake->word,
            'describe' => $fake->text,
            'created_by' => $fake->randomDigitNotNull,
            'updated_by' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $testlagiFields);
    }
}
