<?php
    require_once("bd.php");
?>
<!DOCTYPE>
<html>
<head>
    <title>Work</title>
    <!-- Include own styles -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Include jquery library -->
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

<?php
//Get id entries
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1;
}
//Create buttons Add, Edit and Delete
$query = mysql_query("SELECT * FROM content WHERE id='$id'");
$result = mysql_fetch_array($query);
printf('<div id="index_title">Web-development blog
<span id="status"><span class="label label-primary">%s</span></span>
<a href=admin/delete.php?id=%s&name="entries"><span id="delete_entries" class="label label-danger">Delete</span></a>
<span><a href="admin/edit.php?id=%s"><span class="label label-default">
Edit entries</span></a></span>
</div>', $result['status'], $id, $id);
?>
<hr />
<div>
<?php
//Select special entries by ID
$result["title"] = iconv('UTF-8', 'windows-1251', $result["title"]);
$result["content"] = iconv('UTF-8', 'windows-1251', $result["content"]);
echo "
    <div>
        <p id='detail_title'> $result[title] <br /><br /> <span id='detail_date'> $result[date] </span></p>
        <div id='detail_content'> $result[content] </div>
    </div>
";
//Select and show all comments
$query2 = mysql_query("SELECT * FROM comments WHERE contentId='$id'");
while($result2 = mysql_fetch_array($query2)) {
    $result2["email"] = iconv('UTF-8', 'windows-1251', $result2["email"]);
    $result2["comment"] = iconv('UTF-8', 'windows-1251', $result2["comment"]);
    printf('<hr /><div id="commentBlock"><span id="commentAuthor">%s</span><p id="userComment">%s</p></div>
    <h3>
    <a href=admin/editComment.php?id=%s><span id="edit_comment" class="label label-default">Edit</span></a>
    <a href=admin/delete.php?id=%s&name="comment"><span id="delete_comment" class="label label-danger">Delete</span></a>
    </h3>
    <br>
    <hr />',$result2["email"], $result2["comment"], $result2["id"], $result2["id"]);
}
?>
<hr />
<div id="comments">
<?php
//If status NEW or OPEN show form
//Otherwise dont show form(CLOSED)
if($result["status"] != "Closed")
    echo "
        <form action='comments.php' method='post' enctype='multipart/form-data'>
        <h1 id='add_comments'><span class='label label-default'>Add comment</span></h1>
            
        <div  id='title_comments' class='col-xs-2'>
            <input type='email' name='email' id='email' placeholder='example@gmail.com' class='form-control'>
        </div>
        <br /><br />
        <div class='form-group' id='area_comments'>
          <textarea class='form-control' rows='5' id='comment_content' placeholder='Text'></textarea>
        </div>    
        <input type='hidden' id='contentId' value=$id>
        <input type='button' name='comment_submit' id='comment_submit' value='Adding comments' class='btn btn-default'>
        </form> ";
    
?>
</div>
<script>
//If form submit, send ajax query
$('#comment_submit').bind('click', function(){
    //Get fields info
    var email = $('#email').val();
    var comment = $('#comment_content').val();
    var submit = $('#comment_submit').val();
    var id = $('#contentId').val();
    //console.log(email);
    //console.log(comment);
    //console.log(submit);
    //console.log(id);
    //отправл€ю POST запрос и получаю ответ
    $.ajax({
        type:'post',//тип запроса: get,post либо head
        url:'comments.php',//url адрес файла обработчика
        data:{
            userEmail: email,
            userComment: comment,
            commentId: id,
            userSubmit: submit
        },//параметры запроса
        response:'text',//тип возвращаемого ответа text либо xml
        success:function (data) {//возвращаемый результат от сервера
            //console.log(data);
            if(data == 'True') location.reload(); //reload this page
            else alert("Error! Please check your fields!"); //Alert error
        }
    });
    
});





</script>
</body>
</html>