<?php

$ticket=$track=$tracklist=$json_track=$tracklist_list="";
// create curl resource
$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/access/ticket");
curl_setopt($ch, CURLOPT_POSTFIELDS,
"username=api-auditor@pmg&password=S]S2V8-ay2B\}Hev");
//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);
$json_output= json_decode($output,true);
//   var_dump($json_output["data"]);
$ticket= $json_output["data"]["ticket"];
// close curl resource to free up system resources
curl_close($ch);   
// var_dump($ticket);
// var_dump($_POST['sender']);
$domainarray=[];
$test= curl_init();

curl_setopt($test, CURLOPT_URL, "https://mx-01.accessworld.net:8006/api2/json/config/ruledb/rules/4");
curl_setopt($test, CURLOPT_HTTPHEADER, array("Cookie: PMGAuthCookie=$ticket"));
curl_setopt($test, CURLOPT_RETURNTRANSFER, 1);
$testlist = curl_exec($test);
curl_close($test);
// $json_string = json_encode($testlist, JSON_PRETTY_PRINT);
echo $testlist;
// $json_test= json_decode($testlist,true);
// echo "<pre>";

// $domainslist_list= $json_track['data'];
// var_dump($domainslist_list);
// foreach($domainslist_list as $domainlist){
//  array_push($domainarray,$domainlist['domain']);
// }


?>