<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixintest");
$wechatObj = new wechatCallbackapiTest();
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
                
				libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
				//这个event就是事件具体内容
				$event = $postObj->Event;
				
				
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";      
            
            
            
            //当用户关注我们微信时，订阅事件
            switch($postObj->MsgType)
            {
                case 'event':
				//如果是用户订阅事件
                   	if($event == "subscribe")
					{
                        $msgType = "text";
                        $contentStr = "您好，感谢您的关注！\r\n购买请回复1\r\n提取账号密码请回复2\r\n如需帮助，请留言";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;
					}
                    break;
				case 'text':
					if($keyword == "1")
					{
						//返回购买
						$goumaiTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[news]]></MsgType>
						<ArticleCount>1</ArticleCount>
						<Articles>
						<item>
						<Title><![CDATA[%s]]></Title> 
						<Description><![CDATA[%s]]></Description>
						<PicUrl><![CDATA[%s]]></PicUrl>
						<Url><![CDATA[%s]]></Url>
						</item>
						</Articles>
						</xml>";
						
						$title1 = '百度文库账号';
						$des1 = "出售一个带有财富值的账号给你，可修改密码，设置密保，立即可用，永久有效。";
						$picUrl = "http://www.tehui520.com/img/pic.png";
						$url1 = "http://www.tehui520.com";
						$resultStr = sprintf($goumaiTpl, $fromUsername, $toUsername, $time, $title1, $des1, $picUrl, $url1);
						echo $resultStr;
					}
                    else if($keyword == "2")
                    {
						
					  $link=mysql_connect('localhost:3306','root','test');
					  mysql_select_db('mydata',$link);
						  mysql_query('set names utf-8');
					
					  $sql="select * from user where num='$fromUsername'";  
					  $res=mysql_query($sql);
					  $raw1=mysql_num_rows($res);   //查看返回的条数
					  
					  if($raw1 == "0")
					  {
						  	$msgType = "text";
							$contentStr = "未查询到您的购买记录，请先购买然后再查询。";
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr; 
					  }
					  else
					  {
						  $row=mysql_fetch_row($res);

						  $msgType = "text";
						  $contentStr = "用户名：".$row[1]."\r\n"."密码：".$row[2]."\r\n"."邮箱：".$row[3]."\r\n"."邮箱密码：".$row[4];
						  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						  echo $resultStr; 
						  
						  $sql="delete from user where id=$row[0]";
						  $res=mysql_query($sql);
//						  mysql_free_result($res);
					  }
                    }
					else
					{
                        $msgType = "text";
						$contentStr = "购买请回复1，提取账号密码请回复2,如需帮助，请留言";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        echo $resultStr;						
					}
					break;   
                default:
                    break;
            }
            
            
			 /*	if(!empty( $keyword ))
                {
              		$msgType = "text";
                	$contentStr = "Welcome to wechat world!";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }   */

        }else {
        	echo "";
        	exit;
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
