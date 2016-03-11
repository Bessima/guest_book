		<? header("Content-Type: text/html; charset = utf8");
		//header($_SERVER['SERVER_PROTOCOL']."404 Not Found",true);
		/*$uri = preg_replace('/(^\/)|(\?.*?$)/', '', $_SERVER['REQUEST_URI']);
		$uri = preg_replace('/\.[^s]\w+$/', '', $uri);*/
		require_once 'database.php';
		$link = new DB;
		$link->start();

		include "controller.php";
		$control = new Control();
		$control->type_enter();