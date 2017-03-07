<?php

    $configs = include ('config.php');
    include ('models/FanCount.php');

    //TODO extract page_id from command
    $url='https://graph.facebook.com/'.'cocacola'.'?access_token='.$configs->fb_api_id.'|'.$configs->fb_api_secret.'&fields=fan_count';

    $json = file_get_contents($url);
    $data = json_decode($json,true);
    $id;
    $fanCount;

    foreach($data as $key=>$value){
        if($key=='id')
            $id=$value;
        else if ($key=='fan_count'){
            $fanCount=$value;
        }
    }

    if($fanCount){
        $FanCount = new FanCount();
        $FanCount->setFanCount($fanCount);
        $FanCount->setPageId($id);
        $FanCount->save();
    }


?>