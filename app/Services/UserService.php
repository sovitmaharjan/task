<?php

namespace App\Services;

use App\Services\BaseService;

class UserService extends BaseService
{
    protected $columns = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'dob',
        'gender',
        'address',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $table = 'users';

    public function __construct()
    {
        parent::__construct(
            $this->table,
            $this->columns,
            $this->hidden
        );
    }
}
