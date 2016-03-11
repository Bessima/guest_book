<!DOCTYPE html>
<html>
<head>
	<title>Гостевая книга</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../style/admin.css" type="text/css">
</head>
<body>
	<div id = 'top'>
		<h1>Гостевая книга</h1>
	</div>
	<div id = 'menu'>
		<a href='../index.php'>Вернуться в гостевую</a>
	</div>

	<div id = "content">
		
		<table id="admin">
			<tr>
				<td >Отправитель</td>
				<td >Сообщение</td>
				<td >E-mail</td>
				<td >Дата</td>
				<td colspan="2">Редактировать</a></td>
			</tr>
			<?php $i=0;
			for($i=0;$i<count($article->id);$i++): ?>
			<tr>
				<td ><?=$article->author[$i]?></td>
				<td ><?=$article->text[$i]?></td>
				<td ><?=$article->email[$i]?></td>
				<td ><?=$article->data[$i]?></td>
				<td ><a href="index.php?type=admin&action=delete&id=<?=$article->id[$i]?>">Удалить</a>
				<td ><a href="index.php?type=admin&action=show&id=<?=$article->id[$i]?>">Опибликовать</a>
			</tr>
		<? endfor?>
	</div>
	<footer>
		<center>&copy;GuestBook</center>
	</footer>
</body>
</html>