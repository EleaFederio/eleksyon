<?Php

session_start();

include "connection.php";
if(!isset($_SESSION['userid'])){
echo "Invalid User ";
echo "<a href='index.php'>Back</a>";
die;

}
$uid = $_SESSION['userid'];
if ($uid!="00000001"){
	echo "Your account is not allowed for this page. ";
	echo "<a href='index.php'>Back</a>";
	die;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BUGC eVoting Admin</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery/jquery.js"></script>
  <script type="text/javascript" src="jquery/jquery.autocomplete.js"></script>
  <script type="text/javascript" src="jquery/custom.js"></script>
<link rel="stylesheet" href="css/jquery.autocomplete.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!------------------------------------------------------------------>

<!------------------------------------------------------------------>
</head>

<body>



<table width="800px" align="center" class="table1">
    	<tr>
        	<td align="center" class="td1"><img src="images/header.jpg" width="800" height="200" /></td>
    	</tr>
        <tr>
		<?php
			$set = mysql_query("select * from `settings` where id='1' LIMIT 1");
		$SetV = mysql_fetch_array($set);
	
		?>
        	<td class="td1" align="center"><font size="+2"><b><?Php echo $SetV['admin'];?></b></font> <br />
            <b><?Php

			echo $_SESSION['usercourse']; ?></b>
            <br />
            </td>
        </tr>
        <tr>
        	<td align="center" class="td1">
                <table width="100%" border="0" class="table1">
                  
                    <tr>
                    <td valign="top" align="left" colspan="2">
				<a href="#" class="btn btn-blue" onClick="chw=window.open('testagain.php','NewWindow','resizable=no,scrollbars=no,status=no,width=1000,height=800'); if (chw != null) chw.focus(); return false">Real Time Result</a>      
				<a href="#" class="btn btn-blue" onClick="chw=window.open('result.php','NewWindow','resizable=no,scrollbars=no,status=no,width=1000,height=800'); if (chw != null) chw.focus(); return false">Export Result</a>
				<a href="#" class="btn btn-blue" onClick="chw=window.open('candidate-list.php','NewWindow','resizable=no,status=no,width=1200,height=800'); if (chw != null) chw.focus(); return false">Candidate List</a>
				<a target="_BLANK" class="btn btn-blue"  href="export_result.php" >Print Result</a>
				 <a href="index.php" class="btn btn-blue" >Logout</a>   
                    </td>
                  </tr>
				  <tr>
					<td colspan="2" style="background-color:#d5ff85;border-bottom:1px solid black">
						<h4 id="settings">Settings</h4>

						<?php
						if(isset($_GET['error'])){
							$errr = $_GET['error'];
							if($errr==1){
								echo "<span class='btn-red'>New Password Mismatched.</span>";
							}
							else if($errr==2){
								echo "<span class='btn-red'>Password is Incorrect.</span>";
							}
						}
						if(isset($_GET['saved'])){
							
								echo "<span class='btn-green' style='padding:4px 4px 4px 4px; color:green;font-size:16px'>Saved.</span> <hr />";
							
						}
						$rp = mysql_query("select * from `settings`");
						$l = mysql_fetch_array($rp);
						?>
						
				  <?php
				  if(isset($_POST['repCount'])){
				  extract($_POST); 
					$q = mysql_query("select `password` from `settings`");
				  $pass = mysql_fetch_array($q);
				  if($Password != $pass['password']){
					//   Check if the old password is corect
				  header("location:admin.php?error=2");
				  die;
				  }
				  else{
				  
					  if($nPassword != $cPassword){
						header("location:admin.php?error=1");
						die;
					  }
					  else{
						if($nPassword != ""){
							$pass =mysql_real_escape_string($nPassword);
						}
						else{
							$pass =mysql_real_escape_string($Password);
						}
						$adminName =mysql_real_escape_string($adminName);
						  $msg = mysql_real_escape_string($_POST['message']);
						  $count = mysql_real_escape_string($_POST['repCount']);
						  $college = mysql_real_escape_string($college);
						  $c1 = mysql_real_escape_string($cperson);
						  $c2 = mysql_real_escape_string($pollchairman);
						  $c3 = mysql_real_escape_string($cochairman);
						  $c4 = mysql_real_escape_string($pollclerk);
						  $c5 = mysql_real_escape_string($member);
						  $c6 = mysql_real_escape_string($smember);
						  $q = mysql_query("update `settings` set `msg`='$msg',`repCount`='$count',`collegeunit`='$college', `Chairperson`='$c1',`PollChairman`='$c2',`CoChairman`='$c3',`PollClerk`='$c4',`Member`='$c5',`StudentMember`='$c6',`admin`='$adminName',`password`='$pass' where id='1'");
						  header("location:admin.php?saved");
					  }
				  }
				 }
$rp = mysql_query("select * from `settings`");
$l = mysql_fetch_array($rp);
$repcount = $l['repCount'];
$adminmsg = $l['msg'];

				  ?>
						<form action="" method="POST">
							College Unit: <input type="text" class="btn" name="college" value="<?php echo $l['collegeunit'];?>" /> <br />
							Representative Count: <input type="text" style="width:50px" class="btn" name="repCount" value="<?php echo $l['repCount'];?>" /> <br />
							Message: <input type="text" class="btn" name="message" value="<?php echo $l['msg'];?>" style="width:50%" /> <br />
							Administrator Name: <input type="text" name="adminName" class="btn" value="<?php echo $l['admin']?>" /> <br />
							Admin Password: <input type="text" name="Password" class="btn" required="required" /> <br />
							New Password: <input type="text" name="nPassword" class="btn" /> <br />
							Confirm Password: <input type="text" name="cPassword" class="btn" /> <br />
							<hr />
							<h4>College Student Electoral Board</h4>
							<table>
							<tr><td>Chairperson:</td><td> <input type="text" class="btn" name="cperson" value="<?php echo $l['Chairperson'];?>"  /></td></tr>
							<tr><td>Poll Chairman:</td><td>  <input type="text" class="btn" name="pollchairman" value="<?php echo $l['PollChairman'];?>"  /> </td></tr>
							<tr><td>Co-Chairman:</td><td>  <input type="text" class="btn" name="cochairman" value="<?php echo $l['CoChairman'];?>"  /> </td></tr>
							<tr><td>Poll Clerk (Student): </td><td> <input type="text" class="btn" name="pollclerk"  value="<?php echo $l['PollClerk'];?>" /></td></tr>
							<tr><td>Member:</td><td>  <input type="text" class="btn" name="member"  value="<?php echo $l['Member'];?>" /></td></tr>
							<tr><td>Student Member:</td><td>  <input type="text" class="btn" name="smember"  value="<?php echo $l['StudentMember'];?>" /></td></tr>
							</table>
							<center>
							
							<input  type="submit" class="btn btn-blue" value="Save Settings & Electoral Board" /><br /></center>
							
						</form>
					</td>
				  </tr>
				  <!------------------------------------------------->
<?php if(isset($_POST['save_candidate'])){ 
				  extract($_POST);
					$ty = mysql_real_escape_string($type);
					$n = mysql_real_escape_string($name);
					$a = mysql_real_escape_string($alias);
					$p = mysql_real_escape_string($party);
					$pos = mysql_real_escape_string($position);
					
					
						
						$q = mysql_query("select `cID` from `candidate` where `cName`='$n'");
							if(!mysql_num_rows($q)){
							$ins = mysql_query("insert into `candidate` (`cName`,`cAlias`,`cPosition`,`cParty`,`cType`) values ('$n','$a','$pos','$p','$ty')");  ?>
							<tr><td style="font-family:Arial;color:green">Candidate Saved.</td></tr>
						  <?php }
							else{
								echo "-Status-";		
							}
					
	} ?>		
			<tr>
					
						<td style="text-align:left; background-color:#a0e1ff;padding:5px 5px 5px 5px;" valign="TOP"> 
		  
						<h4>New Candidate</h4>
							<form action="#settings" method="POST">
								<table >	
									<tr> <td>Name</td> <td><input class="btn btn-red" type="text" name="name" required="required" /></td> </tr>
									<tr> <td>Alias</td> <td><input class="btn btn-red"  type="text" name="alias"  required="required"  /></td> </tr>
									<tr> <td>Party</td> <td><input class="btn btn-red"  type="text" name="party" required="required"  /></td> </tr>
									<tr> <td>Type</td> 
										<td>
											<input  type="radio" name="type" value="1" class="ctype" id="1"  /> CSC
											<input  type="radio" name="type" value="2" class="ctype" id="2" /> USC
										</td> </tr>
									<tr> <td>Position</td> 
										<td>
											<select name="position" class="btn btn-red cposition" id="" required="required" >
													<option value="">-select type first-</option>

											</select>
										</td>
									</tr>
									
									
									<tr> <td></td> <td><input type="submit" value="save" name="save_candidate" class=" btn-blue btn" /> 
										<input type="reset" value="clear" class="btn-orange btn" /> </td></tr>
								</table>
							</form>
							<hr />
							<h4 id="USER">Add User</h4>
							<?php
							if(isset($_POST['userID'])){
								extract($_POST);
									$a = mysql_real_escape_string($userID);
									$b = mysql_real_escape_string($uLname);
									$c = mysql_real_escape_string($uFname);
									$d = mysql_real_escape_string($uMname);
									$e = mysql_real_escape_string($uCourse);
									$f = mysql_real_escape_string($uYear);
									$g = mysql_real_escape_string($uSection);
									$h = mysql_real_escape_string($uGender);
									$i = mysql_query("select `studID` from `studentlist` where `studID`='$a'");
									if(!mysql_num_rows($i)){
										$chk = mysql_query("select `studID` from `studentlist` where `lname`='$b' and `fname`='$c' and `mname`='$d'");
										if(!mysql_num_rows($chk)){
											$insert = mysql_query("insert into `studentlist` (`studID`,`lname`,`fname`,`mname`,`section`,`sex`,`Course`,`year`) values('$a','$b','$c','$d','$g','$h','$e','$f') ");
											echo "Student has been saved.";
											
										}
										else{
											echo "Student is already in the Database.";
											
										}
									}else{
										echo "Duplicate User ID had been detected.";
										
									}
									
							}
							?>
							
							<form action="#USER" method="post">
								<table>
									<tr> <td>User ID</td> <td> <input class="btn" type="text" required="required" name="userID" /> </td> </tr>
									<tr> <td>Last Name</td> <td> <input class="btn" type="text" required="required" name="uLname" /> </td> </tr>
									<tr> <td>First Name</td> <td> <input class="btn" type="text" required="required" name="uFname" /> </td> </tr>
									<tr> <td>Middle Name</td> <td> <input class="btn" type="text" required="required" name="uMname" /> </td> </tr>
									<tr> <td>Gender</td> <td> <select name="uGender" id="" class="btn">
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select> </td> </tr>
									<tr> <td>Course</td> <td> <input class="btn" type="text" required="required" name="uCourse" /> </td> </tr>
									<tr> <td>Year</td> 
										<td> 
											<select name="uYear" id="" class="btn">
												<option value="">-select-</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
											</select>
										Section  <input style="width:50px" class="btn" type="text" required="required" name="uSection" /> </td >
									</tr>
									<tr>  <td colspan="2"> <input class="btn btn-blue btn-block" type="submit" value="Save"   /> </td> </tr>
								</table>
							
							
							</form>
						</td>
						<td style="text-align:left; background-color:#ffdfa0;padding:5px 5px 5px 5px;" valign="TOP">
						<h4>New Position</h4>
						<?php
						if(isset($_POST['nPosition'])){ 
						$pos = mysql_real_escape_string($_POST['nPosition']);
						$nType = mysql_real_escape_string($_POST['nType']);
						$select = mysql_query("select `id` from `positions` where `position`='$pos' and `type`='$nType'");
							if(mysql_num_rows($select)){
									echo "";
							}
							else{
							$q = mysql_query("insert into `positions` (`position`,`type`) values ('$pos','$nType')");
							echo "<small style='color:green'>Saved</small>";
							}
						} ?>
						<form action="" method="POST">
							<table>
								<tr>
									<td>Position</td>
									<td> <input type="text" class="btn" name="nPosition" /> </td>
									<td> 	<input  type="radio" name="nType" value="1" id="1" checked /> CSC
											<input  type="radio" name="nType" value="2" id="2" /> USC 
									</td>
									<td> <input type="submit" value="Save" class="btn btn-blue" /> </td>
								</tr>
							</table>
						</form>
						<br />
						
						<table cellspacing="0">
						<thead>
							<th>Position</th>
							<th>Type</th>
							<th colspan='2'>Action</th>
						</thead>
						<tr>
							<td colspan="3">
						<?php
						if(isset($_GET['delete_pos'])){
							$id = $_GET['delete_pos'];
							$del = mysql_query("delete from `positions` where `id`='$id'");
							echo "Deleted.";
						}
						if(isset($_POST['posName'])){
							$posN = mysql_real_escape_string($_POST['posName']);
							$posID = $_POST['posID'];
							$upd = mysql_query("update `positions` set `position`='$posN' where id='$posID'");
							echo "Updated.";
						}
						?></td>
						</tr>
							<?php
								$query = mysql_query("select * from positions order by type ASC,id");
								while($pos = mysql_fetch_array($query)){ ?>
									<tr>
									<form action="#" method="POST">
										<td> <input type="hidden" name="posID" value="<?php echo $pos['id'];?>" /> 
											<input type="text" class="btn" name="posName" value="<?php echo $pos['position'];?>" /> </td>
										<td>
										<select name="posType" id="" class="btn">
												<option value="<?php echo $pos['type'];?>"><?php echo Ctype_Abre($pos['type']);?></option>
												<option  disabled ><b>Select Position:</b></option>
												<option value="1"><?php echo "CSC";?></option>
												<option value="2"><?php echo "USC";?></option>
											</select> 	
										</td>
										<td><input type="submit" class="btn btn-green" value="Update" /></td>
										<td> <a href="admin.php?delete_pos=<?php echo $pos['id'];?>" class="btn btn-red">delete</a> </td>
									</form>
									</tr>
									
								<?php }	?>
						</table>
						</td>
					</tr>
					
				
				  <!------------------------------------------------->
                  <tr>
                  	<td valign="top" align="left" class="td1" colspan="2" style="background-color:#e7e7e7">
                    
						Student's Last Name <br />
					<input type="text"  id="namer" autocomplete="off" name="studentname" placeholder="LAST NAME, FIRST NAME, MIDDLE NAME" class="btn btn-block searchStud" required="required" /> 
						<ul id="searchResults" style="list-style-type:none"></ul>
						
						
						
						<input disabled id="CityAjax" style="display:none" name="lastname" type="text" size="30" maxlength="30" />
                    <br />
                    <a href="list.php?letter=A" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">A</a> | 
<a href="list.php?letter=B" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">B</a> | 
<a href="list.php?letter=C" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">C</a> | 
<a href="list.php?letter=D" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">D</a> | 
<a href="list.php?letter=E" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">E</a> | 
<a href="list.php?letter=F" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">F</a> | 
<a href="list.php?letter=G" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">G</a> | 
<a href="list.php?letter=H" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">H</a> | 
<a href="list.php?letter=I" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">I</a> | 
<a href="list.php?letter=J" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">J</a> | 
<a href="list.php?letter=K" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">K</a> | 
<a href="list.php?letter=L" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">L</a> | 
<a href="list.php?letter=M" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">M</a> | 
<a href="list.php?letter=N" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">N</a> | 
<a href="list.php?letter=O" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">O</a> | 
<a href="list.php?letter=P" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">P</a> | 
<a href="list.php?letter=Q" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">Q</a> | 
<a href="list.php?letter=R" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">R</a> | 
<a href="list.php?letter=S" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">S</a> | 
<a href="list.php?letter=T" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">T</a> | 
<a href="list.php?letter=U" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">U</a> | 
<a href="list.php?letter=V" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">V</a> | 
<a href="list.php?letter=W" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">W</a> | 
<a href="list.php?letter=X" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">X</a> | 
<a href="list.php?letter=Y" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">Y</a> | 
<a href="list.php?letter=Z" target="_blank" style="color:#306; text-decoration:underline; text-transform:none; font-weight: bold;  ">Z</a>

                    </td>
                    </tr>
                        
                </table>
   			</td>
		 </tr>
      
</table>

<center>
    <font color="#333333" size="-3">Copyright &copy;2012 BUGC Information Management Office, inc.</font>
</center>
<script type="text/javascript">
	$(".searchStud").keyup(function(){
		name = $(this).val();
			$.post("ajax.php?Student="+name,function(data){
				if(data){
					$("#searchResults").html(data);
				}
			});
		
		
	});
</script>
</body>
						
</html>
<?php die; ?>

                   
                    