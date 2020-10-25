<?php
# cpanel4 - Accounting.php.inc              Copyright(c) 1999-2002 John N. Koston
#                                 All rights Reserved.
# nick@cpanel.net              http://cpanel.net         
# 
# This file is governed by the cPanel license


global $cpanelaccterr;


function suspend ($host,$user,$accesshash,$usessl,$suspenduser) {
	$result = whmreq("/scripts/remote_suspend?user=${suspenduser}",$host,$user,$accesshash,$usessl);
	if ($cpanelaccterr != '') { return; }
	return $result;
}
function unsuspend ($host,$user,$accesshash,$usessl,$suspenduser) {
	$result = whmreq("/scripts/remote_unsuspend?user=${suspenduser}",$host,$user,$accesshash,$usessl);
	if ($cpanelaccterr != '') { return; }
	return $result;
}
function killacct ($host,$user,$accesshash,$usessl,$killuser) {
	$result = whmreq("/scripts/killacct?user=${killuser}&nohtml=1",$host,$user,$accesshash,$usessl);
	if ($cpanelaccterr != '') { return; }
	return $result;
}
function showversion ($host,$user,$accesshash,$usessl) {
	$result = whmreq('/scripts2/showversion', $host, $user, $accesshash, $usessl);
	if ($cpanelaccterr != '') { return; }
	return $result;
}
function createacct ($host,$user,$accesshash,$usessl,$acctdomain,$acctuser,$acctpass,$acctplan) {
	$result = whmreq("/scripts/wwwacct?remote=1&nohtml=1&username=${acctuser}&password=${acctpass}&domain=${acctdomain}&plan=${acctplan}",$host,$user,$accesshash,$usessl);
	if ($cpanelaccterr != '') { return; }
	return $result;
}

function listaccts ($host,$user,$accesshash,$usessl) {
	$result = whmreq('/scripts2/listaccts?nohtml=1&viewall=1', $host, $user, $accesshash, $usessl);
	if ($cpanelaccterr != '') { return; }

        $page = split("\n",$result);
	foreach ($page as $line) {
		[$acct,$contents] = split('=', $line);
		if ($acct != '') {
            $allc         = split(',', $contents);
			$accts[$acct] = $allc;
		}
        }
        return($accts);
}
function listpkgs ($host,$user,$accesshash,$usessl) {
	$result = whmreq('/scripts/remote_listpkg', $host, $user, $accesshash, $usessl);
	if ($cpanelaccterr != '') {
        return; }


        $page = split("\n",$result);
	foreach ($page as $line) {
		[$pkg,$contents] = split('=', $line);
		if ($pkg != '') {
            $allc       = split(',', $contents);
			$pkgs[$pkg] = $allc;
		}
        }
        return($pkgs);
}
function whmreq ($request,$host,$user,$accesshash,$usessl) {


	$cleanaccesshash = preg_replace("'(\r|\n)'",'',$accesshash);
        $authstr = $user . ':' . $cleanaccesshash;
	$cpanelaccterr = '';


	if (function_exists('curl_init')) {
        $ch = curl_init();
		if ($usessl) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);                
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
			curl_setopt($ch, CURLOPT_URL, "https://${host}:2087" . $request);
		} else {
			curl_setopt($ch, CURLOPT_URL, "http://${host}:2086" . $request);
                }
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	        $curlheaders[0] = "Authorization: WHM $authstr";
                curl_setopt($ch,CURLOPT_HTTPHEADER,$curlheaders);
		$data=curl_exec ($ch);
		curl_close ($ch);
	} elseif (function_exists('socket_create')) {
        if ($usessl) {
			$cpanelaccterr = 'SSL Support requires curl';
            return;
		}
		$service_port = 2086;
		$address = gethostbyname($host);
		$socket = socket_create (AF_INET, SOCK_STREAM, 0);
		if ($socket < 0) {
		        $cpanelaccterr = 'socket_create() failed';
            return;
		}
		$result = socket_connect ($socket, $address, $service_port);
		if ($result < 0) {
		        $cpanelaccterr = 'socket_connect() failed';
            return;
		}
		$in = "GET $request HTTP/1.0\n";
		socket_write($socket,$in,strlen($in));	
		$in = "Connection: close\n";
		socket_write($socket,$in,strlen($in));	
		$in = "Authorization: WHM $authstr\n\n\n";
		socket_write($socket,$in,strlen($in));	
	
		$inheader = 1;
		while(($buf = socket_read($socket, 512)) !== false) {
		  if (!$inheader) {
			  $data .= $buf;
	          }
		  if(preg_match("'\r\n\r\n$'s", $buf)) {
			$inheader = 0;
		  }
		  if(preg_match("'\n\n$'s", $buf)) {
			$inheader = 0;
		  }
		  if(preg_match("'\r\n$'s", $buf)) {
			$inheader = 0;
		  }
		}

	} else {
		$cpanelaccterr = 'php not compiled with --enable-sockets OR curl';
        return;
	}

	return $data;	
}


