<?php

namespace Ember\Oop\model;

use Ember\Oop\core\Db;
use Ember\Oop\interfaces\IModel;

abstract class DbModel implements IModel
{
    abstract static protected function getTableName(): string;

    public static function getOne(int $id)
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM $table WHERE id = :id";
        return Db::getInstance()->queryOneObject($sql, ['id' => $id], static::class);
    }


    public static function getAll()
    {
        $table = static::getTableName();
        $sql = "SELECT * FROM $table ORDER BY id DESC";
        return Db::getInstance()->queryAll($sql);
    }

    public function insert()
    {
        $params = [];
        $columns = [];

        foreach ($this->props as $key => $value) {
            $params[":" . $key] = $this->$key;
            $columns[] = $key;
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));


        $tableName = static::getTableName();

        $sql = "INSERT INTO `{$tableName}`($columns) VALUES ($values)";


        Db::getInstance()->execute($sql, $params);
        $this->id = Db::getInstance()->lastInsertId();
        return $this;
    }

    public function update()
    {
        $params = [];
        $colums = [];

        $tableName = static::getTableName();

        foreach ($this->props as $key => $value) {
            if (!$value) continue;
            $params["{$key}"] = $this->$key;
            $colums[] .= "`{$key}` = :{$key}";
            $this->props[$key] = false;
        }
        $colums = implode(", ", $colums);
        $params['id'] = $this->id;

        $sql = "UPDATE `{$tableName}` SET {$colums} WHERE `id` = :id";

        Db::getInstance()->execute($sql, $params);
        return $this;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function save()
    {
        if (is_null($this->id)) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }
}