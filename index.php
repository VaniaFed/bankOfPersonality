<!DOCTYPE html>
<html>
<?php require_once("html/head.php")?>
 <body>
    <div class="wrapper">
    <?php require("html/header.php") ?>
      <section class="section welcome_screen" id="welcome_screen">
        <div class="container">
          <h2 class="welcome_screen-title_description">Собирайте свою жизнь, как по кирпичикам</h2>
          <h5 class="welcome_screen-text_help">Давайте визуализируем это</h5>
          <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" class="form-container">
            <h5 class="title2">Что вы сделали?</h5>
            <div class="form-input_text-container">
              <input class="form-input_text" name="text" type="text" placeholder="Занятие/задача">
              <input class="form-input_text" name="score" type="text" placeholder="Количество очков">
            </div>
            <div class="form-radio-container">
              <h3 class="title2">Вы получили пользу или вред?</h3>
              <label class="form__label" for="deal_good">Пользу</label>
              <input class="form__input_radio" id="deal_good" type="radio" value="deal_plus" checked name="deal">
              <label class="form__label" for="deal_bad">Вред</label>
              <input class="form__input_radio" id="deal_bad" type="radio" value="deal_minus" name="deal">
            </div>
            <?php
                require_once("db.php");

                $user_id = $_COOKIE['user_id'];
                $data_get_current_values = "SELECT summary_score FROM user WHERE id = '$user_id'";
                $query_get_current_values = mysqli_query($connection, $data_get_current_values);
                $current_score = mysqli_fetch_array($query_get_current_values, MYSQLI_ASSOC)['summary_score'];

                if ( isset($_COOKIE['user_id']) ) {
                    if ( isset($_POST['submit']) ) {
                        if ( !empty($_POST['text']) && !empty($_POST['score']) ) {
                            $text = $_POST['text'];

                            $data_get_current_values = "SELECT summary_score FROM user WHERE id = '$user_id'";
                            $query_get_current_values = mysqli_query($connection, $data_get_current_values);
                            $current_score = mysqli_fetch_array($query_get_current_values, MYSQLI_ASSOC)['summary_score'];

                            if ( isset($_POST['deal']) && $_POST['deal'] == 'deal_plus' ) {
                                $score = '+'.$_POST['score'];
                                $current_score += $_POST['score'];
                            } else {
                                $score = '-'.$_POST['score'];
                                $current_score -= $_POST['score'];
                            }

                            echo 'Тукещая скорость% '. $current_score;
                            $data_post_current_score = "UPDATE user SET summary_score = '$current_score' WHERE id = '$user_id'";
                            $query_post_current_score = mysqli_query($connection, $data_post_current_score);

                            $time = date("H:i:s");
                            $date = date("Y").'-'.date("m").'-'.date("d");
                            
                            $data_history = "INSERT INTO history VALUES (NULL, '$user_id', '$score', '$text', '$time', '$date')";
                            $query_history = mysqli_query($connection, $data_history);




                            if (!$query_history) {
                                echo 'Суши носки<br>';
                            } else {
                                setcookie(last_entry_history, $date, time() + (60*60*24*90));
                            }
                            header('Location: /');

                        } else {
                            echo 'Вы заполнили не все поля.';
                        }
                    }
                } else {
                    echo 'Вы забыли залогиниться.';
                }
            ?>
            <input class="form__submit" name="submit" type="submit" value="Отправить">
          </form>
        </div>
      </section>
      <section id="profile" class="section user_profile">
        <div class="container">
          <div class="title1">Ваш профиль</div>
          <div class="user_data-profile">
            <div class="user_data-profile-container clearfix">
              <div class="user_data-profile-avatar"></div>
              <div class="user_data-profile-text_container">
              <div class="user_data-profile__nickname"><?php if ($_COOKIE['user_login']) echo $_COOKIE['user_login']; else echo $_COOKIE['user_login']?></div>
              <div class="user_data-profile__score_text">На вашем счете <span class="user_data-profile__score_big"><?php echo $current_score ?></span> очков</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section user_data">
        <div class="container">
          <div class="title1">Ваша история</div>
              <div class="user_data-container">
              <?php
                //делаем запрос к таблице history и выводим
                
                  $user_id = $_COOKIE['user_id'];
                  $data_history = "SELECT * FROM history WHERE user_id = '$user_id' ORDER BY date DESC, time";
                  $query_history = mysqli_query($connection, $data_history);
                  if (!$query_history) {
                      echo 'Суши тапки';
                  }

                  $prev_date = '';
                  while ($history_row = mysqli_fetch_array($query_history, MYSQLI_ASSOC)) {
                      $score = $history_row['score'];
                      $text = $history_row['text'];
                      $date_for_time = date_create_from_format('H:i:s', $history_row['time']);
                      $time = date_format($date_for_time, "H:i");
                      $current_date = date_create_from_format('Y-m-d', $history_row['date']);
                      $current_date = date_format($current_date, 'd.m.Y');
                      if ($prev_date == $current_date) {
                          echo "<div class=\"user_data-item\"> <div class=\"user_data__score\">$score</div> <div class=\"user_data__text\">$text</div> <div class=\"user_data__date\">$time</div> </div>";
                      } else {
                          echo "<div class=\"user_data-container__date\">$current_date</div><div class=\"user_data-item\"> <div class=\"user_data__score\">$score</div> <div class=\"user_data__text\">$text</div> <div class=\"user_data__date\">$time</div> </div>";
                      }
                      $prev_date = $current_date;
                  }
                ?>
            </div>
        </div>
      </section>
    </div>
  </body>
</html>
