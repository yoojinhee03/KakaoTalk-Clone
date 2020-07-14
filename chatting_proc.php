<?php
if(!$_GET['date'])
{
	$_GET['date'] = date('Y-m-d H:i:s');
}
require_once('conn.php');
$db=$conn;
//$db = mysqli_connect('localhost','root','mirim2','chat','3307');
$db->query('SET NAMES utf8');
$res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '" && chat_group_id='.$_GET['id']);
//$res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"');
//echo 'SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"';
//echo $_GET['date'];

$data = array();
$date = $_GET['date'];

while($v = $res->fetch_array(MYSQLI_ASSOC))
{
	$data[] = $v;
	$date = $v['date'];
}

echo json_encode(array('date' => $date, 'data' => $data));
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