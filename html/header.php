<header class="header">
<div class="container">
  <div class="header-inner"><a class="header-home" href="index.php">
    <h1 class="header__logo">Банк личности</h1></a>
    <div class="header-user">
    <?php

        if (isset($_POST['logout'])) {
            setcookie(user_id, "", -1);
            setcookie(user_login, "", -1);
            setcookie(user_password, "", -1);
            setcookie(user_email, "", -1);
            setcookie(last_entry_history, "", -1);
            header("Location: index.php");
        }
        if (isset($_COOKIE['user_id'])) {
    ?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>"method="POST">
                <a class="header-user__name" href="#profile"><?php echo $_COOKIE['user_login']?></a>
                <input type="submit" name="logout" class="header-user__logout" value="Выйти">
            </form>
    <?php
        } else {
    ?>
            <a class="header-user__logout" href="signin.php">Войти</a>
            <a class="header-user__logout" href="signup.php">Зарегестрироваться</a>
    <?php
        }
    ?>
</div><a class="header-hamburger" href="#"><span class="header-hamburger__span"></span></a>
  </div>
</div>
</header>
