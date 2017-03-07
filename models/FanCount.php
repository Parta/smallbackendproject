<?php

include 'Connection.php';

class FanCount
{
    private $TABLENAME = 'fan_count';
    protected $fanCount;
    protected $pageId;
    protected $createdAt;
    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new Connection();
    }

    public function findAll(){
        $sql = "SELECT * FROM $this->TABLENAME";
        $result = $this->executeQuery($sql);
        $fanCounts = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $obj = new FanCount();
                $obj->setFanCount($row['fan_count']);
                $obj->setPageId($row['fb_page_id']);
                $obj->setCreatedAt($row['created_at']);

               array_push($fanCounts, $obj);
            }
        } else {
            echo "0 results";
        }

        return $fanCounts;
    }

    public function save(){
        $sql = "INSERT INTO $this->TABLENAME (fan_count, fb_page_id) VALUES ('{$this->fanCount}', '{$this->pageId}')";
        $this->executeQuery($sql);
        return $this;
    }

    public function executeQuery($sql){
        $conn = $this->dbConnection->connect();

        $result = $conn->query($sql);
        if ($result) {
            echo "Query successfully executed!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $this->dbConnection->disconnect();
        return $result;
    }

    public function getFanCount(){
        return $this->fanCount;
    }

    public function getPageId(){
        return $this->pageId;
    }

    public function getCreatedAt(){
        return $this->createdAt;
    }

    public function setFanCount($fanCount){
        $this->fanCount = $fanCount;
    }

    public function setPageId($pageId){
        $this->pageId = $pageId;
    }

    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
    }
}