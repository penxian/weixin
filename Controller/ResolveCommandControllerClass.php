<?php
require_once dirname(dirname(__FILE__)).'/Model/UserModelClass.php';

class ResolveCommandController
{
	public function sortMessageType()
	{
		switch (UserView::$postObj -> MsgType) 
		{
			case 'text':
				$this -> resolveTextCommand();
				break;
			case 'image':
				$response = new ResponseView("tupian");
				break;
			case 'location':
				$response = new ResponseView("diliweizhi");
				break;
			case 'link':
				$response = new ResponseView("lianjie");
				break;
			case 'event':
				$response = new ResponseView("shijian");
				break;
			default:
				$response = new ResponseView("/疑问不认识的信息类型");
				break;
		}
	}
	public function resolveTextCommand()
	{
		$userdb = new UserModel();
		switch (UserView::$postObj -> Content)
		{
			case '失物':
				$userdb -> changeSession("shiwu");
				$response = new ResponseView("你的下一条信息将被发送到失物招领平台公共主页\n(取消请回复‘取消’)");
				break;
			case '招领':
				$userdb -> changeSession("zhaoling");
				$response = new ResponseView("你的下一条信息将被发送到失物招领平台公共主页\n(取消请回复‘取消’)");
				break;	
			case '取消':
				$session = $userdb -> getSession();
				if($session != '0')
				{
					$userdb -> changeSession('0');
					$response = new ResponseView("恢复到正常模式/微笑");
				}
				else
					$response = new ResponseView("已是正常模式/微笑");
				break;
			default:
				$response = new ResponseView("不认识的指令/疑问");
				break;
		}
	}
}