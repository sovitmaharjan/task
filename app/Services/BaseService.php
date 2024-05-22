<?php

namespace App\Services;

use PDO;

class BaseService
{
    protected $table, $columns, $hidden, $visibleColumns;

    public function __construct($table, $columns, $hidden = [])
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->hidden = $hidden;
        $this->visibleColumns = array_diff($this->columns, $this->hidden ?? []);
    }

    public function readAll()
    {
        $columns = implode(', ', $this->visibleColumns);

        $entries = request()->entries ?? 10;
        $page = request()->page ?? 1;
        $offset = ($entries * $page) - $entries;
        $total = pdo("SELECT count(*) FROM $this->table", [], 3);

        $data[$this->table] = pdo("SELECT $columns FROM $this->table LIMIT $entries OFFSET $offset", [], 2);
        $data['total'] = $total;
        $data['currentPage'] = $page;
        $calc = $total / $entries;
        $data['lastPage'] = is_float($calc) ? (int) $calc + 1 : $calc;
        $data['entries'] = $entries;
        return $data;
    }

    public function read($id)
    {
        $columns = implode(', ', $this->visibleColumns);
        return pdo("SELECT $columns FROM $this->table WHERE id = ?", [$id], 1);
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
        return pdo("INSERT INTO $this->table ($columns) VALUES($valuePlaceholders)", $values);
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
        return pdo("UPDATE $this->table SET $placeholders WHERE id = ?", array_merge($values, [$id]));
    }

    public function delete($id)
    {
        return pdo("DELETE FROM $this->table WHERE id = ?", [$id]);
    }
}
