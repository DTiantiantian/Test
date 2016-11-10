<?php
include("conn.php");
// $json=$_GET ['json'];
//获取客户端传入的json数据
$json = file_get_contents ( 'php://input' );
$obj = json_decode ( $json );

$result = mysql_query ( "select * from user where name='" . $obj->{'UserName'} . "' and password='" . $obj->{'PassWord'} . "'" );
mysql_close ( $con );

/**
 *按json方式输出通信数据
 *@param integer $code 状态码
 *@param string $message 提示信息
 *@param array $data 数据
 *return string
*/

//将GB2312的中文转换成utf-8编码格式
$success = iconv("GB2312","UTF-8//IGNORE","登陆成功");
$error = iconv("GB2312","UTF-8//IGNORE","登陆失败");

header ( 'Content-type: application/json;charset=UTF-8' );

if (mysql_num_rows ( $result ) < 1) {
	$response ["success"] = 1;
	$response ["message"] = $error;
} else {
	$response ["success"] = 0;
	$response ["message"] = $success;
}

//解决json_encode出现乱码的问题
foreach ( $response as $key => $value ) {
	$newData[$key] = urlencode( $value );
// 	$newData [$key] ['message'] = urlencode ( $value ['message'] );
}

echo urldecode ( json_encode ( $newData ) );

?>