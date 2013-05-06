<?php
require_once 'ResponseViewClass.php';
require_once dirname(dirname(__FILE__)).'/Controller/Controller.php';

class UserView
{
	public static $postObj;
	public function main()
	{
		$postData = $GLOBALS["HTTP_RAW_POST_DATA"];
		if(!empty($postData))
		{
			self::$postObj  = simplexml_load_string($postData, 'SimpleXMLElement', LIBXML_NOCDATA);
			$resolve = new ResolveCommandController();
			$resolve -> sortMessageType();
		}
		else
		{
			$response = new ResponseView("指令为空！");
		}
	}
}