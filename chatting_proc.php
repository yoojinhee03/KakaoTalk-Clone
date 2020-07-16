<?php

require_once('conn.php');
$db=$conn;
$db->query('SET NAMES utf8');

if($_GET['first']=='true')
{	
	// $res = $db->query('SELECT chat._id,user_id,msg,date,chat_group_id,name FROM chat,account where chat_group_id='.$_GET['id']).' && user_id=account._id group by chat._id';
	$res = $db->query('SELECT * FROM chat where chat_group_id='.$_GET['id']);
}
else{
	$res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '" && chat_group_id='.$_GET['id']);
}
	// $res = $db->query('SELECT * FROM chat where chat_group_id='.$_GET['id']);
	$data = array();
	// select user_id,name from chat,account,friend_list where user_id=account._id and friend_list._id=3 group by name,user_id;
$date = $_GET['date'];
$id;
while($v = $res->fetch_array(MYSQLI_ASSOC))
{
	$data[] = $v;
	$date = $v['date'];
	// $id = $v['user_id'];
}


echo json_encode(array('date' => $date, 'data' => $data));
//}
// $res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '" && chat_group_id='.$_GET['id']);
//$db = mysqli_connect('localhost','root','mirim2','chat','3307');

// $res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '" && chat_group_id='.$_GET['id']);
//$res = $db->query('SELECT * FROM chat where chat_group_id='.$_GET['id']);
//$res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"');
//echo 'SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"';
//echo $_GET['date'];


//echo json_encode($data));

/*
*/

/*
/////////////////////////////////////
$db_conn = mysqli_connect("localhost", "root", "mirim2", "chat");
if (!$db_conn) {
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n";
    exit();
}

$query = 'SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"';
$result = mysqli_query($db_conn, $query);
*/
?>