<?Php
session_start();
include "connection.php";
$uid = $_SESSION['userid'];
extract($_REQUEST);

if(isset($_GET['ctype'])){
	$t = $_GET['ctype'];
	$q = mysql_query("select * from `positions` where `type`='$t'");
	while($r = mysql_fetch_array($q)){ ?>
			<option value="<?php echo $r['id']?>"><?php echo $r['position'];?></option>
		<?php 
		}
die;
}
if(isset($_GET['Student'])){
	$keyword = mysql_real_escape_string($_GET['Student']);
	$q = mysql_query("select `lname`,`fname`,`mname`,`studID` from `studentlist` where `lname` LIKE '$keyword%' or `fname` LIKE '$keyword%'");
	if($keyword == ""){
		echo "<li></li>";
		die;
	}
	if(mysql_num_rows($q)){
		while($r = mysql_fetch_array($q)){ ?>
			<li><a target="_BLANK" href="studresult.php?id=<?php echo $r['studID'];?>"><?php echo  $r['lname'].", ".$r['fname'].", ".$r['mname'].": ".$r['studID']?></a></li> 
		<?php }
	}else{ ?>
		<li>No Results Found.</li>
	<?php }
die;
}

?>
