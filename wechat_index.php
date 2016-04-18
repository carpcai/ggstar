<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "twwechat");
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
		//echo file_put_contents("test.txt","Hello World. Testing!$postStr");

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
				$MsgType =$postObj->MsgType;
				$Event=$postObj->Event;
				$EventKey=$postObj->EventKey;
                $time = time();
                $textTpl = "<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
		<FromUserName><![CDATA[%s]]></FromUserName>
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[news]]></MsgType>
		<ArticleCount>1</ArticleCount>
		<Articles>
		<item>
		<Title><![CDATA[%s]]></Title>
		<Description><![CDATA[%s]]></Description>
		<PicUrl><![CDATA[]]></PicUrl>
		<Url><![CDATA[%s]]></Url>
		</item>
		</Articles>
		</xml>";
				if(!empty( $keyword )||!empty($Event))
                {
					if($keyword == '投票'||$keyword == '莞工之星'||$keyword == 'vote'||$EventKey =='vote')
					{
						$con = mysql_connect("localhost","root","twdataA302");
						mysql_select_db("vote", $con);
						$state=mysql_query("INSERT INTO tw_wechat (openid) VALUES ('{$fromUsername}')");
						if(!$state)
						{
							mysql_select_db("vote", $con);
							$result=mysql_query("SELECT student_id FROM tw_wechat where openid=('{$fromUsername}')");
							$row = mysql_fetch_array($result);
							mysql_close($con);
							if($row[0])
								{
								$Title="2016年莞工之星投票网站";
								$Description="点我进入莞工之星投票页面";
								$Url="tw.dgut.edu.cn/twwechat/Function/2016ggstar/index.php/Home/Index/index/openid/{$fromUsername}";
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$Title, $Description,$Url);
								echo $resultStr;
								}
							else
								{
								$Title="登录中央认证系统";
								$Description="点我进入东莞理工学院中央认证系统";
								$Url="tw.dgut.edu.cn/twwechat/Function/2016ggstar/index.php/Home/Login/index/openid/{$fromUsername}";
								$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$Title, $Description,$Url);
								echo $resultStr;
								}
							}
						else
							{
							$Title="登录中央认证系统";
							$Description="点我进入东莞理工学院中央认证系统";
							$Url="tw.dgut.edu.cn/twwechat/Function/2016ggstar/index.php/Home/Login/index/openid/{$fromUsername}";
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$Title, $Description,$Url);
							echo $resultStr;
						}
					}

					else if($MsgType=="event")
					{
						switch ($Event){
							case "subscribe":
							$Title ="欢迎";
						$Description="你好,欢迎关注莞工青年!";
						$Url="";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$Title, $Description,$Url);
						echo $resultStr;
								break;
							default:

						}
					}
					else
					{
						$Title ="感谢你的留言。";
						$Description="小编会尽快回复的";
						$Url="";
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time,$Title, $Description,$Url);
						echo $resultStr;
					}
                }

				else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }

	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
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
