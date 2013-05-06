<?php
include "./ResolveCommand/ResolveCommandClass.php";
function main()
{
	session_start();
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
	$commandObj = new ResolveCommandClass( $postStr );
}
main();