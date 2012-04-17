<?php

$us="root";
$ps="root";
$db="mydb";

mysql_connect(localhost, $us, $ps) or die("Could not connect to MySQL");

mysql_select_db($db) or die("Could not select database '$db'");

if($_POST['skill'] != "" && $_POST['info'] != "")
{
	$skill = $_POST['skill'];
	$info = nl2br($_POST['info']);

	$query = "INSERT INTO employers (skill, info) VALUES ('$skill', '$info')";
	$result = mysql_query($query);
}

mysql_close();

echo "
<html>
 <head>
  <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\">
  <br>
  <h1>Announce A New Vacancy</h1>
  <form method=\"POST\" action=\"announce.php\">
   <b>Type of job (eg. cooking): <input type=\"text\" name=\"skill\" /></b>
   <br>
   <b>Describe vacancy details, contact info, deadline etc. here:</b>
   <br>
   <textarea name=\"info\"></textarea>
   <br>
   <input type=\"submit\" />
  </form>
 </head>
</html>
";
?>

