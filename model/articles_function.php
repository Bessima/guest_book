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
class ShowArticle extends Article{
	public $count_page;
	const COUNT_ARTICLE = 10;

	public function ArticlesShow()
	{

		if (isset($_GET['page']))
			$page  = ($_GET['page']-1);
		else
			$page = 0;
		$start=abs($page*(self::COUNT_ARTICLE));

		$query=sprintf("SELECT * FROM article WHERE visible=1 ORDER BY data DESC LIMIT %d,%d",$start,self::COUNT_ARTICLE);
		$result=mysql_query($query);

		$query_for_pagin = mysql_query("SELECT * FROM article WHERE visible=1");
		$this->count_page=mysql_num_rows($query_for_pagin);
		if ($this->count_page%20==0)
			$this->count_page = (int)($this->count_page/self::COUNT_ARTICLE);
		else
			$this->count_page = (int)($this->count_page/self::COUNT_ARTICLE)+1;


		//Извлечение данных из БД
		$i=0;
		while ($row = mysql_fetch_assoc($result)) {
			$this->author[$i] = $row['author'];
			$this->text[$i] = $row['text'];
			$this->data[$i] = $row['data'];
			$i++;
		}
		}
	}

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







