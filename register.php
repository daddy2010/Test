
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="register.php" method="POST">
            <h3>Введите логин</h3>
            <input type="text" name="username">
            <br>
            <h3>Введите пароль</h3>
            <input type="password" name="pass">
            <br>
            <input type="submit" name="button" value="Зарегистрироваться">
        </form>
        <?php
        require 'DataBase.php';
        $button = filter_input(INPUT_POST,'button');
        if(isset($button)){
        $user = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
        $db->exec("INSERT INTO user(name,pass) VALUES ('$user','$pass')");
            header("Location: sing.php"); 
            exit();
        }
        ?>
    </body>
</html>
