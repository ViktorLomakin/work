<?php
    require_once("../bd.php"); //Include connect to BD
    require_once('../classes/base.php'); // Include main classes
    //Add entries
    if(isset($_POST['submit'])) {
        //echo $_POST['title'] . '|' . $_POST['tags'] . '|' . iconv('UTF-8', 'windows-1251', $_POST['content']);
        
        $addObject = new Content;
        $title = iconv('UTF-8', 'windows-1251', $_POST['title']);
        $tags = iconv('UTF-8', 'windows-1251', $_POST['tags']);
        $content = iconv('UTF-8', 'windows-1251', $_POST['content']);
        if($title == '' || $tags == '' || $content == '') {
            echo 'False';
        } else {
            if($addObject->add($title, $tags, $content, 'On')) echo 'True';
            else echo 'False';
        }
    }
    //Update entries
    if(isset($_POST['submit_edit'])) {
        $addObject = new Content;
        $title = iconv('UTF-8', 'windows-1251', $_POST['title']);
        $tags = iconv('UTF-8', 'windows-1251', $_POST['tags']);
        $content = iconv('UTF-8', 'windows-1251', $_POST['content']);
        $status = iconv('UTF-8', 'windows-1251', $_POST['status']);
        $id = $_POST['editId'];
        if($title == '' || $tags == '' || $content == '') {
            echo 'False';
        } else {
            if($addObject->setValuesById($id, $title, $content, $tags, $status)) echo 'True';
            else echo 'False';
        }
    }
    //Update comment
    if(isset($_POST['comment_update'])) {
        //echo $_POST['commentId'] . '|' . $_POST['userEmail'] . '|' . $_POST['userComment'];
        $updateComment = new Comments;
        $id = iconv('UTF-8', 'windows-1251', $_POST['commentId']);
        $email = iconv('UTF-8', 'windows-1251', $_POST['userEmail']);
        $commentText = iconv('UTF-8', 'windows-1251', $_POST['userComment']);
        if($updateComment->setCommentById($id, $email, $commentText)) echo 'True';
        else echo 'False';
        
    }

?>