<?php
    require_once ("html/head.php");
    require_once ("html/header.php");
    require_once ("db.php");

?>
<div class="container">
    <h2 class="title1 left">Авторизация</h2>
    <?php
        // Если мы уже залогинены, перейти на другую страницу
        if (isset($_COOKIE['user_id'])) {
            header("Location: index.php");
        }

        // Нажали на кнопку авторизоваться
        if (isset($_POST['submit'])) {
            $login_input = $_POST['login'];
            $pass_input = $_POST['pass'];

            // если все заполнили
            if (!empty($login_input) && !empty($pass_input)) {
                // ищем записи с таким логином
                $data = "SELECT * FROM user WHERE nickname = '$login_input'";
                $query_signIn = mysqli_query($connection, $data);

                // проверяем количество записей с таким логином
                $row_cnt = mysqli_num_rows($query_signIn);
                if ($row_cnt == 1) {
                    $query_data_return = mysqli_fetch_array($query_signIn, MYSQLI_ASSOC);

                    $user_id = $query_data_return['id'];
                    $user_login = $query_data_return['nickname'];
                    $user_email = $query_data_return['email'];
                    $password_hash = $query_data_return['password'];

                    // проверяем пароль
                    if (password_verify($pass_input, $password_hash)) {
                        $user_password = $pass_input;

                        setcookie(user_id, $user_id, time() + (60*60*24*90));
                        setcookie(user_login, $user_login, time() + (60*60*24*90));
                        setcookie(user_password, $user_password, time() + (60*60*24*90));
                        setcookie(user_email, $user_email, time() + (60*60*24*90));

                        header("Location: index.php");
                    } else {
                        echo "Неверный логин или пароль";
                    }
                } else {
                    echo 'Ошибка авторизации. Попробуйте еще раз.';
                }

                mysqli_close($connection);
            }
        }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input name="login" placeholder="Логин" class="form-input_text" type="text">
        <input name="pass" placeholder="Пароль" class="form-input_text" type="password">
        <input name="submit" class="form__submit" type="submit" value="Зарегестрироваться">
    </form>
</div>
