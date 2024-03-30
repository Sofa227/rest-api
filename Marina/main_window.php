
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Биллинговая система</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="background_color">
        <div class="wrapper" id="header_div">
            <nav class="exit-nav">
                <li><a class="cd-exit" id="cd-exit-id" href="exit.php" >Выход</a></li>
            </nav>
        </div>
    </header>

    <main>
    <div class="wrapper">
        <h2>Добавление клиента</h2>
        <form id="addClientForm" action="send_bd.php" method="POST">
            <input type="text" id="clientOrganisation" name="clientOrganisation" placeholder="Название организации">

            <input type="text" id="clientName" name="clientName" placeholder="Имя клиента">

            <input type="text" id="clientSurname" name="clientSurname" placeholder="Фамилия клиента">

            <input type="text" id="clientPatronymic" name="clientPatronymic" placeholder="Отчество клиента">

            <input type="tel" id="clientTelephon" name="clientTelephon" placeholder="Номер телефона">

            <input type="email" id="clientEmail" name="clientEmail" placeholder="Email">

            <input type="date" id="clientDateOfBirth" name="clientDateOfBirth" placeholder="Дата рождения">

            <input type="text" id="clientAddress" name="clientAddress" placeholder="Адрес подключения">

            <button type="submit" class="submit">Добавить клиента</button>
        </form>
        
        <h2>Изменение информации о клиенте</h2>
        <form id="updateClientForm">
            <input type="text" id="clientId" name="clientId" placeholder="ID клиента">

            <p>
                <select name="clientBalance" id="clientBalance" >
                    <option value="clientBalance0">-- Баланс --</option>
                    <option value="clientBalance1">Положительный баланс</option>
                    <option value="clientBalance2">Отрицательный баланс</option>
                </select>
            </p>

            <p>
                <select name="clientCorrection" id="clientCorrection" >
                    <option value="clientCorrection0">-- Корректировка --</option>
                    <option value="clientCorrection1">Увеличение баланса</option>
                    <option value="clientCorrection2">Уменьшение баланса</option>
                </select>
            </p>
            
            <p>
                <input type="number" id="clientLimit" name="clientLimit" placeholder="Лимит">
            </p> 

            <p>
                <select name="clientStatus" id="clientStatus" >
                    <option value="clientStatus0">-- Статус --</option>
                    <option value="clientStatus1">Подключение</option>
                    <option value="clientStatus2">Активен</option>
                    <option value="clientStatus3">Блокировка</option>
                    <option value="clientStatus4">Расторгнут</option>
                </select>
            </p>

            <p>
                <select name="clientType" id="clientType" >
                    <option value="clientType0">-- Тип --</option>
                    <option value="clientType1">Физическое лицо</option>
                    <option value="clientType2">Юридическое лицо</option>
                </select>
            </p>

            <p>
                <select name="clientPayment" id="clientPayment" >
                    <option value="clientPayment0">-- Поступивший платеж --</option>
                    <option value="clientPayment1">QR-код</option>
                    <option value="clientPayment2">Автоплатеж</option>ъъ
                    <option value="clientPayment3">Банковский платеж</option>
                    <option value="clientPayment4">Наличный платеж</option>
                    <option value="clientPayment5">Оплата картой</option>
                    <option value="clientPayment6">Платеж «Почта России»</option>
                    <option value="clientPayment7">Сбер-онлайн</option>
                    <option value="clientPayment8">СБП</option>
                </select>
            </p>

            
            <p>
                <input type="number" id="clientOutgoes" name="clientOutgoes" placeholder="Расходы денежных средств">
            </p> 

            <p>
                <select name="clientService" id="clientPayment" >
                    <option value="clientService0">-- Услуги с периодом списания денежных средств --</option>
                    <option value="clientService1">Услуга – Видеонаблюдение</option>
                    <option value="clientService2">Услуга – Домофония</option>ъъ
                    <option value="clientService3">Услуга – Интернет</option>
                    <option value="clientService4">Услуга – Оборудование</option>
                    <option value="clientService5">Услуга – Подписка на программное обеспечение</option>
                    <option value="clientService6">Услуга – Телевидение</option>
                    <option value="clientService7">Услуга – Телефонная связь</option>
                    <option value="clientService8">Услуга – Хостинг веб-ресурсов</option>
                </select>
            </p>

            <button type="submit">Добавить информацию</button>
        </form>
        
        <h2>Удаление клиента</h2>
        <form id="deleteClientForm" action="delete.php" method="POST">
            <input type="text" id="clientEmail" name="clientEmail" placeholder="Email клиента для удаления">
            <button type="submit">Удалить клиента</button>
        </form>
        
        <h2>Управление платежами и расходами</h2>
        <form id="managePaymentsForm">
            <input type="text" id="clientIdPayment" name="clientIdPayment" placeholder="ID клиента">
            <p>
                <button type="submit">Удалить последний платеж</button>
            </p>
            <p>
                <button type="submit">Удалить последний расход</button>
            </p>
            <p>
                <select name="clientPaymentNew" id="clientPaymentNew" >
                    <option value="clientPaymentNew0">-- Поступивший платеж --</option>
                    <option value="clientPaymentNew1">QR-код</option>
                    <option value="clientPaymentNew2">Автоплатеж</option>ъъ
                    <option value="clientPaymentNew3">Банковский платеж</option>
                    <option value="clientPaymentNew4">Наличный платеж</option>
                    <option value="clientPaymentNew5">Оплата картой</option>
                    <option value="clientPaymentNew6">Платеж «Почта России»</option>
                    <option value="clientPaymentNew7">Сбер-онлайн</option>
                    <option value="clientPaymentNew8">СБП</option>
                </select>
                <input type="number" id="addIngo" name="addIngo" placeholder="Сумма платежа">
                <button type="submit">Добавить платеж</button>
            </p>
            <p>
                <select name="clientServiceNew" id="clientPaymentNew" >
                    <option value="clientServiceNew0">-- Услуги с периодом списания денежных средств --</option>
                    <option value="clientServiceNew1">Услуга – Видеонаблюдение</option>
                    <option value="clientServiceNew2">Услуга – Домофония</option>ъъ
                    <option value="clientServiceNew3">Услуга – Интернет</option>
                    <option value="clientServiceNew4">Услуга – Оборудование</option>
                    <option value="clientServiceNew5">Услуга – Подписка на программное обеспечение</option>
                    <option value="clientServiceNew6">Услуга – Телевидение</option>
                    <option value="clientServiceNew7">Услуга – Телефонная связь</option>
                    <option value="clientServiceNew8">Услуга – Хостинг веб-ресурсов</option>
                </select>
                <input type="number" id="addOutgo" name="addOutgo" placeholder="Сумма расхода">
                <button type="submit">Добавить расход</button>
            </p>
        </form>
        
        <h2>Корректировка баланса счета клиента</h2>
        <form id="adjustBalanceForm">
            <input type="text" id="clientIdBalance" name="clientIdBalance" placeholder="ID клиента">
            <input type="number" id="addCorrection" name="addCorrection" placeholder="Сумма корректировки">
            <select name="clientCorrectionNew" id="clientCorrectionNew" >
                    <option value="clientCorrectionNew0">-- Корректировка --</option>
                    <option value="clientCorrectionNew1">Увеличение баланса</option>
                    <option value="clientCorrectionNew2">Уменьшение баланса</option>
            </select>
            <button type="submit">Корректировать баланс</button>
        </form>
        
        <h2>Получение информации о текущем статусе клиента</h2>
        <form id="getClientStatusForm" action="receive_inf.php">
            <input type="text" id="statusClientId" name="statusClientId" placeholder="ID клиента">
            <button type="submit">Получить статус клиента</button>
            <body onload="getClientStatus()">
                <p><textarea id="infoClientStatus" name="newInfo" readonly></textarea></p>
            </body>
            <script>
                // Функция для отправки AJAX запроса и обновления информации о клиенте
                function getClientStatus() {
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            document.getElementById("infoClientStatus").value = xhr.responseText;
                        }
                    };
                    xhr.open("GET", "get_client_status.php", true);
                    xhr.send();
                }

                // Вызываем функцию при загрузке страницы
                getClientStatus();
            </script>
        </form>
        
        <h2>Получение информации о балансе клиента</h2>
        <form id="getClientBalanceForm">
            <input type="text" id="balanceClientId" name="balanceClientId" placeholder="ID клиента">
            <button type="submit">Получить баланс клиента</button>
            <p><textarea id="infoClientBalance" name="infoClientBalance" readonly></textarea></p>
        </form>
        
        <h2>Автоматическое списание денежных средств</h2>
        <form id="autoDebitForm">
            <input type="text" id="autoDebitClientId" name="autoDebitClientId" placeholder="ID клиента">
            <button type="submit">Списать деньги по расписанию</button>
        </form> 
    </div>
    </main>

    <footer class="background_color">
        <div class = "footer_inf"></div>
    </footer>
</body>
</html>
