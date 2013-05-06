<?php
require_once 'UserViewClass.php';

class ResponseView
{
	private $responseMessage;
	function __construct( $responseMessage )
	{
		$this -> responseMessage = $responseMessage;
		$this -> responseTextMessage();
	}
	public function responseTextMessage()
	{
		$time = time();
		$msgType = "text";
		$contentStr = $this -> responseMessage;    
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";             
    	$resultStr = sprintf($textTpl, UserView::$postObj -> FromUserName, UserView::$postObj -> ToUserName, $time, $msgType, $contentStr);
    	echo $resultStr;
	}
}