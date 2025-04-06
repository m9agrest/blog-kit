<?php
include(__DIR__."/properties.php");
include(__DIR__."/data_base.php");
include(__DIR__."/block.php");
include(__DIR__."/model.php");
include(__DIR__."/query.php");

function stop(int $code, string $text = "", string $more = "", bool $json = false) {
    DataBaseClose();  // Закрываем соединение с базой данных

    // Логируем ошибку
    error_log("Error {$code}: {$text} {$more}");

    // Устанавливаем HTTP статус
    http_response_code($code);

    if ($json) {
        // Для API-ответов выводим в формате JSON
        header('Content-Type: application/json');
        echo json_encode(["error" => $text]);
    } else {
        // Для обычных запросов выводим текст ошибки
        if ($text !== "") {
            echo $text;
        }
    }

    // Завершаем выполнение скрипта
    exit();
}

$pages = explode("/", $_SERVER["REDIRECT_URL"]);
$page = array_pop($pages);
$list = 1;
if(is_numeric($page)){
    $list = (int)$page;
    $page = array_pop($pages);
}

session_start();
$session_user_id = 0;
if(isset($_SESSION['device']) && isset($_SESSION['ip']) && isset($_SESSION['id'])){
	if($_SESSION['device'] == $_SERVER['HTTP_USER_AGENT'] && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'] && $_SESSION['id'] > 0){
		$session_user_id = $_SESSION['id'];
	}
}
define("SESSION_ID", $session_user_id);


//подгрузка страниц
if(preg_match('/^post(\d+)$/', $page, $matches)){
    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $post_id = (int) $matches[1];
        include(__DIR__."/page/post.php");
    }else{
        stop(403, json: true);
    }
}elseif(preg_match('/^user(\d+)$/', $page, $matches)){
    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $user_id = (int) $matches[1];
        include(__DIR__."/page/user.php");
    }else{
        stop(403, json: true);
    }
}else{
    stop(404);
}


?>