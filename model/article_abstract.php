<?php
abstract class Article
{

    public $author = array();
    public $text = array();
    public $data = array();

    function __construct($author,$text,$data)
    {
        $this->author = $author;
        $this->text = $text;
        $this->data = $data;
    }

}