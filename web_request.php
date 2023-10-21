<?php


$cnf = __DIR__.'/sample_fa.cnf';
$file_cnf = file_get_contents($cnf);

$data = [
		'command'=>'cnf',
		'file_cnf'=>$file_cnf,
		'serialNumber'=>$form['serialNumber'],		
	];

$data1 = RunGetInfoMoadi('','','', 'cnf', '',$data );
print_r( );



function RunGetInfoMoadi($code,$yekta,$PrivateKey,$command = 'economic',$referenceNumber= '',$data1 = [] ){
	if(empty($command))
		 return [];
	
	$url = 'https://serverIP_or_url.com'; 
	$ch = curl_init( $url );

	 
	$payload = json_encode( $data1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
	$headers = array();
	$headers[] = 'Content-Type: application/json';
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($ch);
	
	curl_close($ch);
	$result = json_decode($result,true);		
	return $result;
}
