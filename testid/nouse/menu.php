<?php
$APPID="wx83d36ec5c1b700a3";
$APPSECRET="8f7d9b2f72d86a67606c323b845bd93c";

$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

$json=file_get_contents($TOKEN_URL);
$result=json_decode($json,true);
print_r($result);

?>
