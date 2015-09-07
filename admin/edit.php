<?php
    require_once('../bd.php');
?>
<html>
<head>
    <title>Add entries</title>
    <!-- Include nicEditor for add images and text -->
	<script type="text/javascript" src="nicEdit.js"></script> <script type="text/javascript">
    //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    //]]>
    </script>
    <!-- Include Jquery -->	
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- Include own css styles -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
  	<!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>			
</head>
<body>

<div id="result"></div>
<div>
<?php
//Get entries ID
if(isset($_GET['id'])) {
    $detailId = $_GET['id'];
} else {
    $detailId = 1;
}
//Get special entries by ID
$query = mysql_query("SELECT * FROM content WHERE id='$detailId'");
$result = mysql_fetch_array($query);
$result["title"] = iconv('UTF-8', 'windows-1251', $result["title"]);
$result["tags"] = iconv('UTF-8', 'windows-1251', $result["tags"]);
$result["content"] = iconv('UTF-8', 'windows-1251', $result["content"]);
echo "<form action='add.php' method='post' enctype='multipart/form-data'>
    <h1 id='add_title'><span class='label label-primary'>Edit entries</span></h1>
        
    <div style='margin-left: 40%;' class='col-xs-2'><input type='text' name='title' id='title' placeholder='title'
    value=$result[title] class='form-control'></div>
    <br /><br />
    <div style='margin-left: 40%;' class='col-xs-2'><input type='text' name='tags' id='tags' placeholder='tags'
    value=$result[tags] class='form-control'></div>
    <br /><br /> 
    <div class='form-group'>
      <select class='form-control' id='sel1'>
        <option>New</option>
        <option>Open</option>
        <option>Closed</option>
      </select>
    </div>
    <p style='margin-left: 20%;'><textarea name='area' id='area' style='width: 80%;' rows='10' cols='30'>$result[content]</textarea></p>
    <input type='hidden' value=$detailId id='editId'>
    
    <input type='button' name='submit' id='submit' value='Accept edit' class='btn btn-primary'
     style='margin-bottom: 10px; margin-left: 43%;'>
    </form>";
?>    
</div>




<script>
//Function to redirect on index page
function reloadPage() {
    window.location = '../index.php';
}

//If update entries
$('#submit').bind('click', function(){
    //Get all fields
    var title = $('#title').val();
    var tags = $('#tags').val();
    var content = nicEditors.findEditor('area').getContent();
    var submit_edit = $('#submit').val();
    var editId = $('#editId').val();
    var status = $('#sel1').val();
    //console.log(title);
    //console.log(tags);
    //console.log(content);
    //console.log(submit);
    //console.log(editId);

    //отправл€ю POST запрос и получаю ответ
    $.ajax({
        type:'post',//тип запроса: get,post либо head
        url:'ajax.php',//url адрес файла обработчика
        data:{
            title: title,
            tags: tags,
            content: content,
            editId: editId,
            status: status,
            submit_edit: submit_edit
        },//параметры запроса
        response:'text',//тип возвращаемого ответа text либо xml
        success:function (data) {//возвращаемый результат от сервера
            console.log(data);
            if(data == 'True') {
                $('#result').html('<div class="alert alert-success">Add success</div>');
                setTimeout(reloadPage, 1000);
            } else if(data == 'False') {
                $('#result').html('<div class="alert alert-warning">Error!Please check your fields!</div>');
            }
        }
    });

});




</script>
</body>
</html>