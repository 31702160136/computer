<?php
//
// 语音文本识别翻译
//
header("Content-Type:text/html;charset=utf-8");
define("TOKEN", "weixin");

$wechatObj = new wechatCallbackapiTest();
if (!isset($_GET['echostr'])) {
	$wechatObj->responseMsg();
}else{
    $wechatObj->valid();
}

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
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
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
       echo  $this->getTranslation("翻译 你好");
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);

            switch ($RX_TYPE)
            {
                case "text":
                    $result = $this->receiveText($postObj);
                    break;
				case "voice":
					$result = $this->receiveVoice($postObj);
					break;
            }
            echo $result;
        }else {
            echo "";
            exit;
        }
    }
    
    private function receiveText($object)
    {
        $content = $this->getTranslation($object->Content);
        $result = $this->transmitText($object, $content);
        return $result;
    }
	private function receiveVoice($object)
    {
    	$content = '';
		//如果存在语音识别结果且不为空，提取语音识别
       	if(isset($postObj->Recognition)&&!empty($postObj->Recognition)){
            $content =  $postObj->Recognition;
            $result  = $this->getTranslation($content);
        }else{
            $content =  "语音信息未识别";
        }
        $result = $this->transmitText($object, $content);
        return $result;
    }
	private function getTranslation($content){
		include_once "./Util_http.php";
		$keyword = trim($content);  //提取文本信息
        if(strstr($keyword,"翻译")){			//判断是否存在翻译关键字
        	$fanyi = str_replace("翻译",'', $keyword); //提取需要翻译的文字
			 
			$q 		= rawurldecode($fanyi);			//待翻译的文本
			$appKey	= '2234cdead2c978a2';							//appId
			$salt 	= rand(10000, 99999);			//随机字符串
			$miyao	= 'TYs3YZkjfiso0u6OC3xteI07IXLSBeAO';							//密钥
			$sign	= rawurldecode(md5($appKey.$fanyi.$salt.$miyao));	//签名	
//			$url  	= "http://openapi.youdao.com/api?from=auto&to=auto&q=$q&appKey=".$appKey."&salt=".$salt."&sign=".$sign;
			$apihost = "http://openapi.youdao.com/api?from=auto&to=auto&";
			$url_end = array('appKey'=>$appKey,'salt'=>$salt,'q'=>$q,'sign'=>$sign);
			$url 	= $apihost.http_build_query($url_end);
			
            echo $url;
			$output = https_request($url);
			$result = json_decode($output,true);
            var_dump($output);
			if($result['errorCode'] != 0){	//是否执行成功
				return $result['errorCode'];	//失败返回错误码
			}else{
				return $result['translation'][0];	//成功返回翻译结果
			}
        }else{
        	return "可发送'翻译+需要翻译的内容获取结果'";
        }
	}
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
}
?>