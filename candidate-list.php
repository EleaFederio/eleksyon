<?Php

session_start();

include "connection.php";
if(!isset($_SESSION['userid'])){
echo "Invalid User";
die;

}
$uid = $_SESSION['userid'];
if ($uid!="00000001"){
	echo "Your account is not allowed for this page";
	die;
}
if(isset($_GET['deleteS'])){
	$q = mysql_query("delete from `candidate` where cID='$_GET[deleteS]'");
	header("location:?deleted");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BUPC eVoting Admin</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="jquery/jquery.autocomplete.js"></script>
  <script type="text/javascript" src="jquery/custom.js"></script>
<link rel="stylesheet" href="css/jquery.autocomplete.css" type="text/css" />
<!------------------------------------------------------------------>
<style type="text/css">
</style>
<!------------------------------------------------------------------>
</head>
<body>

								<?php
									if(isset($_POST['cName'])){
										extract($_POST);
										$a = mysql_real_escape_string($cName);
										$b = mysql_real_escape_string($cParty);
										$c = mysql_real_escape_string($cAlias);
										$sql = mysql_query("update `candidate` set `cName`='$a',`cParty`='$b',`cAlias`='$c' where `cID`='$cID'");
										echo "<small style='color:gray'>The info of ".$a." has been updated.</small>";
									}
									if(isset($_GET['deleted'])){
										echo "<small style='color:gray'>Candidate Had been deleted.</small>";
									}
								?>
<table width="100%">
	<tr>
	<td valign="top" style="width:50%;border:1px solid #123">
	<h1>College Student Council</h1>
		<table border="0" width="100%" cellspacing="0">
							<thead>
								<tr>
								<th class="a">Candidate Name</th>
								<th class="b">Alias</th>
								<th class="b">Party</th>
								<th class="c">Action</th>
								</tr>
							</thead>
		</table>
		<table border="1" width="100%" cellspacing="0">
			<?php 
				$q = mysql_query("select `id`,`position` from positions where type='1'");
				while($r = mysql_fetch_array($q)){ ?>
				<tr>
					<td>
					<span class="pos"><?php echo $r['position']?></span>
						<table width="100%" cellspacing="0" border="1">
							<?php
								$q1 = mysql_query("select * from `candidate` where cPosition='$r[id]' order by `cVotes` DESC");
								while($row = mysql_fetch_array($q1)){ ?>
								<tr>
								<form action="#" method="POST">
									<td class=""> 
										<input type="hidden" name="cID" value="<?php echo $row['cID'];?>" /> 
										<input type="text" class="btn   nomargin" name="cName" value="<?php echo $row['cName'];?>" /> 
									</td>
									<td class="">
										<input type="text" class="btn nomargin" name="cAlias" value="<?php echo $row['cAlias'];?>" /> 
									</td>
									<td class=""> <input type="text" class="btn nomargin  " name="cParty" value="<?php echo $row['cParty']?>" /></td>
									<td class=""><input type="submit" class="btn btn-green noborder  " value="Save" /></td>
								</form>
									<td><a onClick="return f()" href="?deleteS=<?php echo $row['cID'];?>" class="btn btn-red">Delete</a></td>
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
	
	<td valign="top" style="width:50%;border:1px solid #123">
	<h1>University Student Council</h1>
		<table border="0" width="100%" cellspacing="0">
							<thead>
								<tr>
								<th class="a">Candidate Name</th>
								<th class="b">Alias</th>
								<th class="b">Party</th>
								<th class="c">Action</th>
								</tr>
							</thead>
		</table>
		<table border="1" width="100%" cellspacing="0">
			<?php 
				$q = mysql_query("select `id`,`position` from positions where type='2'");
				while($r = mysql_fetch_array($q)){ ?>
				<tr>
					<td>
					<span class="pos"><?php echo $r['position']?></span>
						<table width="100%" cellspacing="0" border="1">
							<?php
								$q1 = mysql_query("select * from `candidate` where cPosition='$r[id]' order by `cVotes` DESC");
								while($row = mysql_fetch_array($q1)){ ?>
								<tr>
								<form action="#" method="POST">
									<td class=""> 
										<input type="hidden" name="cID" value="<?php echo $row['cID'];?>" /> 
										<input type="text" class="btn nomargin" name="cName" value="<?php echo $row['cName'];?>" /> 
									</td>
									<td class=" ">
										<input type="text" class="btn nomargin" name="cAlias" value="<?php echo $row['cAlias'];?>" /> 
									</td>
									<td class=" "> <input type="text" class="btn nomargin " name="cParty" value="<?php echo $row['cParty']?>" /></td>
									<td class=" "><input type="submit" class="btn btn-green noborder  " value="Save" /></td>
								</form>
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
<script type="text/javascript">
function f(){
if(confirm('Do you want to delete this Candidate?')==false){ return false; }
}
</script>
</body>
</html>