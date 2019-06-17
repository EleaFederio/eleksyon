<!DOCTYPE html>
<?Php

	include "connection.php";
	session_start();

unset ($_SESSION['userid']);
unset ($_SESSION['username']);
unset ($_SESSION['usercourse']);

$err="";
if(isset($_GET['voted'])==5){
	$err="This is a rare case but your vote is not casted for the reason is that while you are on the process of the selection of your candidate, someone already casted your vote... it may be your seatmate or someone who knew/look upon your code before you logged in, contact a authorized person for this, but again it is your responsibility to have your code as personal as possible.";
}
if(isset($_GET['voted'])==4){
	$err="Unable to comply, Session has been expired, login again";
}
if(isset($_GET['voted'])==1){
	$err="Your Vote/s has been casted... Thank you for voting...";
}
$alter=0;
if(isset($_POST['Submit']) == "LogIn"){
	
	$user = mysql_real_escape_string($_POST['code']);
	
	$check = 2;
	//-----------------------------emar---
	$q = mysql_query("select `password`,`admin` from `settings` where `id`='1' LIMIT 1");
	$LOG = mysql_fetch_array($q);
	//----------------------------emar----
	if($user==$LOG['password']){
		$_SESSION['userid']="00000001";
		$_SESSION['username']=$LOG['admin'];
		$_SESSION['usercourse']="Admin";
		header("Location:admin.php");
		die;	
	}
	
	if ($user == ""){
		$check = 1;
		$err = "Username must not be blank";
	}

}

if(isset($check) == 2){
	$sql=mysql_query("SELECT * FROM studentlist");
	
	while($row=mysql_fetch_array($sql)){
		
		if($row['studID'] == $user){
				if ($row['status']==1){
					$err= $row['lname'] . ", ". $row['fname']." already voted. Started at ". $row['timestart']. " ended at " . $row['timeend'];
					$alter=1;
				}
				else{
				$_SESSION['userid'] = $row['studID'];
				$_SESSION['username'] = $row['lname'] . ", " . $row['fname'];
				$_SESSION['usercourse'] = $row['Course']. "-" . $row['year'] ;
				
				mysql_query("UPDATE `studentlist` SET `timestart`=NOW() WHERE `studID`=$user LIMIT 1");
				
				header("location:votecast.php");
				die;
				
				}
		}
		else{
			if($alter==0)$err = "Invalid Code";
		}
			
	}
	
}	





?>