<?php
$startTime=time();

//cache server
$secondary2="http://192.168.100.107:8080/v1/AUTH_01ee8500ec164df69a6259f56922060a/";
$secondary1="http://192.168.100.105:8080/v1/AUTH_78d32c470d9c4067b7937d3a13522213/";
//controller
$mainserver="location:http://192.168.100.101:8080/v1/AUTH_8a83b604a425403c9532d316cab236ef/";
//get request from URL
$file=$_REQUEST['url'];
$chunks=spliti("/",$file,2);
$container_name=$chunks[0];
$file_name=$chunks[1];
//Http response
$file_headers=@get_headers($secondary1.$file);
//case1: object not found
if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
	$exists = false;
	//update cache
	$chunks_http=spliti(":",$secondary2.$file,2);
	$urlmain=$chunks_http[1];
	//for P2P
	$file_p2p=@get_headers($secondary2.$file);
	if($file_p2p[0] == 'HTTP/1.1 404 Not Found'){
	$exists = false;
	$chunks_http=spliti(":",$mainserver.$file,2);
	$urlmain=$chunks_http[1];
	header($mainserver.$file);
	include "pr_p2psshAccess.php";
	include "pr_sshAccess.php";
	die();
	}
	else{//case2: object found
	$exists = true;
	$p2p107 =$secondary2.$file;
	header("location:".$p2p107);
	include "getDataFromPeer.php";
	die();
	}

}

else{//case2: object found
	$exists = true;
	//echo "object found; send object in progress!!";
	$url =$secondary1.$file;
	header("location:".$url);
	die();
}
$endTime=time();
$dur=$endTime-$startTime;
ob_start(file_put_contents('timetest.htm',$dur));
ob_end_flush();
?>

