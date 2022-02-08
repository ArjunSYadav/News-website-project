<?php

class homeclass
{
    private $db_name = "mysql:host=localhost;dbname=news_site";
    private $databaseName="news_site";
    private $username = "root";
    private $password = "";

    public $conn = false;
    public $mysqli = "";
    private $result = array();

    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new PDO($this->db_name, $this->username, $this->password);
            $this->conn = true;
            if ($this->mysqli->errorInfo()) {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }
        } else {

            return true;
        }
    }

    public function insert($table_n, $params = array())
    {
        if ($this->tableExit($table_n)) {

            $table_columns = implode(',', array_keys($params));
            $table_values = implode("','", $params);

            $sql = "INSERT INTO $table_n ($table_columns) VALUES ('$table_values')";
            $runsql = $this->mysqli->prepare($sql);
            if ($runsql->execute()) {
                array_push($this->result, $this->mysqli->lastInsertId());
                return true;
            } else {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }
        } else {
            return false;
        }
    }

    public function update($table_n, $params = array(), $where = null)
    {
        if ($this->tableExit($table_n)) {
            $args = array();
            foreach ($params as $key => $values) {
                $args[] = "$key = '$values'";
            }

            $sql = "UPDATE $table_n SET " . implode(',', $args);

            if ($where != null) {
                $sql .= " WHERE $where";
            }
            $runsql = $this->mysqli->prepare($sql);
            if ($runsql->execute()) {
                array_push($this->result, $runsql->rowcount());
                return true;
            } else {
                array_push($this->result, $runsql->errorInfo());
                return false;
            }
        } else {
            return false;
        }
    }


    public function select($table_n, $rows = "*", $join = null, $join_2=null, $where = null, $orderby = null, $offset=null, $limit = null)
    {
        if ($this->tableExit($table_n)) {

            $sql = "SELECT $rows FROM $table_n ";
            if ($join != null) {
                $sql .= " LEFT JOIN $join";
            }
            if ($join_2 != null) {
                $sql .= " LEFT JOIN $join_2";
            }
            if ($where != null) {
                $sql .= "WHERE $where";
            }
            if ($orderby != null) {
                $sql .= "ORDER BY $orderby";
            }
            if ($limit != null && $offset != null) {
                $sql .= "LIMIT $offset, $limit";
            }

            $querry = $this->mysqli->prepare($sql);
            $querry->execute();
            if ($querry) {
                $this->result = $querry->fetchAll(PDO::FETCH_ASSOC);
                return true;
            } else {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }
        } else {
            return false;
        }
    }

    public function delete($table_n, $where = null){
        if ($this->tableExit($table_n)) {
            $sql="DELETE FROM $table_n";
            if($where != null){
                $sql .= " WHERE $where";
            }

            $querry = $this->mysqli->prepare($sql);
            $querry->execute();
            if ($querry) {
                array_push($this->result, $querry->rowCount());
                return true;
            } else {
                array_push($this->result, $this->mysqli->errorInfo());
                return false;
            }

        }else{
            return false;
        }
    }

    public function sqlQuerry($sql)
    {

        $querry = $this->mysqli->prepare($sql);
        $querry->execute();
        if ($querry) {
            $this->result = $querry->fetchAll(PDO::FETCH_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->errorInfo());
        }
    }

    public function getResult()
    {

        $val = $this->result;
        $this->result = array();
        return $val;
    }

    private function tableExit($table_n)
    {
        $sql = "SHOW TABLES FROM $this->databaseName LIKE '$table_n'";
        $tableInDb = $this->mysqli->prepare($sql);
        $tableInDb->execute();
        if ($tableInDb) {
            if ($tableInDb->rowCount() == 1) {
                return true;
            } else {
                array_push($this->result, $table_n . "does not exist in this database. ");
                return false;
            }
        }
    }

    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli =null) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
