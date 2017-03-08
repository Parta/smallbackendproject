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

    public function find($id){
        $sql = "SELECT * FROM $this->TABLENAME where id='{$id}'";
        $result = $this->executeQuery($sql);
        return $result;
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

    public function findAllCompany($companyName){
        $sql = "SELECT * FROM $this->TABLENAME INNER JOIN company ON company.id=fan_count.fb_page_id where company.name = '{$companyName}'";
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
            echo "No result for ". $companyName;
            return 0;
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
        if (!$result) {
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

    public function getCompanyName(){
        $sql = "SELECT name FROM company INNER JOIN fan_count ON company.id=fan_count.fb_page_id";
        $result = $this->executeQuery($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row['name'];
            }
        }
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