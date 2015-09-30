<?php 

$blog_post = true;
$author = "Enda"; // author is always going to be Enda :)
$published_date = date('jS \of F Y \a\t H:i', $page->created);
$content = $page->body;

// if there are images, lets choose one to output at the head of the content
if(count($page->images)) {
	// if the page has images on it, grab one of them randomly... 
	$image = $page->images->getRandom();
	// resize it to 400 pixels wide
	$image = $image->width(900); 
}