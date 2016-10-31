
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="sing.php" method="POST">
            <input type="text" name="user">
            <input type="password" name="password">
            <input type="submit" name="go" value="Войти">
        </form>
        <?php
        require 'DataBase.php';
        require 'autodb.php';
        $go = filter_input(INPUT_POST, 'go');
        $b = new Base();
        if(isset($go)){
        $name = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_SPECIAL_CHARS);
        $userpassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $id = $db->query("SELECT id FROM user WHERE name=$name AND pass=$userpassword");
        $b->setId($id);
            header("Location: Privat24.php"); 
            exit();
        }
        ?>
    </body>
</html>
