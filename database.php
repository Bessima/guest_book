<?php

class Db
{
	const SERVER = "localhost";
	const USER = "root";
	const PASSWORD = "";
	const DB = "guest";

	function ConnectDb(){

		$link = mysql_connect(self::SERVER,self::USER,self::PASSWORD);
		if (mysql_select_db(self::DB)){
			mysql_query("SET NAMES utf8_decode()");
		}
		else {
			echo "Отсутствие БД на сервере"."Error: ".mysql_error($link);
		}
		return $link;
	}
}