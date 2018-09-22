<?php

namespace App\Repositories;

use App\Models\Testlagi;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class TestlagiRepository
 * @package App\Repositories
 * @version September 22, 2018, 1:19 pm UTC
 *
 * @method Testlagi findWithoutFail($id, $columns = ['*'])
 * @method Testlagi find($id, $columns = ['*'])
 * @method Testlagi first($columns = ['*'])
*/
class TestlagiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'describe',
        'created_by',
        'updated_by'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Testlagi::class;
    }
}
