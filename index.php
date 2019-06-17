<?Php

include "login.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BUGC e-Voting</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<form action="#" method="POST" name="form1">
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
</form>

<center>
    <font color="#333333" size="-3">Copyright &copy;2012 BUGC Information Management Office, inc.</font>
	<br />
	<small style="color:#929292">Evoting System V 2.0 is best viewed on Mozilla Firefox 10.0 or higher  or Google Chrome.</small>
</center>



</body>
</html>