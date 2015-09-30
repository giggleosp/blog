<?php 

$hide_published_details = $page->hide_published_details;
$author = "Enda"; // author is always going to be Enda :)
$published_date = date('d-M-y', $page->created);
$content .= $page->body;