<?Php
session_start();
include "connection.php";
$uid = $_SESSION['userid'];
extract($_REQUEST);

if(isset($_POST['studentname'])){
$name = explode(", ",$_POST['studentname']);
$a = $name[0];
$b = $name[1];
$c = $name[2];
	$q = mysql_query("select `studID` from `studentlist` where `lname`='$a' and `fname`='$b' and `mname`='$c'");
	$t = mysql_fetch_array($q);
	header("location:studresult.php?id=$t[studID]");
die;
}

?>
