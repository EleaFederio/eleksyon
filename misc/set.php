<?Php
$con = mysql_connect("localhost", "root", "");
	if(!$con){
		echo "unsuccessful connection";
		die;
	}
mysql_select_db("evoting", $con);

$recno=0;
$sql=mysql_query("SELECT * FROM studentlist");
while($row=mysql_fetch_array($sql)){
	$name=$row['lname'];
	$recno=$recno+1;
	$studnumber = 20121100+$recno;
	mysql_query("UPDATE `studentlist` SET `studID`='$studnumber', `Course`='BSMT', `year`='1' WHERE `lname`='$name' LIMIT 1");	
}
?>