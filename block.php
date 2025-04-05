<?php
function blockHead(string $title){
	include(__DIR__."/block/head.php");
}
function blockHeader(){
	include(__DIR__."/block/header.php");
}

function blockPost(Post $post) {
    include(__DIR__."/block/post.php");
}

?>