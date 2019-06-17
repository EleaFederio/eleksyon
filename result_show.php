<?Php
include "connection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<META HTTP-EQUIV=Refresh CONTENT="5">-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result</title>
<style type="text/css">

BODY{
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
}
.candis tr:hover{
	background:yellow;
}
</style>
</head>

<body>

<table  border="1" class="table1" width="800px" align="center">
  <tr>
    <th colspan="2" align="center" class="th1">Bicol University USC-CSC Election SY 2013-2014</th>

  </tr>
  <tr>
    <th colspan="2" align="center" class="th1">POLANGUI CAMPUS</th>

  </tr>
  <tr>
    <td colspan="2" align="center" class="td1"><?Php echo date("n/j/Y");?></td>

  </tr>

  <tr>
	<td valign="top" style="width:50%">
	<h1>College Student Council</h1>
		
		<table border="0" width="400px" cellspacing="0">
							<thead>
								<th class="th1 a">Candidate Name</th>
								<th class="th1 b">Party</th>
								<th class="th1 c">Votes</th>
							</thead>
		</table>
		<table border="0" width="400px" cellspacing="0">
			<?php 
				$q = mysql_query("select `id`,`position` from positions where type='1'");
				while($r = mysql_fetch_array($q)){ ?>
				<tr>
					<td>
					<span class="pos"><?php echo $r['position']?></span>
						<table width="100%" cellspacing="0"  class="table1 candis">
		
							<?php
								$q1 = mysql_query("select * from `candidate` where cPosition='$r[id]' order by `cVotes` DESC");
								while($row = mysql_fetch_array($q1)){ ?>
								<tr>
									<td class="td1 a"><?php echo ucwords($row['cName'])." (".$row['cAlias'].")";?></td>
									<td class="td1 b"><?php echo ucwords($row['cParty']);?></td>
									<td class="td1 c"><?php echo $row['cVotes'];?></td>
								</tr>
								<?php }
							?>
						</table>
					</td>
				</tr>	
				<?php }
			?>
		</table>
	</td>
	
	<td valign="top" style="width:50%">
	<h1>University Student Council</h1>
		<table border="0" width="400px" cellspacing="0">
							<thead>
								<th class="th1 a">Candidate Name</th>
								<th class="th1 b">Party</th>
								<th class="th1 c">Votes</th>
							</thead>
		</table>
		<table border="0" width="400px" cellspacing="0">
			<?php 
				$q = mysql_query("select `id`,`position` from positions where type='2'");
				while($r = mysql_fetch_array($q)){ ?>
				<tr>
					<td>
					<span class="pos"><?php echo $r['position']?></span>
						<table width="100%" cellspacing="0"  class="table1 candis">
		
							<?php
								$q1 = mysql_query("select * from `candidate` where cPosition='$r[id]' order by `cVotes` DESC");
								while($row = mysql_fetch_array($q1)){ ?>
								<tr>
									<td class="td1 a"><?php echo ucwords($row['cName'])." (".$row['cAlias'].")";?></td>
									<td class="td1 b"><?php echo ucwords($row['cParty']);?></td>
									<td class="td1 c"><?php echo $row['cVotes'];?></td>
								</tr>
								<?php }
							?>
						</table>
					</td>
				</tr>	
				<?php }
			?>
		</table>
	</td>
	
  </tr>
  
 <tr style="display:none">
  <td>
  <table>
  <tr>
    <th class="th1">#</th>
    <th class="th1">Name</th>
    <th class="th1">Position</th>
    <th class="th1">Tally</th>
    <th class="th1">In Words</th>
  </tr>
	<?Php
	$num=0;
	$ressql=mysql_query("SELECT * FROM candidate where cType='1' order by `cPosition` ASC,`cID` ");
	while($resrow=mysql_fetch_array($ressql)){
		$num=$num+1;
		?>
        <tr>
        	<td class="td1"><?Php echo $num;?></td>
            <td class="td1"><?Php echo $resrow['cName'];?></td>
            <td class="td1"><?Php echo getPosName($resrow['cPosition']);?></td>
            <th class="th1"><?Php echo $resrow['cVotes'];?></th>
            <td class="td1"><?Php echo convert_number($resrow['cVotes']);?></td>
        </tr>
        <?Php
	}
	?>


