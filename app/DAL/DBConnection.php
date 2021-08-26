<?php

namespace App\DAL;

class DBConnection {

    private $connection;

    public function __construct()
    {
        $this->connection = getConnection();
    }

    public function getData($query)
    {
        $result = $this->connection->query($query);
        $rows = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    public function getSingleData($query)
    {
        $result = $this->connection->query($query);

        if ($result->num_rows > 0)
            return $result->fetch_assoc();

        return null;
    }

    public function insertData($query)
    {
        return $this->connection->query($query);
    }

    public function insertMultipleData($query)
    {
        return $this->connection->multi_query($query);
    }

    public function updateData($query)
    {
        return $this->connection->query($query);
    }

    /**
     * @return \mysqli|void
     */
    public function getConnection(): \mysqli
    {
        return $this->connection;
    }
}