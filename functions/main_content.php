<?php
	function main_content()
	{
	$themes = R::getAll( 'SELECT * FROM themes LIMIT 5' );
?>
		<h2>Главная страница форума, добро пожаловать!</h2>
			<div>
				<a href="/theme_creator.php">Создать тему</a>
				<br />
				<a href="/admin.php">Администрация сайта</a>
				<h3>Тут расположены популярные разделы сайта.</h3>
				<ul class="topics">
				<?php
				foreach ($themes as $theme)
				{
					$user = R::load('users', $theme['creator_id']);
				?>
					<li class="topic-list-item">
						<a href="/theme?id=<?=$theme['id']?>"><strong><?=$theme['title']?></strong></a>
						<p><?=$theme['text']?></p>
						<a href="/profile?id=<?=$user->id?>"><?=$user->login?></a>
					</li>
				<?php
				}
				?>
				</ul>
			</div>
<?php
	}
?>