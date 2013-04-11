<?php
$start=microtime(true);

//cache server
$secondary1="http://192.168.100.107:8080/v1/AUTH_535df4145c6c4f3cbaf6194254b4bd91/";
$secondary2="http://192.168.100.105:8080/v1/AUTH_811b9a09f2744a03a28c13035420d336/";
//controller
$mainserver="location:http://192.168.100.101:8080/v1/AUTH_921d9048e43145c3968c494369068cbb/";
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
	//die();
	}
	else{//case2: object found
	$exists = true;
	$p2p105 =$secondary2.$file;
	header("location:".$p2p105);
	include "getDataFromPeer.php";
	//die();
	}

}

else{//case2: object found
	$exists = true;
	//echo "object found; send object in progress!!";
	$url =$secondary1.$file;
	header("location:".$url);
	//die();
}
$end=microtime(true);
$duration=$end-$start;
?>
<html>
<?php
echo "start".$start;
echo "end" .$end; 
$file=fopen("stats.txt","a");
echo fwrite($file,$duration."\n");
fclose($file);
?>
</html>


