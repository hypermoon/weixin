<?php
/**
  * wechat php test
  */
//define your token
define("TOKEN", "weixintest");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$file_info = array(
      'filename' => 'material/glass.jpg',
      'content-type'=>'image/jpg',
      'filelength' => 7525
);
$access_token = "AtLIVKWam00_vJXWHpv4j5PfSnu4f94I_oeIP9VcIUjehQnSJt_9r0c_Ith8Rs_9UOf7Xghsc--a_SFcIU3mM3St0qbsOOVglxn3xJ2asDlzEYDC56yJHBD3cwdFL93yEADeAEAWSV";
//$wechatObj->responseMsg();
$wechatObj->upload_material($file_info,$access_token);
class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        //valid signature , option
        if($this->checkSignature()){
        echo $echoStr;
        exit;
        }
    }
    public function get_response_post($url,$data)
    {
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_HEADER,0);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;

    }
    public function upload_material($file_info,$access_token)
    {
          $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token={$access_token}&type=image";
          $ch1 = curl_init();
          $timeout = 5;
          $real_path="{$file_info['filename']}";
          $data=array("media" =>"@{$real_path}",'form-data'=>$file_info);
          curl_setopt($ch1,CURLOPT_URL,$url);
          curl_setopt($ch1,CURLOPT_POST,1);
          curl_setopt($ch1,CURLOPT_RETURNTRANSFER,1);
          curl_setopt($ch1,CURLOPT_CONNECTTIMEOUT,$timeout);
          curl_setopt($ch1,CURLOPT_SSL_VERIFYPEER,FALSE);
          curl_setopt($ch1,CURLOPT_SSL_VERIFYHOST,false);
          curl_setopt($ch1,CURLOPT_POSTFIELDS,$data);
          $result = curl_exec($ch1);
          echo '<br/>';
          echo 'result is =========>'.$result;
          curl_close($ch1);
          if(curl_errno() ==0)
          {
           $result = json_decode($result,true);
           return $result['media_id'];
          }
          else
          {
            return false;
          } 
    }   

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
       
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
         return true;
        }else{
         return false;
        }
     }
  }  
?>
