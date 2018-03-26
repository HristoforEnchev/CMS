<?php

$db['db_host'] = "localhost";
$db['db_user'] = "forkonet_cmsuser";
$db['db_pass'] = "Z$.?EhzHS2{(";
$db['db_name'] = "forkonet_cms_edwin";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$connection){
    echo "Connection to db failed!";
}

?>