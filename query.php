<?php
function getUser(int $user_id): User | null{
	return null;
}

function getPost(int $post_id, int $child_list): Post | null{
    if($post_id <= 0 || $child_list <= 0){
        return null;
    }
    $count = 10;
    $com = ($child_list - 1) * $count;



    $data = DataBaseGetLine("SELECT * FROM v_post WHERE id = {$post_id} AND (comment = 0 OR comment > {$com})  LIMIT 1;");
    if(isset($data) && is_array($data)){
        return new Post($data, true, $child_list);
    }
	return null;
}
function getPostFather(int $post_id): Post | null{
    if($post_id <= 0){
        return null;
    }
    $data = DataBaseGetLine("SELECT * FROM v_post WHERE id = {$post_id} LIMIT 1;");
    if(isset($data) && is_array($data)){
        return new Post($data);
    }
	return null;
}
function getPostChild(int $post_id, int $list = 1): array{
    if($list <= 0 || $post_id <= 0){
        return [];
    }

    $count = 10;
    $from = ($list - 1) * $count;

    $arr = DataBaseGetArray("SELECT * FROM v_post WHERE answer = {$post_id} LIST {$from}, {$count};");
    
    $ret = [];
    for($i = 0; $i < count($arr); $i++){
        $ret[] = new Post($arr[$i]);
    }
    return $ret;
}
?>