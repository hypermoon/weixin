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
            
                $urlTpl = "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[%s]]></MsgType>
                <Title><![CDATA[%s]]></Title>
                <Description><![CDATA[%s]]></Description>
                <Url><![CDATA[%s]]></Url>
                <FuncFlag>0</FuncFlag>
                </xml>"; 
                
                //<MsgId>0</MsgId>
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
                        
                          //"url":  "http://47.92.4.96:8080/example/#button"
                          //$url = "http://www.sohu.com";
                          //echo "<script language='javascript' type='text/javascript'>";
                          //echo "window.location.href='$url'";
                          //echo "</script>";
                         
                          echo $resultStr;
                          exit;
                     }

                     if($form_Event=="CLICK")
                     {
                           $form_Eventkey = $postObj->EventKey;
                           if($form_Eventkey == "mpGuide") 
                           {
                               $msgType ="text";
                               $contentStr="欢迎点击查询";
                               $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
                               echo $resultStr;
                               exit;
                           }
                     }
                }

              if(!empty( $keyword ))  //text
                {
                  $msgType = "text";
                  $contentStr = "欢迎使用疏浚会议助手!";
                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                          

                  //$msgType ="link";
                  //$title = "newurl";
                  //$desc  = "sohu";
                  //$url = "http://www.sohu.com";
                  //$resultStr = sprintf($urlTpl,$fromUsername,$toUsername,$time,$msgType,$title,$desc,$url);
                  
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
            
               }
           }
          else {
             echo "不支持的格式!";
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
