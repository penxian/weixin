<?php
require_once 'DataBaseConnectModelClass.php';
require_once dirname(dirname(__FILE__)).'/View/View.php';

class UserModel
{
	private $conn;
	private $Db;
	function __construct()
	{
		$this -> Db = new DatabaseConnectModel();
		$this -> conn = $this -> Db -> startConnect();
	}
	function __destruct()
	{
		$this -> Db -> closeConnect($this -> conn);
	}
	public function addUser()
	{
		$sql = "INSERT INTO `user` (wx_id, session) VALUES ('".UserView::$postObj -> FromUserName."', '1')";
		mysql_query($sql) or die(mysql_error());
	}
	public function changeSession( $sessioncontent )
	{
		$sql = "UPDATE `user` SET `session` = '".$sessioncontent."' WHERE `wx_id` = '".UserView::$postObj -> FromUserName."' LIMIT 1";
		mysql_query($sql);
	}
	public function getSession()
	{
		$sql = "SELECT `session` FROM `user` WHERE `wx_id` = 'oW_C8jhd2LE4YIPC3XPP3VyUKV-c' LIMIT 1";
		$query = mysql_query($sql);
		$rs = mysql_fetch_array($query);
		return $rs['session'];
	}
}
// $a = new UserModel();
// $a -> getSession();