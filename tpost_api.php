<?php
header('Content-Type: application/json');

$data = '{
   "status": "all",
   "language": "TH",
   "barcode": [
       "EI217050620TH"
  ]
}';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLINFO_HEADER_OUT => true,
  CURLOPT_POST => true,
  CURLOPT_SSL_VERIFYPEER => FALSE,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Token GrUzVuLQB8PLC+OYQ/VXUxMcF4CkPUGAZ&FEDmJRAKI0FuMLNpL3KJKdTpP_JeCOY!SWH%NnR%MOJKC#ZUCNK=TKKMLrZTSdSTSw",
  ),
));

$response = curl_exec($curl);
$obj = json_decode($response);

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://trackapi.thailandpost.co.th/post/api/v1/track",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_SSL_VERIFYPEER => FALSE,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Content-Length: ".strlen($data),
    "Authorization: Token ".$obj->{'token'},
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>
