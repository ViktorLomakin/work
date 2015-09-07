<?php
    require_once("../bd.php");
?>
<!DOCTYPE>
<html>
<head>
    <title>Work</title>
    <!-- Include own css styles -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Include Jquery -->
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
<div id="result"></div>
<?php
//Get comment ID
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 1;
}
//Select comment by ID
$query = mysql_query("SELECT * FROM comments WHERE id='$id'");
$result = mysql_fetch_array($query);
$result["email"] = iconv('UTF-8', 'windows-1251', $result["email"]);
$result["comment"] = iconv('UTF-8', 'windows-1251', $result["comment"]);
echo "
        <form action='ajax.php' method='post' enctype='multipart/form-data'>
        <h1 id='add_comments'><span class='label label-default'>Edit comment</span></h1>
            
        <div  id='title_comments' class='col-xs-2'>
            <input type='text' name='text' id='email' value=$result[email] placeholder='example@gmail.com' class='form-control'>
        </div>
        <br /><br />
        <div class='form-group' id='area_comments'>
          <textarea class='form-control' rows='5' id='comment_content' name='commentText'  placeholder='Text'>$result[comment]</textarea>
        </div>    
        <input type='hidden' id='commentId' value=$id>
        <input type='button' name='comment_update' id='comment_update' value='Update comments' class='btn btn-default'>
        </form> ";


?>
</div>
<script>
//Function to redirect on index page
function reloadPage() {
    window.location = '../index.php';
}
//If update comment
$('#comment_update').bind('click', function(){
    //Get fields info
    var email = $('#email').val();
    var comment = $('#comment_content').val();
    var comment_update = $('#comment_update').val();
    var id = $('#commentId').val();
    //console.log(email);
    //console.log(comment);
    //console.log(submit);
    //console.log(id);
    
    //отправл€ю POST запрос и получаю ответ
    $.ajax({
        type:'post',//тип запроса: get,post либо head
        url:'ajax.php',//url адрес файла обработчика
        data:{
            userEmail: email,
            userComment: comment,
            commentId: id,
            comment_update: comment_update
        },//параметры запроса
        response:'text',//тип возвращаемого ответа text либо xml
        success:function (data) {//возвращаемый результат от сервера
            //console.log(data);
            if(data == 'True') {
                $('#result').html('<div class="alert alert-success">Add success</div>');
                setTimeout(reloadPage, 1000);
            } else {
                $('#result').html('<div class="alert alert-warning">Error!Please check your fields!</div>');
            }
        }
    }); 
});

</script>
</body>
</html>