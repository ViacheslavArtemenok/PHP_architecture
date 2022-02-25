<?php
require_once "config.php";
spl_autoload_register(function ($class) {
    include 'models/' . $class . '.php';
});

$user = new User(
    $reg_way,
    $reg_way_text,
    $content,
    $footer,
    $mega_title,
    $config_salt1,
    $config_salt2,
    $config_connect,
    $config_auth_login,
    $config_auth_pass,
    $config_get_first_name,
    $config_get_second_name,
    $config_get_age,
    $config_get_phone,
    $config_get_gend,
    $config_get_email,
    $config_get_passw,
    $config_path,
    $config_show_user_photo,
    $config_controller_name,
    $config_action,
    $config_way_for_login_in_account
);
if ($_POST['type']) { ///SUBMIT КНОПКИ "MORE", POST ПРИХОДИТ ОТ AJAX
    $config_type = $_POST['type'];
}
if ($_GET['move'] == 'product') { ///РЕНДЕРИНГ РЕКЛАМНЫХ КАРТОЧЕК ВНИЗУ PRODUCT
    $config_for_where = ":r1, :r2, :r3";
    $cat_max_i = 4;
}
$catalog = new Catalog($content, $footer, $config_type, $config_more_counter, $config_some_gender, $config_for_where, $cat_max_i, $config_search_data);

$cart = new Cart($content, $config_data_cart, $config_data_user, $config_adress_cart);
$reviews = new Reviews($content, $config_get_name, $config_get_city, $config_rev_user_photo, $config_rev_path, $config_rev_text);

$arr_vars = $user->get_vars(); // МАРКЕРЫ ССЫЛОК
$reg_way = $arr_vars['reg_way'];
$reg_way_text = $arr_vars['reg_way_text'];
$content = $arr_vars['content'];
$mega_title = $arr_vars['mega_title'];

if (empty($_GET['c'])) {
    $footer = $user->get_footer();
}

if ($_GET['del']) { //ВЫХОД ИЗ ЛИЧНОГО КАБИНЕТА
    $user->exit();
}
if (!empty($_POST['check_pass'])) { //АВТОРИЗАЦИЯ
    $user->authorization();
}
if (!empty($_POST['updater'])) { //ОБНОВЛЕНИЕ ДАННЫХ ЛИЧНОГО КАБИНЕТА
    $user->update();
}
if (!empty($_POST['email']) && empty($_POST['updater'])) { //РЕГИСТРАЦИЯ
    $user->registration();
}

if ($_GET['c'] == 'catalog' && $_GET['move'] != 'product') { ///РЕНДЕРИНГ КАТАЛОГА ТОВАРОВ
    $arr = $catalog->get_content_cat();
    $content = $arr['content'];
    $footer = $arr['footer'];
    $config_some_gender = $arr['gender'];
}

if ($_GET['move'] == 'product') { ///РЕНДЕРИНГ СТРАНИЧКИ PRODUCT
    $content = $catalog->get_content_prd();
}


if (!empty($_GET['c'] == 'cart' && $_GET['state'] == 'show')) { ///РЕНДЕРИНГ КОРЗИНЫ ТОВАРОВ
    $content = $cart->get_content_cart();
}

if (!empty($_POST['order'])) { ////ОТПРАВКА ЗАКАЗА В БАЗУ ДАННЫХ 
    $cart->send_order();
}

if (!empty($_GET['c'] == 'cart' && $_GET['state'] == 'success')) { ///РЕНДЕРИНГ УВЕДОМЛЕНИЯ ОБ ОТПРАВКЕ ЗАКАЗА
    $content = $cart->get_content_cart_success();
}

if ($_GET['c'] == 'reviews' && $_GET['status'] != 'success') { ///РЕНДЕРИНГ СТРАНИЧКИ ОТЗЫВОВ
    $content = $reviews->get_content_rev();
}
if ($_GET['c'] == 'reviews' && $_GET['status'] == 'success') { ///ОТЗЫВ УСПЕШНО ДОБАВЛЕН
    $content = $reviews->get_content_rev_success();
}

if (!empty($_POST['name_rev']) && $_POST['answer'] == $_POST['correct']) { //ДОБАВЛЕНИЕ ОТЗЫВА В БД
    $content = $reviews->add_review();
}
if ($_POST['answer'] != $_POST['correct']) { //НЕВЕРНАЯ КАПЧА
    $content = $reviews->get_content_rev_error();
}
if ($_GET['c'] == 'search') { ///РЕНДЕРИНГ РЕЗУЛЬТАТОВ ПОИСКА
    $content = $catalog->get_content_search();
}

if ($config_way_for_admin == 'admin') {
    $admin = new Admin(
        $content,
        $header,
        $footer,
        $config_type,
        $config_more_counter,
        $config_some_gender,
        $config_admin_id,
        $config_admin_number_g,
        $config_admin_product_name,
        $config_admin_price,
        $config_admin_photo_name,
        $config_admin_text,
        $config_admin_new_photo_name,
        $config_order_type,
        $config_order_id,
        $config_search_data
    );
    $header = $admin->get_header_admin();
    if (empty($_GET['c'])) {
        $arr_admin = $admin->get_content_cat_admin();
        $footer = $arr_admin['footer'];
        $content = 'views/ind_tmp_admin.php';
    }
    if ($_GET['c'] == 'admin_catalog') {
        $arr_admin = $admin->get_content_cat_admin();
        $content = $arr_admin['content'];
        $footer = $arr_admin['footer'];
        $config_some_gender = $arr_admin['gender'];
    }
    if ($_POST['admin_id']) {
        $admin->add_data();
    }
    if ($_GET['c'] == 'admin_orders') {
        $content = $admin->get_content_orders_admin();
    }
    if ($_GET['c'] == 'admin_orders_update') {
        $admin->update_order();
    }
    if ($_GET['c'] == 'search_admin') {
        $content = $admin->get_content_search();
    }
}
