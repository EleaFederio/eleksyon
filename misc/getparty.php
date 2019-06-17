<?Php
$cID=$_GET["q"];


include "connection.php";

$csql=mysql_query("SELECT cID, cParty FROM candidate WHERE cID='$cID'");
while($crow=mysql_fetch_array($csql)){
	echo $crow['cParty'];
}

?>