<?php

namespace App\Services;

use App\Services\BaseService;

class MusicService extends BaseService
{
    protected $columns = [
        'id',
        'artist_id',
        'title',
        'album_name',
        'genre',
        'created_at',
        'updated_at'
    ];

    protected $table = 'music';

    public $artistId;

    public function __construct()
    {
        parent::__construct(
            $this->table,
            $this->columns
        );
    }

    public function readAll()
    {
        $columns = implode(', ', $this->visibleColumns);

        $entries = request()->entries ?? 10;
        $page = request()->page ?? 1;
        $offset = ($entries * $page) - $entries;
        $total = pdo("SELECT count(*) FROM $this->table where artist_id = ?", [$this->artistId], 3);

        $data[$this->table] = pdo("SELECT $columns FROM $this->table  where artist_id = ? LIMIT $entries OFFSET $offset", [$this->artistId], 2);
        $data['total'] = $total;
        $data['currentPage'] = $page;
        $calc = $total / $entries;
        $data['lastPage'] = is_float($calc) ? (int) $calc + 1 : $calc;
        $data['artistId'] = $this->artistId;
        $data['entries'] = $entries;
        return $data;
    }

    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;
    }
}
