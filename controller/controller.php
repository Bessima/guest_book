<?php

require_once 'IController.php';

class Controller implements IController
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
                $this->User();
                break;
            case 'admin':
                $this->Admin();
                break;
            case 'add':
                $this->Add();
                break;
        }
    }

    function User()
    {
        $article = new ShowArticle();
        $article->ArticlesShow();

        include "/views/articles.php";
    }

    function Admin()
    {
        $article = new ChangeOfAdmin();
        $article->ShowAdminArticle();
        include "/views/articles_admin.php";
        if (isset($_GET['action']))
        {
            $this->action = $_GET['action'];
            $this->DoAdmin($this->action);
        }
        else
            $this->action = "";
    }
    function DoAdmin($action){
        $article = new ChangeOfAdmin();
        switch ($action)
        {
            case 'delete':
                $id = $_GET['id'];
                $article->DeleteArticle($id);
                header("Location: index.php?type=admin");
                break;
            case 'show':
                $id = $_GET['id'];
                $article ->VisibleArticle($id);
                header("Location: index.php");
                break;
            case 'add':
                header("Content-Type: text/html; charset = utf8");
                $author = htmlspecialchars(trim($_POST['author']));
                $email = htmlspecialchars(trim($_POST['email']));
                $text = htmlspecialchars(trim($_POST['text']));
                $article-> CheckNewArticle($author, $email, $text);
                header("Location: ../message/good.php");
                break;
            default:
                $article->ShowAdminArticle();
                include "../views/articles_admin.php";
                break;
        }
    }
    function Add()
    {
        include "/views/add.php";
    }
}
