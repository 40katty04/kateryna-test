<?php

namespace App\Models;

class Users
{
    private static $storage = __DIR__ . '/../../database/data/subscribers.csv';

    public static function getAll()
    {
        $data = [];

        if (!file_exists(self::$storage)){
            return [];
        }

        $file = fopen(self::$storage, 'r');

        if ($file) {
            $row = fgetcsv($file);

            while ($row) {
                $data[] = $row[0];
                $row = fgetcsv($file);
            }

            fclose($file);
        }

        return $data;
    }

    public static function add($email)
    {
        if(file_exists(self::$storage)){
            $file = fopen(self::$storage, 'a');
        } else {
            $file = fopen(self::$storage, 'w');
        }

        $response = fputcsv($file, [$email]);

        fclose($file);

        return (bool) $response;
    }

}
