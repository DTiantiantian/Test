<?php
include("conn.php");
// $json=$_GET ['json'];
$json = file_get_contents ( 'php://input' );
$obj = json_decode ( $json );
// echo $json;
// Save

$result = mysql_query ( "INSERT INTO emp_info VALUES ('".$obj->{'empNo'}."', 
		'".$obj->{'pass'}."', '".$obj->{'name'}."', '".$obj->{'sex'}."', '".$obj->{'nation'}."', 
		'".$obj->{'borthdate'}."', '".$obj->{'address'}."', '".$obj->{'phone'}."', 
		'".$obj->{'email'}."', '".$obj->{'department'}."', '".$obj->{'position'}."', 
		'".$obj->{'entrytime'}."')" );

$result1 = mysql_query("INSERT INTO user  VALUES (null, '".$obj->{'empNo'}."', '".$obj->{'pass'}."', '".$obj->{'status'}."')");

if ($result && $result1) {
	$response ["success"] = 0;
} else {
	$response ["success"] = 1;
}

header ( 'Content-type: application/json' );
echo json_encode ( $response );

?>