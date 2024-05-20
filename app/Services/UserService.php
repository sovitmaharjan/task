<?php

namespace App\Services;

use PDO;
use Illuminate\Support\Str;

class UserService
{
    protected $columns = [
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

    protected $pdo, $visibleColumns;

    public function __construct()
    {
        $this->pdo = app('pdo');
        $this->visibleColumns = array_diff($this->columns, $this->hidden ?? []);
    }

    public function fetchAll()
    {
        $columns = implode(', ', $this->visibleColumns);
        $statement = $this->pdo->prepare("SELECT $columns FROM $this->table");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function fetch($identifier)
    {
        $columns = implode(', ', $this->visibleColumns);
        $statement = $this->pdo->prepare("SELECT $columns FROM $this->table WHERE id = ?");
        $statement->execute([$identifier]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function create($data)
    {
        $valuePlaceholders = implode(', ', array_fill(0, count($this->columns), '?'));
        $values = [];
        $valuePlaceholders = '';
        foreach ($this->columns as $item) {
            $valuePlaceholders .= $valuePlaceholders == '' ? '?' : ', ?';
            if (array_key_exists($item, $data)) {
                // temp test
                $values[] = $item == 'email' ? $data[$item] . Str::random(9) : $data[$item];
                // $values[] = $data[$item];
            } else {
                $values[] = $item == 'created_at' || $item == 'updated_at' ? date('Y-m-d H:i:s') : '';
            }
        }

        $columns = implode(', ', $this->columns);
        $statement = $this->pdo->prepare("INSERT INTO $this->table ($columns) VALUES($valuePlaceholders)");
        $statement->execute($values);

        return $this->fetch($this->pdo->lastInsertId());
    }

    public function sqlResult($sql, $type = 1)
    {
        $statement = $this->pdo->query($sql);
        $statement->execute();
        $result = match ($type) {
            1 => $statement->fetch(PDO::FETCH_ASSOC),
            2 => $statement->fetchAll(PDO::FETCH_ASSOC),
            3 => $statement->fetchColumn(),
        };
        return $result;
    }
}
