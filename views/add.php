<!DOCTYPE html>
<html>
<head>
	<title>Добавление сообщения</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../style/add.css" type="text/css">
</head>
<body>
	<div id = 'top'>
		<h1>Гостевая книга</h1>
	</div>
	<div id = 'menu'>
		<a href='#'>Добавить запись</a>
		<a href='../index.php'>Вернуться в гостевую</a>
	</div>

	<div id = "content">
    <form method='post' action="index.php?action=add" enctype='multipart/form-data'>
    <h2>Добавление сообщения</h2>
        <label for='author'> Имя: </label> <input type ='text' maxlength="255" name="author" autofocus required /> <br/>
        <label for='email'>E-mail: </label><input type='email' name="email" maxlength="255" required/><br/>
        Сообщение: <br/><textarea name='text' maxlength="512" required></textarea><br/>

    <p><input type='submit' value='Отправить' />
        <input type='reset' value='Очистить' /></p>
    </form>
	</div>
	<footer>
		<center>&copy;GuestBook</center>
	</footer>
</body>
</html>