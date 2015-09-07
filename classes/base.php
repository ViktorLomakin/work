<?php
//Main class for entries
class Content {
    //Define main fields
    public $title;
    public $content;
    public $tags;
    public $status;    
    public $test = "test";
    //Add entries
    public function add($title, $tags, $content, $status) {
        $title = iconv('windows-1251', 'UTF-8', $title);
        $tags = iconv('windows-1251', 'UTF-8', $tags);
        $content = iconv('windows-1251', 'UTF-8', $content);
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
        $this->status = $status;
        $today = date("M j, Y");
        $query = mysql_query("INSERT INTO content(title, content, tags, date, status) 
                                            VALUES('$title', '$content', '$tags', '$today', '$status')");
        if($query) return true;
        else return false;
    }
    //Get entries by ID
    public function getValuesById($id) {
        $query = mysql_query("SELECT * FROM content WHERE id = '$id' ");
        $result = mysql_fetch_array($query);
        return $result;
    }
    //Update entries
    public function setValuesById($id, $title, $content, $tags, $status) {
        $title = iconv('windows-1251', 'UTF-8', $title);
        $tags = iconv('windows-1251', 'UTF-8', $tags);
        $content = iconv('windows-1251', 'UTF-8', $content);
        $contentId = $id;
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
        $this->status = $status;
        $query = mysql_query("UPDATE content SET title = '$title', content='$content', tags='$tags', status='$status'
                              WHERE id='$contentId'");
        if($query) return true;
        else return false;
    }
    //Delete entries by ID
    public function delete($id) {
        $query = mysql_query("DELETE FROM content WHERE id = '$id'");
        if($query) return true;
        else return false;
    }
    
}
//Create main class for comments
class Comments {
    //Define main fields
    public $email;
    public $comment;
    //Define method ADD for comments
    public function add($email, $comment, $id) {
        $email = iconv('windows-1251', 'UTF-8', $email);
        $comment = iconv('windows-1251', 'UTF-8', $comment);
        $this->email = $email;
        $this->comment = $comment;
        $contentId = $id;
        $today = date("M j, Y");
        $query = mysql_query("INSERT INTO comments(email, comment, date, contentId) 
                                            VALUES('$email', '$comment', '$today', '$contentId')");
        if($query) return true;
        else return false;
    }
    //Get comment by ID
    public function getCommentById($id) {
        $query = mysql_query("SELECT * FROM comments WHERE id = '$id' ");
        $result = mysql_fetch_array($query);
        return $result;
    }
    //Update comment by ID
    public function setCommentById($id, $email, $comment) {
        $email = iconv('windows-1251', 'UTF-8', $email);
        $comment = iconv('windows-1251', 'UTF-8', $comment);
        $this->email = $email;
        $this->comment = $comment;
        $query = mysql_query("UPDATE comments SET email = '$email', comment = '$comment' WHERE id = '$id' ");
        if($query) return true;
        else return false;
    }
    //Delete comment by ID
    public function delete($id) {
        $query = mysql_query("DELETE FROM comments WHERE id = '$id'");
        if($query) return true;
        else return false;
    }
}
?>