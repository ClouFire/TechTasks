<?php

require_once __DIR__ . '/Database.php';

class TableShow
{

    public static function getComments(): array
    {
        $query = DB::prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll();
    }

}


