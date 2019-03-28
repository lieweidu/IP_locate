<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
		<title></title>
	</head>
	<body>
		<img src ="pic.php"/>
	</body>
</html>

<?php
function get_ip()
{
	static $ipFrom = ['HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR'];
	foreach ($ipFrom as $key) {
		if (array_key_exists($key, $_SERVER)) {
			foreach (explode(',', $_SERVER[$key]) as $ip) {
				$ip = trim($ip);
				if ((bool) filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
					return $ip;
				}
			}
		}
	}
	return  '127.0.0.1';
}

$ip = get_ip();
$from = $_SERVER['HTTP_REFERER'];
$client = $_SERVER['HTTP_USER_AGENT'];
$link = mysqli_connect('localhost','root','x','x')or die("connetion failed".mysqli_error()); //change password
$sqlstatement = "insert into user_from values ('$ip','$from','$client');";
$sql=mysqli_query($link,$sqlstatement);

mysql_free_result($sql);
mysql_close($link);
?>



<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
		<title></title>
	</head>
	<body>
		<img src ="pic.php"/>  <!-- create pic -->
	</body>
</html>

