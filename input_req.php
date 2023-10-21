<?php


$data = json_decode(file_get_contents('php://input'),true);

if ($data['command'] == 'cnf'){
	$file_cnf = $data['file_cnf'];
	$serialNumber = $data['serialNumber'];
	
	$key1    =     "keys/private_".$serialNumber.".t";
	$csr1    =     "keys/certificate_".$serialNumber.".t";
	$pubkey1 =     "keys/public_".$serialNumber.".t";
	$p_run2 =      'keys/'.$serialNumber.'.txt';
	$new_cnf_path = 'keys/'.$serialNumber.'.cnf';
	file_put_contents($new_cnf_path,$file_cnf);
	
	$a = "openssl   req -new -utf8 -nameopt multiline,utf8 -config   '$new_cnf_path'  -newkey rsa:2048 -nodes -keyout   '$key1' -out    '$csr1' ";
	$a .= PHP_EOL . "openssl rsa -in $key1 -pubout > $pubkey1" .PHP_EOL ;
	file_put_contents($p_run2,$a) ;
	$x = shell_exec($a);
	
	$res = [
		'status'=>'ok',
		'key1'=>file_get_contents($key1),
		'csr1'=>file_get_contents($csr1),
		'pubkey1'=>file_get_contents($pubkey1),
		 
	];
	
	 echo json_encode($res);
	 die();

}
