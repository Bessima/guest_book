		<?php
		header("Content-Type: text/html; charset = utf8");
		require_once "/model/articles_function.php";
		//header($_SERVER['SERVER_PROTOCOL']."404 Not Found",true);
		/*$uri = preg_replace('/(^\/)|(\?.*?$)/', '', $_SERVER['REQUEST_URI']);
		$uri = preg_replace('/\.[^s]\w+$/', '', $uri);*/
		require_once 'database.php';
		$link = new Db;
		$link->ConnectDb();

		include "controller/controller.php";
		$control = new Controller();
		$control->TypeEnter();