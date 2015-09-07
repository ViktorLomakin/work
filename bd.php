<?php
//Connect to BD
$link = mysql_connect('localhost', 'vik', 100595) or die('Cant connect to bd: ' . mysql_error());
mysql_select_db('work', $link) or die('Cant connect to "work": ' . mysql_error()); //Select BD

?>