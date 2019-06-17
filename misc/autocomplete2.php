<?php

$q = strtolower($_GET["q"]);
if (!$q) return;
$items = array(

"Sergio Johnnel",
"ALEGRE Samuel",
"REARIO Francis John",
"ORLANGO Erick",
"SARTE Jason",
"MILLARES James Erwin",
"DIRIGE Arlo",
"RESOCO Resty",
"OLIQUIANO Rolly",
"EVANGELISTA Jose",
"BARCELO Raffy",
"RIVERA Neilbert",
"PARANAL Christian",
"MORALES Danreb",
"VALENCIA Mark Angelo",
"DIAZ John Paul",
"IBARRETA Moises",
"NOCIETE Alvin",
"LONEZA Kirby",
"BUBAN Jefferson",
"TUMULAK June Paolo",
"BOLAÑOS Marjohn",
"BOLANO Nelson",
"MIRABUENO Melvin",
"LAUSINGCO Jerome",
"TORRES Jake Carlo",
"REFALDA Jerome",
"MORAN Philip John",
"VILLAR Rommel",
"SAYSON Jiboy",
"TUCIO Mhar",
"MORATA Jofre",
"ENCISA Jeffrey",
"VIÑAS Noel",
"ESPELETA Richard",
"BARBARIN Mark Vincent",
"PATAL Johnson",
"GARCIA	Tommy",
"RETANAN Kristian Carl",
"SARIO Jessie Paul",
"NUÑEZCA John Paul",
"ARMEÑA	Evan Franz",
"CASULANG Joker David"

);

foreach ($items as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key|$value\n";
	}
}


?>
