<?Php
include "connection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<META HTTP-EQUIV=Refresh CONTENT="5">-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?Php
$id=$_GET['id'];

$ssql = mysql_query("SELECT * FROM studentlist WHERE studID='$id'");
$srow = mysql_fetch_assoc($ssql);

echo $srow['lname'] . ", " . $srow['fname']. " ". $srow['mname'];
echo "<br>" . $srow['Course'] . "-" . $srow['year'] . $srow['section'];
?>

	<table border="0" class="table1">
  	<tr>
    	<th class="th1">#</th>
    	<th class="th1">Position</th>
    	<th class="th1">Voted</th>
  	</tr>

	<?Php
	$num=0;
	$votesql=mysql_query("SELECT * FROM votes WHERE studID='$id'");
	while($voterow=mysql_fetch_array($votesql)){
		$cID=$voterow['cID'];
		$csql=mysql_query("SELECT * FROM candidate WHERE cID='$cID'");
		while($crow=mysql_fetch_array($csql)){
		$num++;
		?>
			<tr>
            	<td class="td1"><?Php echo $num;?></td>
                <td class="td1"><?Php echo getPosName($crow['cPosition']);?></td>
                <td class="td1"><?Php echo $crow['cName'];?></td>
            </tr>
        <?Php
		}
	}
	?>


</table>

	

</body>
</html>
