<?php
if (isset($_POST['create_news']))
{
	$news = R::dispense('news');
	$news->title = $_POST['news_title'];
	$news->text = $_POST['news_text'];
	$news->comments;
	R::store($news);
	echo "Новость успешно добавлена в базу данных.";
	echo("<meta http-equiv='refresh'>");
}	

function admin()
{
?>
	<div class="content">
		<h2>Панель администратора</h2>
		<p>Добавить новость</p>
		<form method="POST" action="/admin.php">
			<p>Заголовок новости</p>
			<input type="text" name="news_title">
			<p>Текст новости</p>
			<textarea name="news_text">
				
			</textarea>
			<br />
			<input type="submit" name="create_news">
		</form>
	</div>
<?php
}
?>