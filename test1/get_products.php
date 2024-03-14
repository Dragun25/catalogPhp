<?php
// Перевіряємо, чи була сторінка запущена при перезавантаженні
if (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0') {
    header("Location: index.php");
    exit;
}
elseif (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'no-cache') {
    header("Location: index.php");
    exit;
}
include 'Database.php';

// Отримання вибору сортування та категорій від користувача з GET-параметрів
$sortOption = isset($_GET['sort_option']) ? $_GET['sort_option'] : 'price_asc';
$categoryIds = isset($_GET['category_id']) ? $_GET['category_id'] : [];

// Підготовка SQL-запиту для отримання відсортованих товарів
$sql = "SELECT * FROM products";
if (!empty($categoryIds)) {
    $sql .= " WHERE category_id IN (" . $categoryIds . ")";
}
$sql .= " ORDER BY " . getOrderByClause($sortOption);

// Отримання відсортованих товарів з бази даних
$sortedProducts = $db->select($sql);

// Виведення відсортованих товарів
foreach ($sortedProducts as $product) {
    echo '<div class="product">';
    echo '<h2>' . $product['name'] . '</h2>';
    echo '<p>Ціна: $' . $product['price'] . '</p>';
    echo '<button class="buy-button" data-product-id="' . $product['product_id'] . '">Купити</button>';
    echo '</div>';
}

// Закриття з'єднання з базою даних
$db->close();

// Функція для отримання відсортованого за замовчуванням рядка ORDER BY
function getOrderByClause($sortOption) {
    switch ($sortOption) {
        case 'name_asc':
            return 'name ASC';
        case 'date_desc':
            return 'date_added DESC';
        default:
            return 'price ASC';
    }
}
