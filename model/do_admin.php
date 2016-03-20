<?php
require_once 'article_abstract.php';

class ChangeOfAdmin extends Article
{
    public $id = array();
    public $email = array();
    function ShowAdminArticle()
    {
        $query_admin = mysql_query("SELECT * FROM article WHERE visible = 0");
        if (!$query_admin)
            die (mysql_error());

        //Извлечение данных из БД
        $i=0;
        while ($row = mysql_fetch_assoc($query_admin)) {
            $this->id[$i] = $row['id'];
            $this->author[$i] = $row['author'];
            $this->text[$i] = $row['text'];
            $this->email[$i]=$row['email'];
            $this->data[$i] = $row['data'];
            $i++;
        }
    }

    function DeleteArticle($id)
    {
        $id =(int)$id;
        if ($id == 0)
            return false;
        $query = sprintf("DELETE FROM article WHERE id = %d" , $id);
        $result = mysql_query($query);
        if (!$result)
            die(mysql_error());
        return mysql_affected_rows();
    }
    function VisibleArticle($id)
    {
        $id =(int)$id;

        if ($id == 0)
            return false;
        $query = sprintf("UPDATE article SET visible = 1 WHERE id = %d" , $id);
        $result = mysql_query($query);
        if (!$result)
            die(mysql_error());
    }

    /******************Регулярные выражения проверка*********************************************/
    function CheckNewArticle($author,$email,$text)
    {
        $Name = "/^[a-zA-Z]|[а-яА-ЯёЁьЬъЪыЫ]{1,255}$/";
        $Message = "/^([а-яА-ЯёЁa-zA-Z])|(\x7F-\xFF-)|(\s)]/";
        $world = "/script|http|||SELECT|UNION|UPDATE|exe|exec|INSERT|tmp/i";

        if (isset($author) && isset($email) && isset($text)) {

            if (preg_match($Name, $author) && preg_match($world, $author)) {

                if (preg_match($Message, $text) && preg_match($world, $text)) {

                    $query = mysql_query("INSERT INTO article(author,text, email,data,visible)
										VALUES ('$author','$text','$email',NOW(),'0')");
                    readfile("../message/good.html");}
                else
                    readfile("../message/bad_message.html");}
            else readfile("../message/bad_name.html");
            if (!$query)
                die(mysql_error());}

    }
}