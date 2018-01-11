<?php
/**
  * wechat php test
  */
//define your token
define("TOKEN", "weixin");
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
                <MsgId><![CDATA[%s]]></MsgId>
                </xml>"; 
             
                if($form_MsgType =="event")
                {
                     //get event type
                     $form_Event = $postObj->Event;
                     //subscribe
                     if($form_Event=="subscribe")
                     {
                          $msgType ="text";
                          $contentStr="欢迎关注anson测试号【玫瑰】[玫瑰]";
                          $resultStr = sprintf($textTpl,$fromUsername,$toUsername,$time,$msgType,$contentStr);
                  



                          echo $resultStr;
                          exit;
                     }
                }



              if(!empty( $keyword ))  //text
                {
                  //$msgType = "text";
                 // $contentStr = "Welcome to wechat worlds!";
                 // $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                  

                  $msgType ="link";
                  $title = "newurl";
                  $desc  = "sohu";
                  //$url = "http://www.sohu.com";
                  $url = "http://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1418702138&token=&lang=zh_CN";
                  $msg = 6429543038687618759;
                  $resultStr = sprintf($urlTpl,$fromUsername,$toUsername,$time,$msgType,$title,$desc,$url,$msg);
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
