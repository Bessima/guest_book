<?php

class Controlller
{
    public $type;
    public $action;
    function TypeEnter()
    {
        if (isset($_GET['type']))
         $this->type = $_GET['type'];
        else
            $this->type = "user";

        switch ($this->type)
        {
            case 'user':
                $this->user();
                break;
            case 'admin':
                $this->admin();
                break;
            case 'add':
                $this->add();
                break;
        }
    }

    function User()
    {
        $article = new Show_Article();
        $article->ArticlesShow();

        include "/views/articles.php";
    }

    function Admin()
    {
        $article = new Admin_Change();
        $article->ShowDataAdmin();
        include "/views/articles_admin.php";
        if (isset($_GET['action']))
        {
            $this->action = $_GET['action'];
            $this->admin_action($this->action);
        }
        else
            $this->action = "";
    }
    function AdminAction($action){
        $article = new Admin_Change();
        switch ($action)
        {
            case 'delete':
                $id = $_GET['id'];
                $article->ArticleDelete($id);
                header("Location: index.php?type=admin");
                break;
            case 'show':
                $id = $_GET['id'];
                $article ->ArticlesVisible($id);
                header("Location: index.php");
                break;
            case 'add':
                header("Content-Type: text/html; charset = utf8");
                $author = htmlspecialchars(trim($_POST['author']));
                $email = htmlspecialchars(trim($_POST['email']));
                $text = htmlspecialchars(trim($_POST['text']));
                $article-> check($author, $email, $text);
                include "../message/good.php";
                break;
            default:
                $article->ShowDataAdmin();
                include "../views/articles_admin.php";
                break;
        }
    }
    function Add()
    {
        include "/views/add.php";
    }
}
