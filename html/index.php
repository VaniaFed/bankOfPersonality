<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,400,500,700,900" rel="stylesheet">
    <script src="index.js"></script>
    <link href="css/index.css" rel="stylesheet">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <title>Банк Личности</title>
  </head>
  <body>
    <div class="wrapper">
    <?php require("html/header.php") ?>
      <section class="section welcome_screen" id="welcome_screen">
        <div class="container">
          <h2 class="welcome_screen-title_description">Собирайте свою жизнь, как по кирпичикам</h2>
          <h5 class="welcome_screen-text_help">Давайте визуализируем это</h5>
          <form class="form-container">
            <h5 class="title2">Что вы сделали?</h5>
            <div class="form-input_text-container">
              <input class="form-input_text" type="text" placeholder="Занятие/задача">
              <input class="form-input_text" type="text" placeholder="Количество очков">
            </div>
            <div class="form-radio-container">
              <h3 class="title2">Вы получили пользу или вред?</h3>
              <label class="form__label" for="deal_good">Пользу</label>
              <input class="form__input_radio" id="deal_good" type="radio" checked name="deal">
              <label class="form__label" for="deal_bad">Вред</label>
              <input class="form__input_radio" id="deal_bad" type="radio" name="deal">
            </div>
            <input class="form__submit" type="submit" value="Отправить">
          </form>
        </div>
      </section>
      <section class="section user_profile">
        <div class="container">
          <div class="title1">Ваш профиль</div>
          <div class="user_data-profile">
            <div class="user_data-profile-container clearfix">
              <div class="user_data-profile-avatar"></div>
              <div class="user_data-profile-text_container">
                <div class="user_data-profile__nickname">vaniafed</div>
                <div class="user_data-profile__score_text">На вашем счете <span class="user_data-profile__score_big">3k</span> очков</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="section user_data">
        <div class="container">
          <div class="title1">Ваша история</div>
          <div class="user_data-container">
            <div class="user_data-container__date">12.04.2018</div>
            <div class="user_data-item">
              <div class="user_data__score">+ 100</div>
              <div class="user_data__text">30 fkds flkdsj lfkdsj flksd</div>
              <div class="user_data__date">12.02.2017</div>
            </div>
            <div class="user_data-item">
              <div class="user_data__score">+ 100</div>
              <div class="user_data__text">30 минут чтения</div>
              <div class="user_data__date">12.02.2017</div>
            </div>
            <div class="user_data-item">
              <div class="user_data__score">+ 100</div>
              <div class="user_data__text">30 минут чтения</div>
              <div class="user_data__date">12.02.2017</div>
            </div>
          </div>
          <div class="user_data-container">
            <div class="user_data-container__date">12.04.2018</div>
            <div class="user_data-item">
              <div class="user_data__score">+ 100</div>
              <div class="user_data__text">30 fkds flkdsj lfkdsj flksd</div>
              <div class="user_data__date">12.02.2017</div>
            </div>
            <div class="user_data-item">
              <div class="user_data__score">+ 100</div>
              <div class="user_data__text">30 минут чтения</div>
              <div class="user_data__date">12.02.2017</div>
            </div>
            <div class="user_data-item">
              <div class="user_data__score">+ 100</div>
              <div class="user_data__text">30 минут чтения</div>
              <div class="user_data__date">12.02.2017</div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>
