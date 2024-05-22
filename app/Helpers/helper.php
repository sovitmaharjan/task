<?php

function pdo($sqlQuery, $value = [], $type = null)
{
    $pdo = app('pdo');
    $statement = $pdo->prepare($sqlQuery);
    count($value) > 0 ? $statement->execute($value) : $statement->execute();
    return match ($type) {
        null => $statement,
        1 => $statement->fetch(PDO::FETCH_ASSOC),
        2 => $statement->fetchAll(PDO::FETCH_ASSOC),
        3 => $statement->fetchColumn(),
    };
}
