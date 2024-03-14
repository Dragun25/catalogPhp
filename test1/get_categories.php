<?php

include 'Database.php';

// Отримання категорій з бази даних
$categories = $db->select("SELECT * FROM catalog");

// Виведення категорій у вигляді чекбоксів
echo '<form>';
foreach ($categories as $category)
{
    echo '<label><input type="radio" name="category" class="catalog-radio" value="' . $category['category_id'] . '"> ' . $category['name'] . '</label><br>';
}
echo '</form>';

// Закриття з'єднання з базою даних
$db->close();

