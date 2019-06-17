<?Php
$con = mysql_connect("localhost", "root", "adminimo");
	if(!$con){
		echo "unsuccessful connection";
		die;
	}
mysql_select_db("evoting", $con);

function Ctype($i){
	return ($i==2)?"University Student Council":"College Student Council";
}

function Ctype_Abre($i){
	return ($i==2)?"USC":"CSC";
}
function getPosName($id){
	$q = mysql_query("select `position` from `positions` where id='$id'");
	$r = mysql_fetch_array($q);
	return $r['position'];
}
$rp = mysql_query("select * from `settings`");
$l = mysql_fetch_array($rp);

$repcount = $l['repCount'];
$adminmsg = $l['msg'];
$collegeunit = $l['collegeunit'];
$c1 = $l['Chairperson'];
$c2 = $l['PollChairman'];
$c3 = $l['CoChairman'];
$c4 = $l['PollClerk'];
$c5 = $l['Member'];
$c6 = $l['StudentMember'];


$repvar = mysql_query("select `id` from `positions` where `position`='Representative' and `type`='1'");
$y = mysql_fetch_array($repvar);
$repPosID = $y['id'];



function getCName($id){
$q = mysql_query("select `cName` from `candidate` where `cID`='$id'");
$t = mysql_fetch_array($q);
return ucwords($t['cName']);
}
?>