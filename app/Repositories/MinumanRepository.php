<?php

namespace App\Repositories;

use App\Models\Minuman;
use Webcore\Generator\Common\BaseRepository;

/**
 * Class MinumanRepository
 * @package App\Repositories
 * @version September 22, 2018, 1:09 pm UTC
 *
 * @method Minuman findWithoutFail($id, $columns = ['*'])
 * @method Minuman find($id, $columns = ['*'])
 * @method Minuman first($columns = ['*'])
*/
class MinumanRepository extends BaseRepository
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
        return Minuman::class;
    }
}
