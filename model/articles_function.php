<?php
require_once "article_abstract.php";

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









