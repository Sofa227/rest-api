<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Биллинговая система</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <div id="cd-login">
        <form class="cd-form"  action="signin.php" method="POST">
            <p class="fieldset">
                <input class="full-width has-padding has-border" id="signin-email" type="text" placeholder="Логин" name="signin_login">
            </p>
    
            <p class="fieldset">
                <input class="full-width has-padding has-border" id="signin-password" type="text" placeholder="Пароль" name="signin_password">
                <a href="#0" class="hide-password">Скрыть</a>
            </p>
    
            <p class="fieldset">
                <input class="full-width" type="submit" value="Войти">
            </p>
        </form>
    </div> 
    <script src="main.js"></script>
</body>
</html>
