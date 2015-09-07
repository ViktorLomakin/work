<?php
    require_once("bd.php"); //Include connect to bd
    require_once('classes/base.php'); //Include main classes
    //If comment submit
    if(isset($_POST['userSubmit'])) {
        //echo $_POST['userEmail'] . '|' . $_POST['userComment'];
        
        $commentObject = new Comments; //Create main object
        //Get user comment info
        $email = iconv('UTF-8', 'windows-1251', $_POST['userEmail']);
        $comment = iconv('UTF-8', 'windows-1251', $_POST['userComment']);
        $id = $_POST['commentId'];
        //If user comment is not empty
        if($email == '' || $comment == '') {
            echo 'False';
        } else {
            if($commentObject->add($email, $comment, $id)) echo 'True'; //Add comment
            else echo 'False';
        }
        
    }



?>