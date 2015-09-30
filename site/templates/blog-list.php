<?php 

$hide_published_details = $page->hide_published_details;

$entries = $pages->find('template=blog-entry');

foreach ($entries as $entry) {
	// $content .= "<a href='{$entry->url}'><h2>{$entry->title}</h2></a>";
	// $content .=
}