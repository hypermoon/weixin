<?php
/**
  * wechat php test
  */
//define your token
define("TOKEN", "weixintest");
$wechatObj = new wechatCallbackapiTest();
//$wechatObj->valid();
$wechatObj->responseMsg();
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
    public function responseMsg()
    {
      //get post data, May be due to the different environments
      $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
      //extract post data
      if (!empty($postStr)){
                
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $form_MsgType = $postObj->MsgType;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <Content><![CDATA[%s]]></Content>
                <FuncFlag>0</FuncFlag>
                </xml>";             
                
               if($form_MsgType =="event")
                {
                     //get event type
                     $form_Event = $postObj->Event;
                     //subscribe
                     if($form_Event=="subscribe")
                     {
                          $msgType ="text";
                          $contentStr="欢迎关注疏浚集团会议助手测试号[玫瑰]";
                          $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
                          echo $resultStr;
                          exit;
                     }
                }

              if(!empty( $keyword ))  //text
                {
                  $msgType = "text";
                  $contentStr = "欢迎使用疏浚会议助手!";
                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                  echo $resultStr;
                }
              else{                    //pictures
                 // echo "success";
                $picTpl = "<xml>
               <ToUserName><![CDATA[%s]]></ToUserName>
               <FromUserName><![CDATA[%s]]></FromUserName>
               <CreateTime>%s</CreateTime>
               <MsgType><![CDATA[%s]]></MsgType>
               <Image>
               <MediaId><![CDATA[%s]]></MediaId>
               </Image>
               <FuncFlag>0</FuncFlag>
               </xml>";             
                  $mediaid = $postObj->MediaId;
                  $msgType = "image";
                  //$contentStr = "pictures!";
                  $resultStr = sprintf($picTpl, $fromUsername, $toUsername, $time, $msgType, $mediaid);
                  echo $resultStr;
            
                    //      $msgType = "text";
            // $url= "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxd55f08e36f3eca55&secret=f3f2eb839f3c5850bdb03cbd74d0f967";
        /*  $url="https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=RQiKGlYdJytWL1aXFVbwSo7dGxSFWMkw0sMW8Fs5lyidRLC80Uxwo7egPMpvqsqBBM89hEsI9edGMwYjfn0xytkgkdHh_OeAX3C2QJ9Sz4FOybHy-cHnbnrXF30sF4v8HKNbAIAWZC";            
             $type = "image";
             $offset = "0";
             $count = "1";

            $data = '{"type":"'.$type.'","offset":"'.$offset.'","count":"'.$count.'"}';
           
           $output = file_get_contents($url);
           
          // $output = $this->get_response_post($url,$data);
                                                   // $result= $this->wxhttpsGet($url);
             $jsoninfo =json_decode($output,true);
             $ato = $jsoninfo["image_count"];
             $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $ato);
             echo $resultStr;
          */     
               }
           }
          else {
             echo "";
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
