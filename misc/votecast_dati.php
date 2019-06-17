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
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script>
$(function () {
   $('.security').change(function () {
      $('.security option').show(0);
      $('.security option:selected').each(function () {
         oIndex = $(this).index();
         if (oIndex > 0) {
            $('.security').each(function () {
               $(this).children('option').eq(oIndex).not(':selected').hide(0);
            });
         }
      });
   });
   $('.security').change();
});
</script>



</head>

<body>

<form action="castvote.php" name="formcast" method="get" onsubmit="return confirmActionVote()" >

<table width="800px" align="center" class="table1">
    	<tr>
        	<td align="center" class="td1"><img src="images/header.jpg" width="800" height="200" /></td>
    	</tr>
        <tr>
        	<td class="td1" align="center"><font size="+2"><b><?Php echo $_SESSION['username'];?></b></font> <br />
            <b><?Php echo $_SESSION['usercourse']; ?></b>
            <br />
            You may now cast your vote by selecting the candidate of your choice.
            </td>
        
        </tr>
        
        
        <tr>
        	<td align="center" class="td1">

<table width="100%" border="0" class="table1">
  <tr>
  <td width="50%" valign="top">
  	<table>
    <tr>
    <td class="th1">President</td>
    <td class="td1">
    <select name="pres">
    <option></option>
    
    <?Php
	$options="";
		$pressql=mysql_query("SELECT * FROM candidate WHERE cPosition='President'");
		while($presrow=mysql_fetch_array($pressql)){
			$id = $presrow['cID'];
			$options.="<option value=\"$id\">(".$presrow['cAlias'] . ")-". $presrow['cName'];
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
    <select name="sec">
    	<option>
        
        </option>
        <?Php
		$options="";
		$secsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Secretary'");
		while($secrow=mysql_fetch_array($secsql)){
			$id = $secrow['cID'];
			$options.="<option value=\"$id\">(".$secrow['cAlias'] . ")-". $secrow['cName'];
			
		}
	
	echo $options;?>  
    </select>
    
    </td>
   
  </tr>
  <tr>
    <td class="th1">Treasurer</td>
    <td class="td1">
    <select name="tres">
    	<option></option>
        <?Php
		$options="";
		$tressql=mysql_query("SELECT * FROM candidate WHERE cPosition='Treasurer'");
		while($tresrow=mysql_fetch_array($tressql)){
			$id = $tresrow['cID'];
			$options.="<option value=\"$id\">(".$tresrow['cAlias'] . ")-". $tresrow['cName'];

		}
		
	 
	echo $options;?> 
    </select>
    
    </td>
   
  </tr>
  <tr>
    <td class="th1">Auditor</td>
    <td class="td1">
    <select name="aud">
    	<option></option>
        
         <?Php
		 $options="";
		$audsql=mysql_query("SELECT * FROM candidate WHERE cPosition='Auditor'");
		while($audrow=mysql_fetch_array($audsql)){
			$id = $audrow['cID'];
			$options.="<option value=\"$id\">(".$audrow['cAlias'] . ")-". $audrow['cName'];
			
		}
		
	echo $options;?> 
    </select>
    </td>
   
  </tr>
  <tr>
    <td class="th1">Business Manager</td>
    <td class="td1">
    <select name="buss">
    	<option></option>
         <?Php
		 $options="";
		$bussql=mysql_query("SELECT * FROM candidate WHERE cPosition='Business Manager'");
		while($busrow=mysql_fetch_array($bussql)){
			$id = $busrow['cID'];
			$options.="<option value=\"$id\">(".$busrow['cAlias'] . ")-". $busrow['cName'];
		
		}
		
	echo $options;?>
    </select>
    
    </td>
    
  </tr>
  <tr>
    <td class="th1">PIO</td>
    <td class="td1">
    <select name="pio">
    	<option></option>
         <?Php
		 $options="";
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='PIO'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $piorow['cID'];
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    
    </td>
    </tr>
    </table>
  </td>
  <td valign="top">  
  	<table>
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
   <select class="security" name="security1">
    	<option value=0></option>
         <?Php
		 //$options="";
		 $id=0;
		 //$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		//while($piorow=mysql_fetch_array($piosql)){
		//	$id = $id+1;
		//	$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		for($i=1;$i<17;$i++){
			?>
            <option value="<?Php echo $i;?>"><?Php echo $rep[$i]?></option>
            <?Php
		}
		
		
		//}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security2">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security3">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security4">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security5">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security6">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security7">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security8">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
		}
		
	echo $options;?>
        
    </select>
    <br />
    <select class="security" name="security9">
    	<option value=0></option>
         <?Php
		 $options="";
		 $id=0;
		$piosql=mysql_query("SELECT * FROM candidate WHERE cPosition='Representative'");
		while($piorow=mysql_fetch_array($piosql)){
			$id = $id+1;
			$options.="<option value=\"$id\">(".$piorow['cAlias'] . ")-". $piorow['cName'];
		
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
<center>
    <font color="#333333" size="-3">Copyright &copy;2012 BUPC Information Management Office, inc.</font>
</center


></body>
</html>