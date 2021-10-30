<?php
function sidebar_news ()
{
	$news_sidebar = R::getAll('SELECT * FROM news ORDER BY id DESC LIMIT 3');
	foreach ($news_sidebar as $news)
	{
	?>
		<li class="active-list-item">
			<a href="/article?id=<?=$news['id']?>"><?=$news['title']?></a>
		</li>
	<?php
	}
}
?>

