<!DOCTYPE html>
<html>
<head>
	<title>Гостевая книга</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/menu.css" type="text/css">
</head>
<body>
	<div id = 'top'>
		<h1>Гостевая книга</h1>
	</div>
	<div id = 'menu'>
		<a href='index.php?type=add'>Добавить запись</a>
		<a href='index.php?type=admin'>Администратор</a>
	</div>

	<div id = "content">
		
		<?php
		$i=0;
		for($i=0;$i<10;$i++):
			if (($article->author[$i])!=''):?>
		<table> 
			<tr>
				<td style="width: 70%"><?=$article->author[$i]?></td>
				<td style="width: 24%"><?=$article->data[$i]?></td>
			</tr>
			<tr>
				<td colspan="2"><b>Сообщение:</b><?=$article->text[$i]?></td>
			</tr>
		</table>
	<?php endif;
			endfor;?>
		<div id="pagin">
		<h1>
			<?php for($i=1;$i<($article->count_page+1);$i++):?>
		</h1>
			<a href="index.php?page=<?=($i)?>"><?=$i?></a>
		<?php endfor;?><br/>
		</div>
	</div>

	<footer>
		<center>&copy;GuestBook</center>
	</footer>
</body>
</html>