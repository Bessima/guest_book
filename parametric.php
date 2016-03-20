<?php
class Parametric
{
    protected $type;
    protected $action;
    protected $id;
    protected $new_author;
    protected $new_email;
    protected $new_text;

    function Get_Type()
    {
        if (isset($_GET['type']))
            $this->type = $_GET['type'];
        else
            $this->type = "user";

    }
    function Get_Action()
    {
        if (isset($_GET['action']))
        {
            $this->action = $_GET['action'];
        }
        else
            $this->action = "";
        $this->id = $_GET['id'];
    }
    function Post_Add()
    {
        $this->new_author = htmlspecialchars(trim($_POST['author']));
        $this->new_email = htmlspecialchars(trim($_POST['email']));
        $this->new_text = htmlspecialchars(trim($_POST['text']));
    }
}