<?php

namespace App\Services;

use PDO;

class BaseService
{
    protected $table, $columns, $hidden, $pdo, $visibleColumns;

    public function __construct($table, $columns, $hidden = [])
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->hidden = $hidden;
        $this->pdo = app('pdo');
        $this->visibleColumns = array_diff($this->columns, $this->hidden ?? []);
    }

    public function readAll()
    {
        $columns = implode(', ', $this->visibleColumns);

        $entries = request()->entries ?? 10;
        $page = request()->page ?? 1;
        $offset = ($entries * $page) - $entries;
        $total = $this->sqlResult("SELECT count(*) FROM $this->table", 3);

        $statement = $this->pdo->prepare("SELECT $columns FROM $this->table LIMIT $entries OFFSET $offset");
        $data['total'] = $total;
        $data['currentPage'] = $page;
        $calc = $total / $entries;
        $data['lastPage'] = is_float($calc) ? (int) $calc + 1 : $calc;
        $data['entries'] = $entries;
        $statement->execute();
        $data[$this->table] = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function read($id)
    {
        $columns = implode(', ', $this->visibleColumns);
        $statement = $this->pdo->prepare("SELECT $columns FROM $this->table WHERE id = ?");
        $statement->execute([$id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $key = array_search('id', $this->columns);
        if ($key !== false) {
            unset($this->columns[$key]);
        }
        $values = [];
        $valuePlaceholders = '';
        foreach ($this->columns as $item) {
            $valuePlaceholders .= $valuePlaceholders == '' ? '?' : ', ?';
            if (array_key_exists($item, $data)) {
                $values[] = $data[$item];
            } else {
                $values[] = $item == 'created_at' || $item == 'updated_at' ? date('Y-m-d H:i:s') : '';
            }
        }
        $columns = implode(', ', $this->columns);
        $statement = $this->pdo->prepare("INSERT INTO $this->table ($columns) VALUES($valuePlaceholders)");
        return $statement->execute($values);
    }

    public function update($id, $data)
    {
        $values = [];
        $placeholders = '';
        foreach ($data as $key => $value) {
            if (in_array($key, $this->columns)) {
                $placeholders .= $placeholders == '' ? "$key = ?" : ", $key = ?";
                $values[] = $value;
            }
        }
        $statement = $this->pdo->prepare("UPDATE $this->table SET $placeholders WHERE id = ?");
        return $statement->execute(array_merge($values, [$id]));
    }

    public function delete($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id = ?");
        return $statement->execute([$id]);
    }

    public function sqlResult($sql, $type = 1)
    {
        $statement = $this->pdo->query($sql);
        $statement->execute();
        return match ($type) {
            1 => $statement->fetch(PDO::FETCH_ASSOC),
            2 => $statement->fetchAll(PDO::FETCH_ASSOC),
            3 => $statement->fetchColumn(),
        };
    }
}
