<?php

class JsonBuilder {

    static function getLineChartJson($data){
        $dataEntries = [];

        foreach($data as $fanCount){
            array_push($dataEntries, array('value' => $fanCount->getFanCount(), 'date' => $fanCount->getCreatedAt()));
        }

        $jsonObj = ['error' => false, 'data' => $dataEntries];

        return json_encode($jsonObj);
    }

    static function  getMultiplePageJson($data){
        $dataEntries = array();

        foreach($data as $fanCount){
            $companyName = $fanCount->getCompanyName();
            if($companyName){
                if(array_key_exists($companyName, $dataEntries)) {
                    array_push($dataEntries[$companyName], array('value' => $fanCount->getFanCount(), 'date' => $fanCount->getCreatedAt()));
                }else{
                    $dataEntries[$companyName] = [];
                    array_push($dataEntries[$companyName], array('value' => $fanCount->getFanCount(), 'date' => $fanCount->getCreatedAt()));
                }
            }
        }

        $jsonObj = ['error' => false, 'data' => $dataEntries];
        return json_encode($jsonObj);
    }

    static function  getTableJson($data){
        $dataEntry = array();

        foreach($data as $fanCount){
            $dataEntry[$fanCount->getCreatedAt()] = $fanCount->getFanCount();
        }

        $jsonObj = ['error' => false, 'data' => $dataEntry];

        return json_encode($jsonObj);
    }
}