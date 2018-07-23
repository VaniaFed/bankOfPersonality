<?php
    require_once ("html/head.php");
    require_once ("html/header.php");
    require("db.php");
?>
<div class="container">
    <h2 class="title1 left">Регистрация</h2>
    <?php
        $submit = $_POST['submit'];

        if (isset($_COOKIE['user_id'])) {
            header("Location: index.php");
        }
        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $passRepeat = $_POST['pass_repeat'];
            if (!empty($login) && !empty($email) && !empty($pass) && $pass == $passRepeat) {
                // ошибок нет, регестрируем
                $data = "SELECT * FROM user WHERE nickname = '$login'";
                $queryCheckLogin = mysqli_query($connection, $data);
                
                if (mysqli_num_rows($queryCheckLogin) == 0) {
                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                    $queryRegistration = "INSERT INTO user VALUES ('$login', '$email', '$pass', NULL, 0)";
                    $query = mysqli_query($connection, $queryRegistration);

                    $user_id = mysqli_insert_id($connection);

                    setcookie(user_id, $user_id, time() + (60*60*24*90));
                    setcookie(user_login, $login, time() + (60*60*24*90));
                    setcookie(user_email, $email, time() + (60*60*24*90));
                    setcookie(user_password, $pass, time() + (60*60*24*90));

                    header("Location: index.php");
                } else {
                    echo 'Пользователь с таким логином уже есть';
                }
            } else {
                echo 'Вы заполнили не все поля или пароли не совпадают';
            }
        }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input name="login" placeholder="Логин" class="form-input_text" type="text" value="<?php echo $login?>">
        <input name="email" placeholder="Email" class="form-input_text" type="email" value="<?php echo $email?>">
        <input name="pass" placeholder="Пароль" class="form-input_text" type="password">
        <input name="pass_repeat" placeholder="Повторите пароль" class="form-input_text" type="password">
        <input name="submit" class="form__submit" type="submit" value="Зарегестрироваться">
    </form>
</div>
