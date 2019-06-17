<!DOCTYPE html >

<?Php
session_start();
include "connection.php";

function castvote($cID,$studID){
$vote = 1;
mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$cID')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$cID' LIMIT 1");
return 0;
}
//-------------------------------------------------------------------
//security----------------------------------------------------------
$studID=$_SESSION['userid'];


$check=mysql_query("SELECT studID, status FROM studentlist WHERE studID='$studID' AND status='1'");
if(mysql_num_rows($check)>0){
	header("Location:index.php?voted=5");
	die;
}
if($studID==""){
	header("location:index.php?voted=4");
	die;
}


extract($_POST);
//echo $studID."<br /> Votes: <br />";
if(isset($_POST['castvote'])){

for($x = 0; $x < count($csc_vote_person);$x++){
	if($csc_vote_person[$x]){
		castvote($csc_vote_person[$x],$studID);
		//echo getCName($csc_vote_person[$x])."<br>";
	}
}
for($y = 0; $y < count($representative);$y++)
	if($representative[$y]){
		castvote($representative[$y],$studID);
		//echo getCName($representative[$y])."<br>";
	}
	
}
for($z = 0; $z < count($usc_vote_person);$z++){
	if($usc_vote_person[$z]){
		castvote($usc_vote_person[$z],$studID);
		//echo getCName($usc_vote_person[$z])."<br>";
	}
}
$update = mysql_query("UPDATE `studentlist` SET `status`='1',`timeend`=NOW() WHERE `studID`=$studID LIMIT 1");
$q = mysql_query("select (timeend-timestart) as `elapse` from `studentlist` where `studID`='$studID' ");
$r = mysql_fetch_array($q);
$e = $r[0]." sec";
$update = mysql_query("UPDATE `studentlist` SET `elapsetime`='$e' WHERE `studID`=$studID LIMIT 1");


// $sql = mysql_query("select `timeend`,`timestart` from `studentlist` where studID='$studID' LIMIT 1");
// $r = mysql_fetch_array($sql);
// $s = explode(":",$r['timestart']);
// $e = explode(":",$r['timeend']);

	// $end = ($e[0]*3600)+($e[1]*60)+($e[2]);
	// $start = ($s[0]*3600)+($s[1]*60)+($s[2]);
	// $elapse = $end-$start;
	
	// die;
	 
	


unset ($_SESSION['userid']);
unset ($_SESSION['username']);
unset ($_SESSION['usercourse']);

header("location:index.php?voted=1");
die;
//------------------------------------

$check=mysql_query("SELECT studID, status FROM studentlist WHERE studID='$studID' AND status='1'");
if(mysql_num_rows($check)>0){
	header("Location:index.php?voted=5");
	die;
}

$vote=1;
$pres=$_GET['pres'];
$vpres=$_GET['vpres'];
$sec=$_GET['sec'];
$tres=$_GET['tres'];
$aud=$_GET['aud'];
$buss=$_GET['buss'];
$pio=$_GET['pio'];
if($_GET['security1']!=0)$rep1=($_GET['security1'])+14;
if($_GET['security2']!=0)$rep2=($_GET['security2'])+14;
if($_GET['security3']!=0)$rep3=($_GET['security3'])+14;
if($_GET['security4']!=0)$rep4=($_GET['security4'])+14;
if($_GET['security5']!=0)$rep5=($_GET['security5'])+14;
if($_GET['security6']!=0)$rep6=($_GET['security6'])+14;
if($_GET['security7']!=0)$rep7=($_GET['security7'])+14;
if($_GET['security8']!=0)$rep8=($_GET['security8'])+14;
if($_GET['security9']!=0)$rep9=($_GET['security9'])+14;
$chair=$_GET['chair'];
$internal=$_GET['internal'];
$external=$_GET['external'];
$secgen=$_GET['secgen'];
$depsec=$_GET['depsec'];
$fin=$_GET['fin'];
$depfin=$_GET['depfin'];
$audi=$_GET['audi'];
$busman=$_GET['busman'];
$public=$_GET['public'];

if($pres!=""){
mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$pres')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$pres' LIMIT 1");
}


if($vpres!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$vpres')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$vpres' LIMIT 1");}
if($sec!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$sec')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$sec' LIMIT 1");}
if($tres!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$tres')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$tres' LIMIT 1");}
if($aud!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$aud')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$aud' LIMIT 1");}
if($buss!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$buss')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$buss' LIMIT 1");}
if($pio!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$pio')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$pio' LIMIT 1");}
if($rep1!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep1')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep1' LIMIT 1");}
if($rep2!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep2')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep2' LIMIT 1");}
if($rep3!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep3')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep3' LIMIT 1");}
if($rep4!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep4')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep4' LIMIT 1");}
if($rep5!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep1')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep5' LIMIT 1");}
if($rep6!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep6')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep6' LIMIT 1");}
if($rep7!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep7')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep7' LIMIT 1");}
if($rep8!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep8')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep8' LIMIT 1");}
if($rep9!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$rep9')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$rep9' LIMIT 1");}

if($chair!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$chair')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$chair' LIMIT 1");}
if($internal!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$internal')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$internal' LIMIT 1");}
if($external!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$external')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$external' LIMIT 1");}
if($secgen!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$secgen')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$secgen' LIMIT 1");}
if($depsec!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$depsec')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$depsec' LIMIT 1");}
if($fin!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$fin')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$fin' LIMIT 1");}
if($depfin!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$depfin')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$depfin' LIMIT 1");}
if($audi!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$audi')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$audi' LIMIT 1");}
if($busman!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$busman')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$busman' LIMIT 1");}
if($public!=""){mysql_query("INSERT INTO votes (`studID`, `cID`) VALUES ('$studID','$public')");
mysql_query("UPDATE candidate SET cVotes=cVotes+'$vote' WHERE cID='$public' LIMIT 1");}


mysql_query("UPDATE studentlist SET status='1', `timeend`=NOW() WHERE studID='$studID' LIMIT 1");

header("Location:index.php?voted=1");

?>