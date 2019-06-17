<?Php
session_start();
include "connection.php";

$uid = $_SESSION['userid'];
if ($uid==""){
	echo "Invalid User";
	die;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?Php echo $_GET['letter'];?></title>

<style type="text/css">
BODY{
	font-family:Verdana, Geneva, sans-serif;
	font-size:14px;
}
.table1, .td1, .th1{
	border: 1px outset #03F;
	vertical-align:text-top;
	border-collapse:collapse;
	border
}
.th1{
	background-color:#006;
	color:#FFF;
	vertical-align:text-top;
	}
</style>
<script type="text/javascript">
	function con(){
		if(confirm("Do you want to delete this entry?")==false){
			return false;
		}
	}
</script>
</head>

<body>


Students with Last Names starting with <b><?Php echo $_GET['letter'];?></b> <br />
<?php
if(isset($_GET['deletestud'])){
	$del = mysql_query("delete from `studentlist` where `studID`='$_GET[deletestud]'");
	echo "Student has been deleted.";
}
?>
<font size="-2">
<table class="table1" width="1300px">
	<tr>
    	<th class="th1">#</th>
        <th class="th1">Student Code</th>
        <th class="th1">Last Name</th>
        <th class="th1">First Name</th>
        <th class="th1">Middle Name</th>
        <th class="th1">Course</th>
        <th class="th1">Sex</th>
        <th class="th1">Status</th>
        <th class="th1">Time Start</th>
        <th class="th1">Time End</th>
	<th class="th1">Elapsed</th>
	<th class="th1">Action</th>


    </tr>

<?Php

if(isset($_GET['letter'])){
$letter=$_GET['letter'];
}
$studnum=0;
		$studsql=mysql_query("SELECT * FROM studentlist WHERE lname LIKE '$letter%' ORDER BY lname, fname ASC");
		while($studrow=mysql_fetch_array($studsql)){
			$studnum=$studnum+1;
			?>
			<tr>
            	<td class="td1"><?Php echo $studnum;?></td>
            	<td class="td1"><a href="" onClick="chw=window.open('studresult.php?id=<?Php echo $studrow['studID'];?>','NewWindow','resizable=no,scrollbars=no,status=no,width=300,height=600'); if (chw != null) chw.focus(); return false"><?Php echo $studrow['studID'];?></a> 
				</td>
                <td class="td1"><?Php echo $studrow['lname'];?></td>
                <td class="td1"><?Php echo $studrow['fname'];?></td>
                <td class="td1"><?Php echo $studrow['mname'];?></td>
                <td class="td1"><?Php echo $studrow['Course']. "-" . $studrow['year'] . " " . $studrow['section'] ;?></td>
                <td class="td1"><?Php echo $studrow['sex'];?></td>
                <td class="td1"><?Php echo $studrow['status'];?></td>
                <td class="td1"><?Php echo $studrow['timestart'];?></td>
                <td class="td1"><?Php echo $studrow['timeend'];?></td>
		<td class="td1"><?Php echo $studrow['elapsetime'];?></td>
		<td> <a onClick="return con()" href="?letter=<?php echo $letter;?>&deletestud=<?php echo $studrow['studID']?>">DELETE</a> </td>
		
            </tr>
			<?Php
		}

?>
</table>
</body>
</html>