<?php

namespace core;

class DB
{
    public $pdo;

    public function __construct($host, $name, $login, $password)
    {
        $this->pdo = new \PDO("mysql:host={$host};dbname={$name}", $login, $password,
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
    }

    protected function where($where)
    {
        if (is_array($where)) {
            $parts = [];
            foreach ($where as $field => $value) {
                $parts[] = "{$field} = :{$field}";
            }
            return implode(' AND ', $parts);
        } elseif (is_string($where)) {
            return $where;
        } else {
            return '1';
        }
    }

    protected function fieldsImplode($fields)
    {
        if (is_array($fields)) {
            return implode(',', $fields);
        } elseif (is_string($fields)) {
            return $fields;
        } else {
            return "*";
        }
    }


    public function select($table, $fields = "*", $where = null, $order = null, $limit = null, $offset = null, $fetch=null)
    {
        try {
            $fields_string = $this->fieldsImplode($fields);
            $sql = "SELECT {$fields_string} FROM {$table}";
            $params = [];

            if ($where) {
                $where_string = $this->where($where);
                $sql .= " WHERE {$where_string}";
                $params = array_merge($params, $where);
            }

            if ($order) {
                $sql .= " ORDER BY {$order}";
            }

            if ($limit !== null) {
                $sql .= " LIMIT :limit";
                $params['limit'] = (int)$limit;
            }

            if ($offset !== null) {
                $sql .= " OFFSET :offset";
                $params['offset'] = (int)$offset;
                $sth = $this->pdo->prepare($sql);

                foreach ($params as $key => $value) {
                    $sth->bindValue(":{$key}", $value, \PDO::PARAM_INT); // type int
                }

                $sth->execute();
                return $sth->fetchAll();
            }else{
                $sth = $this->pdo->prepare($sql);

                foreach ($params as $key => $value) {
                    $sth->bindValue(":{$key}", $value);
                }

                $sth->execute();
                return $sth->fetchAll();
            }
        } catch (\PDOException $e) {
            throw new \Exception("Database Query Error: " . $e->getMessage());
        }
    }

    public function selectById($table, $id, $fields = "*")
    {
        try {
            $fields_string = $this->fieldsImplode($fields);
            $sql = "SELECT {$fields_string} FROM {$table} WHERE id = :id";
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(":id", $id, \PDO::PARAM_INT);
            $sth->execute();
            return $sth->fetch();
        } catch (\PDOException $e) {
            throw new \Exception("Database Query Error: " . $e->getMessage());
        }
    }

    public function delete($table, $where)
    {
        $where_string = $this->where($where);
        $sql = "DELETE FROM {$table} {$where_string}";
        $sth = $this->pdo->prepare($sql);
        foreach ($where as $key => $value) {
            $sth->bindValue(":{$key}", $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }

    public function update($table, $row_to_update, $where)
    {
        $where_string = $this->where($where);
        $set_array = [];
        foreach ($row_to_update as $key => $value) {
            $set_array [] = "$key =:{$key}";
        }
        $set_string = implode(", ", $set_array);
        $sql = "UPDATE {$table} SET {$set_string} {$where_string}";
        $sth = $this->pdo->prepare($sql);
        foreach ($where as $key => $value) {
            $sth->bindValue(":{$key}", $value);
        }
        foreach ($row_to_update as $key => $value) {
            $sth->bindValue(":{$key}", $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }
    public function insert($table, $data)
    {
        try {
            $fields = array_keys($data);
            $values = array_values($data);
            $field_string = implode(', ', $fields);
            $param_string = ':' . implode(', :', $fields);
            $sql = "INSERT INTO {$table} ({$field_string}) VALUES ({$param_string})";

            $sth = $this->pdo->prepare($sql);

            foreach ($data as $key => $value) {
                $sth->bindValue(":{$key}", $value);
            }

            $sth->execute();

            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            throw new \Exception("Database Query Error: " . $e->getMessage());
        }
    }

}