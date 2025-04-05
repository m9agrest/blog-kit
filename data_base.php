<?php
$DataBaseConnect = null;
/**
 * Подключение к базе данных
 * @return mysqli База данных
 */
function DataBase(): mysqli {
	global $DataBaseConnect;
	if(!isset($DataBaseConnect) || $DataBaseConnect->connect_errno) {
		$DataBaseConnect = mysqli_connect(DATABASE_HOSTNAME, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
		if($DataBaseConnect && !$DataBaseConnect->connect_errno){
			$DataBaseConnect->set_charset("utf8");
		}else{
			stop(500, "DataBase connect is bad", $DataBaseConnect->error);
		}
	}
	return $DataBaseConnect;
}
/**
 * Запрос к базе данных
 * @param string $request Запрос
 * @return array|bool|null Возвращает массив, представляющий выбранную строку, null , если в наборе результатов больше нет строк или false в случае возникновения ошибки.
 */
function DataBaseGetLine(string $request): array|bool|null {
	return mysqli_fetch_array(DataBaseRequest($request));
}
/**
 * Получить id записи, с autoincrement
 * @return int|string Id записи
 */
function DataBaseGetInsertId(): int|string {
	return mysqli_insert_id(DataBase());
}
/**
 * Запрос к базе данных
 * @param string $request Запрос
 * @return bool|mysqli_result Возвращает false в случае возникновения ошибки. В случае успешного выполнения запросов, которые создают набор результатов, таких как SELECT, SHOW, DESCRIBE или EXPLAIN, mysqli_query() вернёт объект mysqli_result. Для остальных успешных запросов mysqli_query() вернёт true .
 */
function DataBaseRequest(string $request): bool|mysqli_result {
	return mysqli_query(DataBase(), $request);
}
/**
 * Возвращает все результаты
 * 
 * @param string $request Запрос
 * @return array Возвращает массив содержащий ассоциативные или обычные массивы с данными результирующей таблицы.
 */
function DataBaseGetArray(string $request): array {
	return mysqli_fetch_all(DataBaseRequest($request), MYSQLI_ASSOC);
}
/**
 * Закрываем соединение с базой данных
 * @return bool Функция возвращает логическое значение true.
 */
function DataBaseClose(): bool{
	global $DataBaseConnect;
	if(isset($DataBaseConnect)){
		return mysqli_close($DataBaseConnect);
	}
	return false;
}
/**
 * Выполнение подготовленного запроса
 * 
 * @param string $query SQL запрос с параметрами
 * @param array $params Массив параметров для подстановки в запрос
 * @return mysqli_result|bool Возвращает результат запроса или false при ошибке
 */
function DataBasePreparedRequest(string $query, array $params = []): bool|mysqli_result {
    $stmt = DataBase()->prepare($query);
    if ($stmt === false) {
		stop(500, 'DataBase connect is bad', DataBase()->error);
    }
	if (!empty($params)) {
        // Определяем типы для каждого параметра в запросе
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i'; // для целых чисел
            } elseif (is_double($param)) {
                $types .= 'd'; // для чисел с плавающей точкой
            } else {
                $types .= 's'; // для строк
            }
        }

        $stmt->bind_param($types, ...$params); // Подставляем параметры
    }
    $stmt->execute(); // Выполнение запроса
    return $stmt->get_result(); // Получение результатов
}
?>