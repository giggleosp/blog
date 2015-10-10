<?php 

$blog_list = true;

$entries = $pages->find('template=blog-entry');

foreach ($entries as $entry) {
	if(count($page->images)) {
		$image = $page->images->getRandom();
	}
	$content .= "<a href='{$entry->url}'><h2>{$entry->title}</h2></a>";
	$published_date = date('d/m/y', $entry->created);
	$content .= "<span class='small-date'>Posted on $published_date</span>";
	$content .= getStartText($entry->body);
	$content .= "...";
}

function getStartText($text) {
	return substr($text, 0, strpos($text, ' ', 250));
}