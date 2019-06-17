<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?Php
session_start();
include "connection.php";
if(isset($_SESSION['userid'])){
$uid = $_SESSION['userid'];
}
else{
	echo "Invalid User";
	die;
}


$check=mysql_query("SELECT studID, status FROM studentlist WHERE studID='$uid' AND status='1'");
if(mysql_num_rows($check)>0){
	header("Location:index.php?voted=5");
	die;
}


?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BUPC eVoting Casting</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<script language="javascript">
	function confirmActionVote(){
		return confirm("Are you sure to cast your votes?")
	}

var tstamp = new Array;
    var seq    = 1;
    function t(n) {
        tstamp[n] = (document.formcast.rep[n].checked == true) ? seq++ : 0;

        var nr     =  0; // how many have been clicked
        var oldest = -1; // offset of oldest checked
        var i;
        for (i=0; i < tstamp.length; ++i) {
            if (tstamp[i] > 0) {
                 ++nr;
                if (oldest < 0 || tstamp[oldest] > tstamp[i]) {
                    oldest = i;
                }
            }
        }

        // more than 3, uncheck oldest
        if (nr > 9) {
            tstamp[oldest] = 0;
            document.formcast.rep[oldest].checked = false;
        }
        return true;
    }


function showparty(str)
{
if (str.length==0)
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtParty").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getparty.php?q="+str,true);
xmlhttp.send();
}



</script>

<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="jquery/custom.js"></script>

</head>

<body>

<form action="castvote.php" method="post" onsubmit="return confirmActionVote()">
	<table align="center" class="table1">
	<tr><td align="center" class="td1" colspan="2"><img src="images/header2.jpg" width="800px" height="100" /></td> </tr>
     <tr> 
		<td colspan="2" class="td1" align="center"><font size="+2"><b><?Php echo str_ireplace("?","&Ntilde;",$_SESSION['username']);?></b></font> <br /> <b><?Php echo $_SESSION['usercourse']; ?></b> <br /> <?php echo $adminmsg;?></td>
	</tr>
	<tr>
		<td colspan="2" style="color:red">Please press "CAST VOTE" button on the lower part of the screen after selecting the Candidates you wish to vote.</td>
	</tr>
	<tr>
		<td valign="top">
			<table>
				<thead>
					<th colspan="2">College Student Council</th>
				</thead>
				<?php
					$q = mysql_query("select * from `positions` where `type`='1'");
					while($csc = mysql_fetch_array($q)){ ?>
					
					
					<?php if($csc['position'] != "Representative"){ ?>
					<tr>
						<td><?php echo $csc['position']?> </td>
						<td>
							<select name="csc_vote_person[]" id="" class="btn" style="width:200px">
							<option value="">-select-</option>
								<?php
									$q2 = mysql_query("select cID,cName from `candidate` where `cPosition`=$csc[id]");
									while($r = mysql_fetch_array($q2)){ ?>
										<option value="<?php echo $r['cID'];?>"><?php echo ucwords($r['cName']);?></option>
									<?php }
								?>
							</select>
						</td>
					</tr>
					<?php }
					else{ $count = 0; while($count < $repcount){ ?>
					<tr>
							<td>Representative </td>
								<td>
								<select name="representative[]" id="" style="width:200px" class="representative item_name btn">
							<option value="">-select-</option>
													<?php
														$z = mysql_query("select `cID`,`cName` from `candidate` where `cPosition`='$repPosID'");
														while($row = mysql_fetch_array($z)){ ?>
															<option value="<?php echo $row['cID'];?>"><?php echo ucwords($row['cName']);?></option>
													<?php } ?>
								</select>
							</td>
					</tr>
							<?php $count += 1;
							}
						}
					?>
					
				
					
					
					<?php }
				?>
			</table>
		</td>
	
		<td valign="top">
		<table>
				<thead>
					<th colspan="2">University Student Council</th>
				</thead>
				<?php
					$q = mysql_query("select * from `positions` where `type`='2'");
					while($csc = mysql_fetch_array($q)){ ?>
					
					
					<?php if($csc['position'] != "Representative"){ ?>
					<tr>
						<td><?php echo $csc['position']?> </td>
						<td>
							<select name="usc_vote_person[]" id="" class="btn" style="width:200px">
							<option value="">-select-</option>
								<?php
									$q2 = mysql_query("select cID,cName from `candidate` where `cPosition`=$csc[id]");
									while($r = mysql_fetch_array($q2)){ ?>
										<option value="<?php echo $r['cID'];?>"><?php echo ucwords($r['cName']);?></option>
									<?php }
								?>
							</select>
						</td>
					</tr>
					<?php }  
					}
				?>
			</table>
		
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:center">
			<button class="btn" type="submit" style="width:50%;height:40px;background-color:red;color:white;font-weight:bold;font-family:Arial;font-size:21px" name="castvote">CAST VOTE</button>
		</td>
	</tr>
	</table>
	
	
