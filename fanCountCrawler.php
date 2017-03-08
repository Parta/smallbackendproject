<?php
    $configs = include ('config.php');
    include ('models/FanCount.php');
    include ('models/Company.php');

    $pageId = '';
    foreach($argv as $value)
    {

        list($key, $val) = explode('=', $value);

        $key = str_replace('--','',$key);


        if($key == 'page_id')
            $pageId = $val;
    }


    //TODO extract page_id from command
    $url='https://graph.facebook.com/'.$pageId.'?access_token='.$configs->fb_api_id.'|'.$configs->fb_api_secret.'&fields=fan_count';

    $json = file_get_contents($url);

    if($json){
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

        if($id){
            $Company = new Company();
            $Company = $Company->find($id);

            if(!$Company){
                $Company = new Company();
                $Company->setCompanyName($pageId);
                $Company->setPageId($id);
                $Company->save();
            }
        }

        if($fanCount){
            $FanCount = new FanCount();
            $FanCount->setFanCount($fanCount);
            $FanCount->setPageId($id);
            $FanCount->save();
        }
    } else {
        exit("Unable to connect to find site". $pageId);
    }

?>