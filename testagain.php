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
.table1, .td1, .th1{
	border: 1px solid #006;
	vertical-align:text-top;
}
.th1{
	background-color:#006;
	color:#FFF;
	vertical-align:text-top;
	}
</style>
</head>
<body>

<script type="text/javascript">
function Ajax(){
var xmlHttp;
	try{	
		xmlHttp=new XMLHttpRequest();// Firefox, Opera 8.0+, Safari
	}
	catch (e){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
		}
		catch (e){
		    try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("No AJAX!?");
				return false;
			}
		}
	}

xmlHttp.onreadystatechange=function(){
	if(xmlHttp.readyState==4){
		document.getElementById('ReloadThis').innerHTML=xmlHttp.responseText;
		setTimeout('Ajax()',8000);
	}
}
xmlHttp.open("GET","result_show.php",true);
xmlHttp.send(null);
}

window.onload=function(){
	setTimeout('Ajax()',2000);
}
</script>

<div id="ReloadThis">Please Wait...</div>
<center>
    <font color="#333333" size="-3">Copyright &copy;2012 BUPC Information Management Office, inc.</font>
</center
</body>
</html>