<?php
    require_once("../bd.php"); // Include connect to BD
    require_once('../classes/base.php'); // Include main classes
    //If DELETE comment
    if(isset($_GET['name']) == 'comment') {
        $id = $_GET['id'];
        $deleteObject = new Comments;
        if($deleteObject->delete($id)) echo '<script>window.location.href="../index.php"</script>';
        else echo 'False';
    }
    //If DELETE etries
    if(isset($_GET['name']) == 'entries') {
        $id = $_GET['id'];
        $deleteObject = new Content;
        if($deleteObject->delete($id)) echo '<script>window.location.href="../index.php"</script>';
        else echo 'False';
    }



?>