</table>

</td>
<td>
<table>
  
  
  
  <tr>
    <th class="th1">#</th>
    <th class="th1">Name</th>
    <th class="th1">Position</th>
    <th class="th1">Tally</th>
    <th class="th1">In Words</th>
  </tr>
	<?Php
	$num=0;
	$ressql=mysql_query("SELECT * FROM candidate  where cType='2' ");
	while($resrow=mysql_fetch_array($ressql)){
		$num=$num+1;
		?>
        <tr>
        	<td class="td1"><?Php echo $num;?></td>
            <td class="td1"><?Php echo $resrow['cName'];;?></td>
            <td class="td1"><?Php echo getPosName($resrow['cPosition']);?></td>
            <th class="th1"><?Php echo $resrow['cVotes'];;?></th>
            <td class="td1"><?Php echo convert_number($resrow['cVotes']);?></td>
        </tr>
        <?Php
	}
	?>


</table>

</td>
</tr>


<table align="center" class="table1" width="500px" >
<tr>
	<th class="th1">A. Total No of Registered Student/Voters</th>
    <td class="td1">
    <?Php 
	$totsql=mysql_query("SELECT studID FROM studentlist");
	echo mysql_num_rows($totsql);
	?>
    </td>
</tr>
<tr>
	<th class="th1">B. Total No of Students who actually voted</th>
    <td class="td1">
    <?Php 
	$didsql=mysql_query("SELECT studID FROM studentlist WHERE status='1'");
	echo mysql_num_rows($didsql);
	?>
    </td>
</tr>
<tr>
	<th class="th1">C. Total No of Students who did not vote</th>
    <td class="td1">
    <?Php 
	$didnotsql=mysql_query("SELECT studID FROM studentlist WHERE status='0'");
	echo mysql_num_rows($didnotsql);
	?>
    </td>
</tr>
<tr>
	<th class="th1">D. Voters Turn Out (B/A x 100)</th>
    <td class="td1">
    <?Php 
	$didsql=mysql_query("SELECT studID FROM studentlist WHERE status='1'");
	$totsql=mysql_query("SELECT studID FROM studentlist");
	
	
	echo number_format((mysql_num_rows($didsql) / mysql_num_rows($totsql) )*100,2,".",""). "%";
	?>
    </td>
</tr>

</table>

</body>
</html>

<?Php
function convert_number($numb)
{
	
	$numb = number_format($numb,2,".","");
	$num_arr = explode(".",$numb);
	$number = $num_arr[0];
	$decnum = $num_arr[1];
    if (($number < 0) || ($number > 999999999))
    {
        return "$number";
    }

    $Gn = floor($number / 1000000);  /* Millions (giga) */
    $number -= $Gn * 1000000;
    $kn = floor($number / 1000);     /* Thousands (kilo) */
    $number -= $kn * 1000;
    $Hn = floor($number / 100);      /* Hundreds (hecto) */
    $number -= $Hn * 100;
    $Dn = floor($number / 10);       /* Tens (deca) */
    $n = $number % 10;               /* Ones */

    $res = "";

    if ($Gn)
    {
        $res .= convert_number($Gn) . " Million";
    }

    if ($kn)
    {
        $res .= (empty($res) ? "" : " ") .
            convert_number($kn) . " Thousand";
    }

    if ($Hn)
    {
        $res .= (empty($res) ? "" : " ") .
            convert_number($Hn) . " Hundred";
    }

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen",
        "Nineteen");
    $tens = array("", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty",
        "Seventy", "Eigthy", "Ninety");

    if ($Dn || $n)
    {
        if (!empty($res))
        {
            $res .= " &amp; ";
        }

        if ($Dn < 2)
        {
            $res .= $ones[$Dn * 10 + $n];
        }
        else
        {
            $res .= $tens[$Dn];

            if ($n)
            {
                $res .= "-" . $ones[$n];
            }
        }
    }

    if (empty($res))
    {
        $res = "zero";
    }
	if($decnum > 0){
		//return $res." and ".$decnum."/100";
	}
    return $res;
	
    
}

?>