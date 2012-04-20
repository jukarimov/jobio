<?php

$us="root";
$ps="root";
$db="mydb";

mysql_connect(localhost, $us, $ps) or die("Could not connect to MySQL");

mysql_select_db($db) or die("Could not select database '$db'");

echo "
<html>
 <head>
  <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
  <br>
  <h1>Lookup For Candidates</h1>
  <form method=\"POST\" action=\"search.php\">
   <b>Type of job (eg. cooking):</b><br>
   <input type=\"text\" name=\"skill\" /> <input type=\"submit\" />
   <br>
   <a href=\"listall.php\"><font size=\"8pt\">list all available candidates</font></a>
   <br>
   <br>
   <div id=\"results\">
";

$post = $_POST['skill'];
$qstr = split('=', $_SERVER['QUERY_STRING']);

if($post != '' || $qstr[1] != '')
{
	$skill = $post != '' ? $post : $qstr[1];
	echo "Results for '$skill'<br>";

	$query = "SELECT info FROM candidates where skill='$skill';";

	$result = mysql_query($query);

	if (!$result)
		die("Failed to query MySQL server");

	$nr = mysql_numrows($result);

	echo "$nr candidates found<br><hr><br>";

	for ($i=0; $i < $nr; $i++)
	{
		$row = mysql_result($result, $i);
		echo $row . '<br><hr><br>';
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

