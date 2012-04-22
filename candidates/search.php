<?php

$us="root";
$ps="root";
$db="mydb";

mysql_connect(localhost, $us, $ps) or die("Could not connect to MySQL");

mysql_select_db($db) or die("Could not select database '$db'");

$QSTR = $_SERVER['QUERY_STRING'];

echo "
<html>
 <head>
  <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
  <br>
  <h1>Lookup For Jobs</h1>
  <form method=\"POST\" action=\"search.php\">
   <b>Type of job (eg. cooking):</b><br>
   <input type=\"text\" name=\"skill\" /> <input type=\"submit\" />
   <br>
   <a href=\"listall.php\"><font size=\"8pt\">list all available jobs</font></a>
   <br>
   <br>
   <div id=\"results\">
";

$do_search = false;

if ($_POST['skill'] != "") 
{
	$skill = $_POST['skill'];
	$do_search = true;
}
else if ($QSTR != "")
{
	$q = split('=', "$QSTR");
	$skill = $q[1];
	$do_search = true;
}

if ($do_search)
{
	$query = "SELECT info FROM employers where skill='$skill';";

	$result = mysql_query($query);

	if (!$result)
		die("Failed to query MySQL server");

	$nr = mysql_numrows($result);

	echo "$nr jobs found<br><hr><br>";

	for ($i=0; $i < $nr; $i++)
	{
		$row = mysql_result($result, $i);
		echo '*&nbsp;' . $row . '<br><hr><br>';
	}
}

echo "
   </div>
   <br>
  </form>
 </head>
</html>
";

mysql_close();

?>

