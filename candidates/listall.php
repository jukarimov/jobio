<?php

echo "
<html>
 <head>
  <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
  <br>
  <h1>List of all available jobs</h1>
  <br>
  <hr>
   <div id=\"results\">
";

$us="root";
$ps="root";
$db="mydb";

mysql_connect(localhost, $us, $ps) or die("Could not connect to MySQL");

mysql_select_db($db) or die("Could not select database '$db'");

$query = "SELECT skill FROM employers GROUP BY skill;";

$result = mysql_query($query);

if (!$result)
	die("Failed to query MySQL server");

$nr = mysql_numrows($result);

echo "$nr types of job available<br><hr><br>";

for ($i=0; $i < $nr; $i++)
{
	$row = mysql_result($result, $i);
	echo "<a href=\"search.php?q=$row\">" . $row . '</a><br>';
}

mysql_close();

echo "<br>";
echo "<hr>";
