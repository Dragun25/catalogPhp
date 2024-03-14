$(document).ready(function () {
    // Приклад обробки події для селектбоксу сортування
    $('#sort').on('change', function () {
        updateProductList();
    });

    // Приклад обробки події для радіокнопок категорій
    $(document).on('change', '.catalog-radio', function () {
        updateProductList();
    });

    // Початкове завантаження категорій та товарів
    loadCategories();
    updateProductList();

    function loadCategories() {
        // Виклик AJAX для отримання категорій та їх відображення
        $.ajax({
            url: 'get_categories.php',
            method: 'GET',
            dataType: 'html',
            cache: false,
            success: function (data) {
                $('#categories').html(data);
            },
            error: function (xhr, status, error) {
                console.log('Помилка AJAX-запиту для отримання категорій:');
                console.log('Статус:', status);
                console.log('Помилка:', error);
            }
        });
    }

    function updateProductList() {
        // Отримання обраних значень сортування та категорії
        var sortOption = $('#sort').val();
        var selectedCategory = $('.catalog-radio:checked').val();

        // Формування URL з GET-параметрами
        var url = 'get_products.php?sort_option=' + sortOption;
        if (selectedCategory) {
            url += '&category_id=' + selectedCategory;
        }

        // Виклик AJAX для оновлення списку товарів
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            cache: false,
            success: function (data) {
                $('#products').html(data);

                // Завантаження стилів (необов'язково)
                loadStyles();
            },
            error: function (xhr, status, error) {
                console.log('Помилка AJAX-запиту для оновлення списку товарів:');
                console.log('Статус:', status);
                console.log('Помилка:', error);
            }
        });

        // Оновлення URL без перезавантаження сторінки (необов'язково)
        window.history.pushState({}, document.title, url);
    }

    function loadStyles() {
        // Виклик AJAX для завантаження стилів (залежить від вашої структури стилів)
        // Приклад:
        $.ajax({
            url: 'styles.css', // Ваш файл стилів
            method: 'GET',
            dataType: 'text',
            cache: false,
            success: function (styles) {
                // Застосування завантажених стилів
                $('<style>').text(styles).appendTo('head');

                // Позначте, що стилі вже були завантажені
                sessionStorage.setItem('stylesLoaded', 'true');
            },
            error: function (xhr, status, error) {
                console.log('Помилка AJAX-запиту для завантаження стилів:');
                console.log('Статус:', status);
                console.log('Помилка:', error);
            }
        });
    }

    // Перевірте, чи стилі вже були завантажені при попередніх відвідуваннях сторінки
    var stylesLoaded = sessionStorage.getItem('stylesLoaded');
    if (!stylesLoaded) {
        // Якщо стилі ще не завантажені, тоді завантажте їх
        loadStyles();
    }
    function updateProducts() {
        $.ajax({
            url: 'get_products.php', // URL для отримання товарів
            method: 'GET',
            cache: false,
            dataType: 'html', // Вказуємо тип даних як HTML
            success: function (response) {
                $('#products').html(response); // Замінюємо вміст елементу #products отриманим HTML
            },
            error: function (xhr, status, error) {
                console.log('Помилка AJAX-запиту для оновлення товарів:');
                console.log('Статус:', status);
                console.log('Помилка:', error);
            }
        });
    }

// Виклик функції для оновлення товарів при потребі
    updateProducts();

    var modal = document.getElementById("myModal");
    var closeBtn = document.getElementsByClassName("close")[0];

// Знаходимо всі кнопки "Купити" за їх класом
    var buyButtons = document.querySelectorAll('.buy-button');

// Додаємо подію click для кожної кнопки
    buyButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Отримуємо назву товару з атрибута data-product-name
            var productName = button.getAttribute('data-product-name');

            // Вставляємо назву товару у модальне вікно
            document.getElementById("productName").innerHTML = "Ви купуєте: " + productName;

            // Показуємо модальне вікно
            modal.style.display = "block";
        });
    });

// При натисканні на кнопку закриття, ховаємо модальне вікно
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

// При натисканні поза модальним вікном, також ховаємо його
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

});

document.addEventListener('DOMContentLoaded', function() {
    // Отримуємо кнопку "Купити" і модальне вікно
    var buyButtons = document.querySelectorAll('.buy-button');
    var popup = document.getElementById('popup');
    var selectedProduct = document.getElementById('selected-product');

    // Додаємо подію click на всі кнопки "Купити"
    buyButtons.forEach(function(buyButton) {
        buyButton.addEventListener('click', function() {
            // Отримуємо назву товару з атрибута data-product-id
            var productId = buyButton.getAttribute('data-product-id');

            // Вставляємо інформацію про вибраний продукт у модальне вікно
            selectedProduct.innerHTML = 'Ви обрали продукт з ID: ' + productId;

            // Показуємо модальне вікно
            popup.style.display = 'block';
        });
    });

    // Додаємо подію click на кнопку "Закрити" модального вікна
    document.getElementById('close-popup').addEventListener('click', function() {
        // Ховаємо модальне вікно
        popup.style.display = 'none';
    });
});