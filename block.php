<?php
function blockHead(string $title){
	include(__DIR__."/block/head.php");
}
function blockHeader(){
	$user = getUser(SESSION_ID);
	include(__DIR__."/block/header.php");
}

function blockPost(Post $post, string $type = "") {
	if($type != ""){
		$type .= "-";
	}
    include(__DIR__."/block/post.php");
}

function blockPagination(int $list, int $count, string $item){
	$total_pages = ceil($count / COUNT_LIST);
	if($total_pages > 1){
		include(__DIR__."/block/pagination.php");
	}
}
?>