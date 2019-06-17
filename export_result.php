<?Php
include "connection.php";
session_start();
if(!isset($_SESSION['userid'])){
echo "Invalid User";
echo "<a href='index.php'>Back</a>";
die;

}
$uid = $_SESSION['userid'];
if ($uid!="00000001"){
	echo "Your account is not allowed for this page";
	echo "<a href='index.php'>Back</a>";
	die;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--<META HTTP-EQUIV=Refresh CONTENT="5">-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Result</title>
<link rel="stylesheet" href="css/style.css" />
<script>
window.print();
</script>
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

<table  border="1" class="" width="100%" align="center" cellspacing='0'>
  <tr>
    <tD colspan="2" align="center" >
	<B style="letter-spacing:10px;font-family:georgia">BICOL UNIVERSITY</b><br /> 
	<u><?php echo $collegeunit;?></u> <br />
	College/Unit <br />
	<br />
	<h2>SUMMARY OF ELECTION RETURNS <br />
	
	</h2>
	</td>
  </tr>

  <tr>
	<td valign="top" style="width:50%">
	<h3>College Student Council</h3>
		<table border="1" width="100%" cellspacing="0">
				<thead>
								<th class="a">CANDIDATE NAME</th>
								<th class="ten-percent">TOTAL</th>
								<th class="b ">TOTAL IN WORDS</th>
								<th class="c">PARTY</th>
				</thead>
			<?php 
				$q = mysql_query("select `id`,`position` from positions where type='1'");
				while($r = mysql_fetch_array($q)){ ?>
				<tr>
					<td colspan="5">
					<span class="pos"><?php echo $r['position']?></span>
						<table width="100%" cellspacing="0" border="1"  class="table1 candis">
		
							<?php
								$q1 = mysql_query("select * from `candidate` where cPosition='$r[id]' order by `cVotes` DESC");
								while($row = mysql_fetch_array($q1)){ ?>
								<tr>
									<td class="a"><?php echo ucwords($row['cName'])." (".$row['cAlias'].")";?></td>
									<td class="ten-percent"><?php echo ucwords($row['cVotes']);?></td>
									<td class="b"><?php echo convert_number($row['cVotes']);?></td>
									<td class="c"><?php echo $row['cVotes'];?></td>
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
	<tr>
	<td valign="top" style="width:50%">
	<h3>University Student Council</h3>
		
		<table border="1" width="100%" cellspacing="0">
				<thead>
								<th class="a">CANDIDATE NAME</th>
								<th class="ten-percent">TOTAL</th>
								<th class="b ">TOTAL IN WORDS</th>
								<th class="c">PARTY</th>
				</thead>
			<?php 
				$q = mysql_query("select `id`,`position` from positions where type='2'");
				while($r = mysql_fetch_array($q)){ ?>
				<tr>
					<td colspan="5">
					<span class="pos"><?php echo $r['position']?></span>
						<table width="100%" cellspacing="0" border="1"  class="table1 candis">
		
							<?php
								$q1 = mysql_query("select * from `candidate` where cPosition='$r[id]' order by `cVotes` DESC");
								while($row = mysql_fetch_array($q1)){ ?>
								<tr>
									<td class="a"><?php echo ucwords($row['cName'])." (".$row['cAlias'].")";?></td>
									<td class="ten-percent"><?php echo ucwords($row['cVotes']);?></td>
									<td class="b"><?php echo convert_number($row['cVotes']);?></td>
									<td class="c"><?php echo $row['cVotes'];?></td>
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
</table>
<table width="100%">
	<tr>
		<td colspan="3">WE HEREBY CERTIFY THAT THE ABOVE RESULTS ARE TRUE AND CORRECT.</td>
	</tr>
	<tr>
		<td colspan="3" style="text-align:center"><b>COLLEGE STUDENT ELECTORAL BOARD</b></td>
	</tr>
	<tr>
		<td style="text-align:center;height:90px"> <?php if($c1 != ""){?><u><?php echo strtoupper($c1);?></u> <br /> Chairperson<?php } ?></td>
		<td style="text-align:center;height:90px">  <?php if($c3 != ""){?><u><?php echo strtoupper($c3);?></u> <br /> Co - Chairman<?php } ?></td>
		<td style="text-align:center;height:90px">  <?php if($c5 != ""){?><u><?php echo strtoupper($c5);?></u> <br /> Member<?php } ?></td>
	</tr>
	<tr>
		<td style="text-align:center;">  <?php if($c2 != ""){?><u><?php echo strtoupper($c2);?></u> <br /> Poll Chairman<?php } ?></td>
		<td style="text-align:center;">  <?php if($c4 != ""){?><u><?php echo strtoupper($c4);?></u> <br /> Poll Clerk<?php } ?></td>
		<td style="text-align:center;">  <?php if($c5 != ""){?><u><?php echo strtoupper($c6);?></u> <br /> Student Member<?php } ?></td>
	</tr>

</table>
<br />
<br />
<table align="left" style="text-align:left" width="500px" >
<tr>
	<th >A. Total No of Registered Student/Voters</th>
    <td style="border-bottom:1px solid black">
    <?Php 
	$totsql=mysql_query("SELECT studID FROM studentlist");
	echo mysql_num_rows($totsql);
	?>
    </td>
</tr>
<tr>
	<th >B. Total No of Students who actually voted</th>
    <td style="border-bottom:1px solid black">
    <?Php 
	$didsql=mysql_query("SELECT studID FROM studentlist WHERE status='1'");
	echo mysql_num_rows($didsql);
	?> 
    </td>
</tr>
<tr>
	<th >C. Total No of Students who did not vote</th>
    <td  style="border-bottom:1px solid black">
    <?Php 
	$didnotsql=mysql_query("SELECT studID FROM studentlist WHERE status='0'");
	echo mysql_num_rows($didnotsql);
	?>
    </td>
</tr>
<tr>
	<th >D. Voters Turn Out (B/A x 100)</th>
    <td  style="border-bottom:1px solid black">
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