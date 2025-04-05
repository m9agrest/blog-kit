<?php
function getUser(int $user_id): User | null{
    if($user_id <= 0){
        return null;
    }
    $data = DataBaseGetLine("SELECT * FROM v_user WHERE id = {$user_id} LIMIT 1;");
    if(isset($data) && is_array($data)){
        return new User($data);
    }
	return null;
}

function getPostUser(int $user_id, int $list): array | null{
    if($user_id <= 0 || $list <= 0){
        return null;
    }
    $data = DataBaseGetArray("SELECT * FROM v_post");
    return null;
}

function getPost(int $post_id, int $child_list): Post | null{
    if($post_id <= 0 || $child_list <= 0){
        return null;
    }
    $com = ($child_list - 1) * COUNT_LIST;

    $data = DataBaseGetLine("SELECT * FROM v_post WHERE id = {$post_id} AND (comment = 0 OR comment > {$com}) LIMIT 1;");
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

    $from = ($list - 1) * COUNT_LIST;

    $arr = DataBaseGetArray("SELECT * FROM v_post WHERE answer = {$post_id} LIST {$from}, {COUNT_LIST};");
    
    $ret = [];
    for($i = 0; $i < count($arr); $i++){
        $ret[] = new Post($arr[$i]);
    }
    return $ret;
}
?>