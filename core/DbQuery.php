<?php
require_once "DB.php";
class DatabaseOperations extends DatabaseConnection {
    public function select($table, $columns = array(), $conditions = array(), $joins = array(),$addition='') {
        $query = "SELECT ";

        if (empty($columns)) {
            $query .= "*";
        } else {
            $query .= implode(", ", $columns);
        }

        $query .= " FROM $table";

        if (!empty($joins)) {
            foreach ($joins as $join) {
                $query .= " $join";
            }
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        if ($addition !== null) {
            $query .= $addition;
        }

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "SELECT query failed: " . $e->getMessage();
            return false;
        }
    }

    public function update($table, $data, $conditions) {
        $set = array();
        foreach ($data as $column => $value) {
            $set[] = "$column = :$column";
        }

        $setClause = implode(", ", $set);
        $whereClause = implode(" AND ", $conditions);

        $query = "UPDATE $table SET $setClause WHERE $whereClause";

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            echo "UPDATE query failed: " . $e->getMessage();
            return false;
        }
    }

    public function delete($table, $conditions) {
        $whereClause = implode(" AND ", $conditions);

        $query = "DELETE FROM $table WHERE $whereClause";

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "DELETE query failed: " . $e->getMessage();
            return false;
        }
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($values)";

        try {
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            echo "INSERT query failed: " . $e->getMessage();
            return false;
        }
    }
}
