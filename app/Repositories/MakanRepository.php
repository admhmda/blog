<?php

namespace App\Repositories;

use App\Models\Makan;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class MakanRepository
 * @package App\Repositories
 * @version September 22, 2018, 1:07 pm UTC
 *
 * @method Makan findWithoutFail($id, $columns = ['*'])
 * @method Makan find($id, $columns = ['*'])
 * @method Makan first($columns = ['*'])
*/
class MakanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'desc'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Makan::class;
    }
}
