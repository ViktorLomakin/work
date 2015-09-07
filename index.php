<?php
    require_once("bd.php");
?>
<!DOCTYPE>
<html>
<head>
    <title>Work</title>
    <!-- Include own styles -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Include jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</head>
<body>
<div id="container">
<div id="index_title">Web-development blog<span id="index_add_entries"></span> <span><a href="admin/add.php"><span class="label label-default">
                                                                            Add entries</span></a></span>
</div>
<hr />
<div>
<span id="posts">Posts</span><br /><br />
<div id="content">
<?php
    //Use for loop to get all entries
    $query = mysql_query("SELECT * FROM content");
    while($result = mysql_fetch_array($query)){
        printf("<span id='date'>%s</span><p id='name'><a id='link' href='detail.php?id=%s'>%s</a></p>",
                    $result["date"], $result["id"], iconv('UTF-8', 'windows-1251', $result["title"]));
    }

?>
</div>
</div>
</body>
</html>