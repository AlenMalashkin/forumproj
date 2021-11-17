<?php 
function nav () {
$user = R::findOne('users', 'id = ?', [$_SESSION['logged_user']->id]);
?>
<ul class="navigation">
		<li class="nav-item">
			<a href="/">Форум</a>
		</li>
		<li class="nav-item">
			<a href="/news">Новости сайта</a>
		</li>
		<li class="nav-item">
			<a href="/reportbook">Книга жалоб и предложений</a>
		</li>
		
	<?php if (isset($_SESSION['logged_user']))
	{?>
		<li class="nav-item" style="float:right">
			<a class="active" href="/register">Реистрация</a>
		</li>
		<li class="nav-item" class="active" style="float:right">
			<a class="active" href="/login">Войти</a>
		</li>
		<li class="nav-item" class="active" style="float:right">
			<a class="active" href="/profile?id=<?=$user->id?>">Профиль</a>
		</li>

		<li class="nav-item" class="active" style="float:right">
			<a class="active" href="/logout">Выйти</a>
		</li>
	<?php } else {?>
		<li class="nav-item" style="float:right">
			<a class="active" href="/register">Реистрация</a>
		</li>
		<li class="nav-item" class="active" style="float:right">
			<a class="active" href="/login">Войти</a>
		</li>
	<?php } ?>

</ul>
<?php
}
?>