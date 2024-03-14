<?php

define("DBHOST", 'localhost');
define("DBUSER", 'dragun');
define("DBPASS", 'password');
define("DB", 'test2');


try {
    // Подключение к базе данных
    $pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DB, DBUSER, DBPASS);

    // Установка режима ошибок и исключений
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Подготовка запроса
    $stmt = $pdo->prepare("SELECT * FROM categories");

    // Выполнение запроса
    $stmt->execute();

    // Получение всех результатов в виде ассоциативного массива
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $modifiedResults = array();
    foreach ($results as $row) {
        $categoryId = $row['categories_id'];
        $modifiedResults[$categoryId] = $row;
    }

} catch (PDOException $e) {
    // В случае ошибки выводим сообщение
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}



