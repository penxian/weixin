<?php
class ResolveCommandClass{
	private $postObj;
	private $responseMessage;



	function __construct($postStr) 
	{
		$this -> postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
   		$this -> senddata();   
   	}
	public function sortMessageType()
	{
		switch ($this -> postObj -> MsgType) 
		{
			case 'text':
				$this -> resolveTextCommand();
				break;
			case 'image':
				$this -> responseMessage = "tupian";
				break;
			case 'location':
				$this -> responseMessage = "diliwenzhi";
				break;
			case 'link':
				$this -> responseMessage = "lianjie";
				break;
			case 'event':
				$this -> responseMessage = "shijian";
				break;
			default:
				$this -> responseMessage = "/疑问不认识的信息类型";
				break;
		}
	}
	public function resolveTextCommand()
	{
		switch ($this -> postObj -> Content)
		{
			case '失物':
				$_SESSION['currentsession'] = 'shiwu';
				break;
			case '招领':
				$_SESSION['currentsession'] = 'zhaoling';
				break;	
			case '取消':
			if(isset($_SESSION['views']))
			{
  				unset($_SESSION['currentsession']);
				$this -> responseMessage = "/微笑您已恢复到正常模式";
			}
			else
				$this -> responseMessage = "/微笑您已经是正常模式了亲";
				break;
			default:
				$this -> responseMessage = "/疑问不认识的命令哦";
				break;
		}
	}
	public function senddata()
	{
		//发送用户信息 
		$this -> sortMessageType();
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
    	$resultStr = sprintf($textTpl, $this -> postObj -> FromUserName, $this -> postObj -> ToUserName, $time, $msgType, $contentStr);
    	echo $resultStr;
	}
}