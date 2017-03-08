<?php

/**
 * Created by IntelliJ IDEA.
 * User: ericl
 * Date: 3/7/2017
 * Time: 11:32 PM
 */
class Company
{
    private $TABLENAME = 'company';
    protected $pageId;
    protected $companyName;
    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new Connection();
    }

    public function find($id){
        $sql = "SELECT * FROM $this->TABLENAME where id='{$id}'";
        $result = $this->executeQuery($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $obj = new FanCount();
                $obj->setCompany($row['name']);
                $obj->setPageId($row['id']);
                $obj->setCreatedAt($row['created_at']);

                array_push($fanCounts, $obj);
            }
        }

        return $result;
    }

    public function findAll(){
        $sql = "SELECT * FROM $this->TABLENAME";
        $result = $this->executeQuery($sql);
        $fanCounts = [];
        $obj = new FanCount();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $obj->setCompany($row['company_name']);
                $obj->setPageId($row['page_id']);
            }
        } else {
            echo "0 results";
        }

        return $obj;
    }

    public function save(){
        $sql = "INSERT INTO $this->TABLENAME (id, name) VALUES ('{$this->pageId}', '{$this->companyName}')";
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

    public function getPageId(){
        return $this->pageId;
    }

    public function setPageId($pageId){
        $this->pageId = $pageId;
    }

    public function getCompanyName(){
        return $this->companyName;
    }

    public function setCompanyName($companyName){
        $this->companyName = $companyName;
    }
}