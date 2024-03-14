<?php
class Database {
    private $host = 'localhost';
    private $username = 'dragun';  //Укажите свой логин к БД
    private $password = 'password';  //Укажите свой пароль к БД
    private $database = 'test';  //Имя БД
    private $connection;


    public function __construct() {
        $this->connect();
    }

    // З'єднання з базою даних
    private function connect() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Перевірка на помилки при підключенні
        if ($this->connection->connect_error) {
            die("Помилка підключення до бази даних: " . $this->connection->connect_error);
        }
    }

    // Виконання запиту SELECT
    public function select($query) {
        $result = $this->connection->query($query);

        // Перевірка на помилки при виконанні запиту
        if (!$result) {
            die("Помилка запиту: " . $this->connection->error);
        }

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    // Виконання запиту INSERT, UPDATE, DELETE
    public function query($query) {
        $result = $this->connection->query($query);

        // Перевірка на помилки при виконанні запиту
        if (!$result) {
            die("Помилка запиту: " . $this->connection->error);
        }

        return $result;
    }

    // Закриття з'єднання при завершенні роботи
    public function close() {
        $this->connection->close();
    }
}

// Створення об'єкта класу Database
$db = new Database();

