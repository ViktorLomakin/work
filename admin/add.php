<html>
<head>
    <title>Add entries</title>
    <meta charset="utf-8">
    <!-- Include nicEditor for upload images and text -->
	<script type="text/javascript" src="nicEdit.js"></script> <script type="text/javascript">
    //<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
    //]]>
    </script>	
    <!-- Include Jquery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- Include own CSS styles -->
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
    <form action='add.php' method='post' enctype='multipart/form-data'>
    <h1 id="add_title"><span class="label label-primary">Add entries</span></h1>
        
    <div style="margin-left: 40%;" class="col-xs-2"><input type='text' name='title' id='title' placeholder='title' class="form-control"></div>
    <br /><br />
    <div style="margin-left: 40%;" class="col-xs-2"><input type='text' name='tags' id='tags' placeholder='tags' class="form-control"></div>
    <br /><br />    
    <p style="margin-left: 20%;"><textarea name='area' id='area' style='width: 80%;' rows="10" cols="30"></textarea></p>
    <input type='button' name='submit' id='submit' value='Adding entries' class="btn btn-primary"
     style='margin-bottom: 10px; margin-left: 43%;'>
    </form>
</div>




<script>
//Define function to redirect on Index page
function reloadPage() {
    window.location = '../index.php';
}
//If form is submit
$('#submit').bind('click', function(){
    //Get main fields
    var title = $('#title').val();
    var tags = $('#tags').val();
    var content = nicEditors.findEditor('area').getContent();
    var submit = $('#submit').val();
    //console.log(title);
    //console.log(tags);
    //console.log(content);
    //console.log(submit);
    

    //отправл¤ю POST запрос и получаю ответ
    $.ajax({
        type:'post',//тип запроса: get,post либо head
        url:'ajax.php',//url адрес файла обработчика
        data:{
            title: title,
            tags: tags,
            content: content,
            submit: submit
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