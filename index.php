<?Php

include "login.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BUGC e-Voting</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>

<body>

<div class="container">
	<form action="#" method="POST" name="form1" class="forrm-signin card container mt-5">
		<div class="text-center mb-4">
			<img class="mt-3 mb-4" src="images/bugcLogo.png" alt="" width="72" height="72">
			<h1 class="h3 mb-3 font-weight-normal">BUGC E-Voting System</h1>
		  </div>
	
		  <div class="form-label-group mb-3">
		
			
			<input type="password" id="votersCode" name="code" autocomplete="off" class="form-control btn" placeholder="Enter Voters Code" required="" autofocus="">
			<label for="votersCode">Voters Code</label><br>
			<div class="text-center mt-2 mb-5">
				<small><i>Enter the code that you recieve via SMS</i></small>
			</div>
		  </div>
	
		  <input name="Submit" type="submit" class="btn btn-lg btn-primary btn-block" value="Login" />
		  <p class="mt-5 mb-3 text-muted text-center"><b>CSC | USC</b> Election 2021</p>
	</form>

	<!-- <form action="#" method="POST" name="form1">
		<table width="800px" align="center" class="table1">
			<tr>
				<td align="center" class="td1"><img src="images/header.jpg" width="800" height="200" /></td>
			</tr>
			<tr>
				<td align="center" class="td1"><br /><font color="#FF0000"><?Php echo $err;?></font><br />
					User Code: <input name="code" type="password" autocomplete="off" size="20" maxlength="20" class="btn"  />
				<input name="Submit" type="submit" class="btn btn-blue" value="Login" /><br /><br />
					<font size="-2" color="#AAAAAA">Enter the code given to you at the entrance of the polls</font>
					<br>
					<br>		
				</td>
			</tr>
		</table>
	</form> -->
</div>

<!-- <center>
    <font color="#333333" size="-3">Copyright &copy;2012 BUGC Information Management Office, inc.</font>
	<br />
	<small style="color:#929292">Evoting System V 2.0 is best viewed on Mozilla Firefox 10.0 or higher  or Google Chrome.</small>
</center> -->



</body>
</html>