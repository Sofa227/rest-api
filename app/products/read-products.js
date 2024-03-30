// Функция для отображения списка товаров
function showProducts() {

    // Получаем список товаров из API
    $.getJSON("http://rest-api/api/product/read.php", data => {

        // HTML для перечисления товаров
        readProductsTemplate(data, "");

        // Изменяем заголовок страницы
        changePageTitle("Все товары");
    });
}