<?php

interface Controller{
    public function type_enter();
}
class Control implements Controller
{
    public $type;
    public $action;
    function type_enter()
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

    function user()
    {
        $article = new Show_Article();
        $article->articles_show();

        include "/views/articles.php";
    }

    function admin()
    {
        $article = new Admin_Change();
        $article->show_admin();
        include "/views/articles_admin.php";
        if (isset($_GET['action']))
        {
            $this->action = $_GET['action'];
            $this->admin_action($this->action);
        }
        else
            $this->action = "";
    }
    function admin_action($action){
        $article = new Admin_Change();
        switch ($action)
        {
            case 'delete':
                $id = $_GET['id'];
                $article->articles_delete($id);
                header("Location: index.php?type=admin");
                break;
            case 'show':
                $id = $_GET['id'];
                $article ->articles_visible($id);
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
                $article->show_admin();
                include "../views/articles_admin.php";
                break;
        }
    }
    function add()
    {
        include "/views/add.php";
    }
}