</form>
<center>
    <font color="#333333" size="<5px></5px>">Copyright &copy; 2012 BUPC Information Management Office, inc.</font>
</center>

<?php die; //========================================================================================================================== ?>

<form action="castvote.php" name="formcast" method="POST" onsubmit="return confirmActionVote()" >
<table  align="center" class="table1">
    	<tr><td align="center" class="td1"><img src="images/header2.jpg" width="800" height="100" /></td> </tr>
        <tr> <td class="td1" align="center"><font size="+2"><b><?Php echo $_SESSION['username'];?></b></font> <br /> <b><?Php echo $_SESSION['usercourse']; ?></b> <br /> Message: </td></tr>
<tr>
<td align="center" class="td1">
<table border="0" class="table1">
  <tr>
  <td valign="top">
  	<table class="table1" >
    <tr> <td colspan="2" align="center">College Student Council</td> </tr>
    <tr>
    <td class="th1">President</td>
    <td class="td1" id="president">
		<select name="pres" >
		<option></option>
		<?Php
		$options="";
			$pressql=mysql_query("SELECT * FROM candidate WHERE cPosition='President'");
			while($presrow=mysql_fetch_array($pressql)){
				$id = $presrow['cID'];
				$options.="<option  value=\"$id\">(".$presrow['cAlias'].")-". $presrow['cName'];
			}			
		echo $options;?>	
		</select>
    </td>
  </tr>
  <tr>
    <td class="th1">Vice President</td>
    <td class="td1">
    <select name="vpres">
    	<option>
        
        </option>
          <?Php
		  $options="";
		$vpressql=mysql_query("SELECT * FROM candidate WHERE cPosition='Vice-President'");
		while($vpresrow=mysql_fetch_array($vpressql)){
			$id = $vpresrow['cID'];
			$options.="<option value=\"$id\">(".$vpresrow['cAlias'] . ")-". $vpresrow['cName'];
		}
		

	echo $options;?>
    </select>
    </td>
  </tr>
  <tr>
    <td class="th1">Secretary</td>
    <td class="td1">
    <select name="sec" >
    	<option>
        
        </option>
        <?Php
		$options="";
		$secsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Secretary'");
		while($secrow=mysql_fetch_array($secsql)){
			$id = $secrow['cID'];
			$options.="<option  value=\"$id\">(".$secrow['cAlias'] . ")-". $secrow['cName'];
			
		}
	
	echo $options;?>  
    </select>
    </td>
  </tr>
  <tr>
    <td class="th1">Treasurer</td>
    <td class="td1">
    <select name="tres" >
    	<option></option>
        <?Php
		$options="";
		$tressql=mysql_query("SELECT * FROM candidate WHERE cPosition='Treasurer'");
		while($tresrow=mysql_fetch_array($tressql)){
			$id = $tresrow['cID'];
			$options.="<option  value=\"$id\">(".$tresrow['cAlias'] . ")-". $tresrow['cName'];

		}
		
	 
	echo $options;?> 
    </select>
    
    </td>
   
  </tr>
  <tr>
    <td class="th1">Auditor</td>
    <td class="td1">
    <select name="aud" >
    	<option></option>
        
         <?Php
		 $options="";
		$audsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Auditor'");
		while($audrow=mysql_fetch_array($audsql)){
			$id = $audrow['cID'];
			$options.="<option  value=\"$id\">(".$audrow['cAlias'] . ")-". $audrow['cName'];
			
		}
		
	echo $options;?> 
    </select>
    </td>
   
  </tr>
  <tr>
    <td class="th1">Business Manager</td>
    <td class="td1">
    <select name="buss" >
    	<option></option>
         <?Php
		 $options="";
		$bussql=mysql_query("SELECT * FROM candidate WHERE cPosition='Business Manager'");
		while($busrow=mysql_fetch_array($bussql)){
			$id = $busrow['cID'];
			$options.="<option  value=\"$id\">(".$busrow['cAlias'] . ")-". $busrow['cName'];
		
		}
		
	echo $options;?>
    </select>
    
    </td>
    
  </tr>
  <tr>
    <td class="th1">PIO</td>
    <td class="td1">
    <select name="pio" >
    	<option></option>
         <?Php
		 $options="";
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='PIO'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $piorow['cID'];
			$options.="<option  value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    
    </td>
    </tr>
     <tr>
    	<td colspan="2">You can vote up to 9 representatives
        <?Php 
		$rep[]=0;
		$count=0;
		$repsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($reprow=mysql_fetch_array($repsql)){
			$count++;
			$rep[$count]="(".$reprow['cAlias'] . ")-". $reprow['cName'];;
		}
		?>
        </td>
    </tr>
    <tr>
    <td class="th1">Representatives</td>
    <td class="td1">
   <select  class="security" name="security1">
    	<option value=0></option>
         <?Php for($i=1;$i<$count;$i++){ ?>
            <option  value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
         <?Php } ?>
    </select>
    <br />
    <select  class="security" name="security2">
    	<option value=0></option>
         <?Php
		for($i=1;$i<$count;$i++){
			?>
            <option  value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
        
    </select>
    <br />
    <select  class="security" name="security3">
    	<option value=0></option>
          <?Php

		for($i=1;$i<$count;$i++){
			?>
            <option  value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
        
    </select>
    <br />
    <select  class="security" name="security4">
    	<option  value=0></option>
         <?Php

		for($i=1;$i<$count;$i++){
			?>
            <option value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
        
    </select>
    <br />
    <select  class="security" name="security5">
    	<option  value=0></option>
         <?Php

		for($i=1;$i<$count;$i++){
			?>
            <option value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
        
    </select>
    <br />
    <select  class="security" name="security6">
    	<option  value=0></option>
        <?Php

		for($i=1;$i<$count;$i++){
			?>
            <option value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
        
    </select>
    <br />
    <select  class="security" name="security7">
    	<option  value=0></option>
        <?Php

		for($i=1;$i<$count;$i++){
			?>
            <option value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
        
    </select>
    <br />
    <select  class="security" name="security8">
    	<option  value=0></option>
         <?Php

		for($i=1;$i<$count;$i++){
			?>
            <option value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
        
    </select>
    <br />
    <select  class="security" name="security9">
    	<option value=0></option>
         <?Php

		for($i=1;$i<$count;$i++){
			?>
            <option  value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		?>
    </select>
    </td>
    
 </tr>
    </table>
  </td>
  <td valign="top">  
  	<table class="table1">
    <tr><td align="center" colspan="2">University Student Council</td></tr>
    <tr>
    <td class="th1">Chairperson</td>
    <td class="td1">
    <select  name="chair"  >
    <option></option>
    <?Php
	$options="";
		$chairsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Chairperson'");
		while($chairrow=mysql_fetch_array($chairsql)){
			$id = $chairrow['cID'];
			$options.="<option  value=\"$id\">(".$chairrow['cAlias'] . ")-". $chairrow['cName'];
		}			
	echo $options;?>	
	</select>
    </td>
  </tr>
  <tr>
    <td class="th1">Internal Vice-Chairperson</td>
    <td class="td1">
    <select   name="internal">
    	<option>
        
        </option>
          <?Php
		  $options="";
		$internalsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Internal'");
		while($internalrow=mysql_fetch_array($internalsql)){
			$id = $internalrow['cID'];
			$options.="<option  value=\"$id\">(".$internalrow['cAlias'] . ")-". $internalrow['cName'];
		}
		

	echo $options;?>
    </select>
    
    </td>
   
  </tr>
  <tr>
    <td class="th1">External Vice-Chairperson</td>
    <td class="td1">
    <select  name="external">
    	<option></option>
        <?Php
		$options="";
		$secsql=mysql_query("SELECT * FROM candidate WHERE cPosition='External'");
		while($secrow=mysql_fetch_array($secsql)){
			$id = $secrow['cID'];
			$options.="<option  value=\"$id\">(".$secrow['cAlias'] . ")-". $secrow['cName'];
		}
	
	echo $options;?>  
    </select>
    </td>
  </tr>
  <tr>
    <td class="th1">Secretary General</td>
    <td class="td1">
    <select  name="secgen">
    	<option></option>
        <?Php
		$options="";
		$secgensql=mysql_query("SELECT * FROM candidate WHERE cPosition='SecretaryGen'");
		while($secgenrow=mysql_fetch_array($secgensql)){
			$id = $secgenrow['cID'];
			$options.="<option  value=\"$id\">(".$secgenrow['cAlias'] . ")-". $secgenrow['cName'];
		}
		
	 
	echo $options;?> 
    </select>
    </td>
  </tr>
  <tr>
    <td class="th1">Deputy Secretary General</td>
    <td class="td1">
    <select  name="depsec">
    	<option></option>
        
         <?Php
		 $options="";
		$depsecsql=mysql_query("SELECT * FROM candidate WHERE cPosition='DepSecretary'");
		while($depsecrow=mysql_fetch_array($depsecsql)){
			$id = $depsecrow['cID'];
			$options.="<option  value=\"$id\">(".$depsecrow['cAlias'] . ")-". $depsecrow['cName'];
			
		}
		
	echo $options;?> 
    </select>
    </td>
   
  </tr>
  <tr>
    <td class="th1">Finance Officer</td>
    <td class="td1">
    <select  name="fin">
    	<option></option>
         <?Php
		 $options="";
		$finsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Finance'");
		while($finrow=mysql_fetch_array($finsql)){
			$id = $finrow['cID'];
			$options.="<option value=\"$id\">(".$finrow['cAlias'] . ")-". $finrow['cName'];
		
		}
		
	echo $options;?>
    </select>
    
    </td>
    
  </tr>
  <tr>
    <td class="th1">Deputy Finance Officer</td>
    <td class="td1">
    <select  name="depfin">
    	<option></option>
         <?Php
		 $options="";
		$depfinsql=mysql_query("SELECT * FROM candidate WHERE cPosition='DepFinance'");
		while($depfinrow=mysql_fetch_array($depfinsql)){
			$id = $depfinrow['cID'];
			$options.="<option value=\"$id\">(".$depfinrow['cAlias'] . ")-". $depfinrow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    
    </td>
    </tr>
    <tr>
    <td class="th1">Auditor</td>
    <td class="td1">
    <select  name="audi">
    	<option></option>
         <?Php
		 $options="";
		$audisql=mysql_query("SELECT * FROM candidate WHERE cPosition='Aud'");
		while($audirow=mysql_fetch_array($audisql)){
			$id = $audirow['cID'];
			$options.="<option value=\"$id\">(".$audirow['cAlias'] . ")-". $audirow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    
    </td>
    </tr>
    
    <tr>
    <td class="th1">Business Manager</td>
    <td class="td1">
    <select  name="busman">
    	<option></option>
         <?Php
		 $options="";
		$busmansql=mysql_query("SELECT * FROM candidate WHERE cPosition='Bus Man'");
		while($busmanrow=mysql_fetch_array($busmansql)){
			$id = $busmanrow['cID'];
			$options.="<option value=\"$id\">(".$busmanrow['cAlias'] . ")-". $busmanrow['cName'];
		}
		
	echo $options;?>
        
    </select>
    
    </td>
    </tr>
    <tr>
    <td class="th1">Public Info Officer</td>
    <td class="td1">
    <select  name="public">
    	<option></option>
         <?Php
		 $options="";
		$publicsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Pub Info Offi'");
		while($publicrow=mysql_fetch_array($publicsql)){
			$id = $publicrow['cID'];
			$options.="<option value=\"$id\">(".$publicrow['cAlias'] . ")-". $publicrow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    
    </td>
    </tr>

</table>

</td>
</tr>
    	
    </table>
<center>
<input style="font-size:18px" name="castvote" type="submit" value="Cast Vote" />
</center>
</form>


</body>
</html>