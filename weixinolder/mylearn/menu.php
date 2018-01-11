<?php
$APPID="wxd55f08e36f3eca55";
$APPSECRET="057dd6ed6ad0d0cb68052ea4bc9927e1";

$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

$json=file_get_contents($TOKEN_URL);
$result=json_decode($json,true);
print_r($result);

?>
