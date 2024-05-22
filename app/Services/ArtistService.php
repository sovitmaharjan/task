<?php

namespace App\Services;

use App\Services\BaseService;

class ArtistService extends BaseService
{
    protected $columns = [
        'id',
        'name',
        'dob',
        'gender',
        'address',
        'first_release_year',
        'no_of_album_released',
        'created_at',
        'updated_at'
    ];

    protected $table = 'artists';

    protected $pdo, $visibleColumns;

    public function __construct()
    {
        parent::__construct(
            $this->table,
            $this->columns,
        );
    }
}
