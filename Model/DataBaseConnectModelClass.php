<?php
class DatabaseConnectModel
{
	public function startConnect()
	{
		$conn=mysql_connect("localhost","root","herald12345678")or die('无法连接数据库: ' . mysql_error());
		mysql_select_db("lzjt");
		mysql_query("set names utf8");
		return $conn;
	}
	public function closeConnect( $conn )
	{
			mysql_close($conn);
	}
}