<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог товарів</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="script.js"></script>
    <style>
        /* Стилі для лівого сайдбара та товарів у форматі "три в ряд" */
        #container {
            display: flex;
        }

        #sidebar {
            width: 20%; /* Ширина лівого сайдбара */
            padding: 10px;
            background-color: #f0f0f0;
        }

        #products {
            width: 80%; /* Ширина контейнера для товарів */
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .product {
            width: 30%; /* Ширина блоку товару */
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        /* Інші стилі можна додати за потреби */
    </style>
</head>
<body>
<div class="popup" id="popup">
    <h2>Ви обрали:</h2>
    <div id="selected-product"></div>
    <button id="close-popup">Закрити</button>
</div>
<div id="container">

    <!-- Лівий сайдбар з категоріями -->
    <div id="sidebar">
        <h2>Категорії</h2>
        <select id="sort">
            <option value="price_asc">Спочатку дешевші</option>
            <option value="name_asc">По алфавіту</option>
            <option value="date_desc">Спочатку нові</option>
        </select>
        <div id="categories">
            <!-- Категорії будуть вставлятися AJAX-ом -->
        </div>
        <a href="index.php">Сбросить фильтр</a>
    </div>

    <!-- Контейнер для товарів -->
    <div id="products">
        <!-- Товари будуть вставлятися AJAX-ом -->
    </div>

</div>
<!-- Модальне вікно -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="productName"></p>
    </div>
</div>
</body>
</html>
