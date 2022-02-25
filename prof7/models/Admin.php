<?php
session_start();

abstract class Admin_template
{
    abstract function get_content_cat_admin();
    abstract function get_content_orders_admin();
    abstract function get_header_admin();
    abstract function get_content_search();
    abstract function render();
    abstract function render_search();
    abstract function render_orders();
    abstract function update_order();
    abstract function add_data();
}

class Admin extends Admin_template
{
    public function __construct(
        $content,
        $header,
        $footer,
        $admin_type,
        $admin_more_counter,
        $admin_some_gender,
        $admin_product_id,
        $admin_number_g,
        $admin_product_name,
        $admin_price,
        $admin_photo_name,
        $admin_text,
        $admin_new_photo_name,
        $admin_order_type,
        $admin_order_id,
        $admin_search_data


    ) {
        $this->content = $content;
        $this->header = $header;
        $this->footer = $footer;
        $this->admin_type = $admin_type;
        $this->admin_more_counter = $admin_more_counter;
        $this->admin_some_gender = $admin_some_gender;
        $this->admin_product_id = $admin_product_id;
        $this->admin_number_g = $admin_number_g;
        $this->admin_product_name = $admin_product_name;
        $this->admin_price = $admin_price;
        $this->admin_photo_name = $admin_photo_name;
        $this->admin_text = $admin_text;
        $this->admin_new_photo_name = $admin_new_photo_name;
        $this->admin_order_type = $admin_order_type;
        $this->admin_order_id = $admin_order_id;
        $this->admin_search_data = $admin_search_data;
    }

    private function get_html($taskList, $data, $last_final, $some_gender, $admin_type)
    {
?>
        <div class="product_item">

            <div class="box_pict">
                <img class="pict_img" src="img/<?= $some_gender ?>/<?= $data['photo_name'] ?>" alt="product">

                <label for="fly_to_db_<?= $some_gender ?>_<?= $data['id'] ?>" class="bord_add_to_cart">
                    <div class="add_to_cart">
                        <svg class="add_to_cart_img" width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="logo_svg" d="M14.5 19.937C19 19.937 22.656 15.464 22.656 9.968C22.656 4.472 19 0 14.5 0C13.3631 0.0217413 12.2463 0.303398 11.2351 0.823397C10.2239 1.34339 9.34507 2.08794 8.66602 3C7.12663 4.99573 6.30819 7.45381 6.34399 9.974C6.34399 15.465 10 19.937 14.5 19.937ZM14.5 1.813C18 1.813 20.844 5.472 20.844 9.969C20.844 14.466 17.998 18.125 14.5 18.125C11.002 18.125 8.15603 14.465 8.15503 9.969C8.15403 5.473 11 1.813 14.5 1.813ZM20.844 18.125C20.6036 18.125 20.373 18.2205 20.203 18.3905C20.033 18.5605 19.9375 18.7911 19.9375 19.0315C19.9375 19.2719 20.033 19.5025 20.203 19.6725C20.373 19.8425 20.6036 19.938 20.844 19.938C22.526 19.9399 24.1386 20.6088 25.3279 21.7982C26.5172 22.9875 27.1861 24.6 27.188 26.282C27.1875 26.5221 27.0918 26.7523 26.922 26.9221C26.7522 27.0918 26.5221 27.1875 26.282 27.188H2.71997C2.47985 27.1875 2.24975 27.0918 2.07996 26.9221C1.91016 26.7523 1.81449 26.5221 1.81396 26.282C1.81608 24.6001 2.48517 22.9877 3.67444 21.7985C4.86371 20.6092 6.47608 19.9401 8.15796 19.938C8.39824 19.938 8.62868 19.8425 8.79858 19.6726C8.96849 19.5027 9.06396 19.2723 9.06396 19.032C9.06396 18.7917 8.96849 18.5613 8.79858 18.3914C8.62868 18.2215 8.39824 18.126 8.15796 18.126C5.99541 18.1279 3.92201 18.9875 2.39258 20.5164C0.863144 22.0453 0.00264777 24.1185 0 26.281C0.000794067 27.0019 0.287502 27.693 0.797241 28.2027C1.30698 28.7125 1.99811 28.9992 2.71899 29H26.282C27.0027 28.9989 27.6936 28.7121 28.2031 28.2024C28.7126 27.6927 28.9992 27.0017 29 26.281C28.9974 24.1187 28.1372 22.0457 26.6083 20.5168C25.0793 18.9878 23.0063 18.1276 20.844 18.125Z" fill="#E8E8E8" />
                        </svg>
                        <p class="add_to_cart_text">EDIT GOOD</p>
                    </div>
                </label>
            </div>
            <form class="pd_admin_block" action="index.php?c=admin_catalog&type=<?= $admin_type ?>" method="POST" enctype="multipart/form-data">
                <input name="admin_id" type="text" value="<?= $data['id'] ?>" hidden>
                <input name="admin_number_g" type="text" value="<?= $admin_type ?>" hidden>
                <div class="admin_inputs">
                    <p>Name of good</p>
                    <input name="admin_name" type="text" value="<?= $data['name'] ?>">
                </div>
                <div class="admin_inputs">
                    <p>Price $</p>
                    <input name="admin_price" type="text" value="<?= $data['price'] ?>">
                </div>
                <div class="admin_inputs">
                    <p>Name of photo</p>
                    <input name="admin_photo_name" type="text" value="<?= $data['photo_name'] ?>">
                </div>
                <div class="admin_inputs">
                    <p>Text about</p>
                    <input name="admin_text" type="text" value="<?= $taskList[$data['id']] ?>">
                </div>
                <div class="admin_inputs">
                    <p>Photo</p>
                    <input name="admin_new_photo_name" type="file" accept="image/*">
                </div>
                <input id="fly_to_db_<?= $some_gender ?>_<?= $data['id'] ?>" type="submit" hidden>
            </form>
            <h3 class="pd_tittle"><?= $data['name'] ?></h3>
            <p class="pd_text"><?= mb_substr($taskList[$data['id']], 0, 87, 'UTF-8') ?>...</p>
            <p class="pd_price">$<?= $data['price'] ?></p>
            <input class="uniq_input" value="<?= $last_final ?>" hidden>
        </div>
    <?php
    }

    private function get_html_order_user($arr)
    {
    ?>
        <div class="order_user">
            <div class="user_data">
                <p class="user_data_title">Номер заказа</p>
                <p><?= $arr['order_id'] ?></p>
            </div>
            <div class="user_data">
                <p class="user_data_title">Имя</p>
                <p><?= $arr['first_name'] ?></p>
            </div>
            <div class="user_data">
                <p class="user_data_title">Фамилия</p>
                <p><?= $arr['second_name'] ?></p>
            </div>
            <div class="user_data">
                <p class="user_data_title">возраст</p>
                <p><?= $arr['age'] ?></p>
            </div>
            <div class="user_data">
                <p class="user_data_title">Телефон</p>
                <p><?= $arr['phone'] ?></p>
            </div>
            <div class="user_data">
                <p class="user_data_title">Емейл</p>
                <p><?= $arr['email'] ?></p>
            </div>
            <div class="user_data">
                <p class="user_data_title">Адрес</p>
                <p><?= $arr['adress'] ?></p>
            </div>
        </div>
    <?php
    }

    private function get_html_order_product($arr)
    {
        $sum = $arr['price'] * $arr['quantity'];
        $selector = mb_substr($arr['some_gender'], 0, 1, 'UTF-8')
    ?>
        <div class="order_product">
            <div class="order_product_text">
                <div class="product_data">
                    <p class="product_data_title">Каталог</p>
                    <p><?= $arr['some_gender'] ?></p>
                </div>
                <div class="product_data">
                    <p class="product_data_title">Артикул</p>
                    <p><?= $arr['id'] ?></p>
                </div>
                <div class="product_data">
                    <p class="product_data_title">Название</p>
                    <p><?= $arr['name'] ?></p>
                </div>
                <div class="product_data">
                    <p class="product_data_title">Размер</p>
                    <p><?= $arr['size'] ?></p>
                </div>
                <div class="product_data">
                    <p class="product_data_title">Цена($)</p>
                    <p><?= $arr['price'] ?></p>
                </div>
                <div class="product_data">
                    <p class="product_data_title">Количество</p>
                    <p><?= $arr['quantity'] ?></p>
                </div>
                <div class="product_data">
                    <p class="product_data_title">Сумма($)</p>
                    <p><?= $sum ?></p>
                </div>
            </div>
            <img class="order_product_img" src="<?= 'img/' . $arr['some_gender'] . '/product_' . $selector . $arr['id'] . '.jpg' ?>" alt="Название_картинки_товара">
        </div>
    <?php
    }


    private function get_html_order_tail($sub_total, $id_order)
    {
    ?>
        <div class="order_button_box">
            <div class="product_data">
                <p class="product_data_title">Итого($)</p>
                <p><?= $sub_total ?></p>
            </div>
            <div class="order_buttons">
                <label class="btn" for="<?= "cancel_" . $id_order ?>">
                    <form action="index.php?c=admin_orders_update" method="POST" enctype="multipart/form-data">
                        <input name="order_type" type="text" value="1" hidden>
                        <input name="order_id" type="text" value="<?= $id_order ?>" hidden>
                        <input id="<?= "cancel_" . $id_order ?>" type="submit" hidden>
                        <p>Отменить</p>
                    </form>
                </label>
                <label class="btn" for="<?= "buy_" . $id_order ?>">
                    <form action="index.php?c=admin_orders_update" method="POST" enctype="multipart/form-data">
                        <input name="order_type" type="text" value="3" hidden>
                        <input name="order_id" type="text" value="<?= $id_order ?>" hidden>
                        <input id="<?= "buy_" . $id_order ?>" type="submit" hidden>
                        <p>Оформить</p>
                    </form>
                </label>
            </div>
        </div>
        </div>
        </div>
        <?php
    }


    public function get_content_cat_admin()
    {
        if ($this->admin_type == 1) {
            $this->admin_some_gender = "men";
        } elseif ($this->admin_type == 2) {
            $this->admin_some_gender = "women";
        } elseif ($this->admin_type == 3) {
            $this->admin_some_gender = "kids";
        }
        $this->content = "views/catalog_admin.php";
        $this->footer = "views/footer.php";
        return ['content' => $this->content, 'footer' => $this->footer, 'gender' => $this->admin_some_gender];
    }

    public function get_content_orders_admin()
    {
        $this->content = "views/orders_admin.php";
        return $this->content;
    }

    public function get_header_admin()
    {
        $this->header = "views/header_admin.php";
        return $this->header;
    }
    public function get_content_search()
    {
        $this->content = "views/search_admin.php";
        return $this->content;
    }


    public function render()
    {
        $down = $this->admin_more_counter;
        if (empty($this->admin_more_counter)) {
            $down = 0;
        }
        $up = $down + 10;
        $admin_str = "*";
        $admin_where = " WHERE `id` > :down AND `id` < :up";
        $admin_bind = [':down' => $down, ':up' => $up];
        $max_admin_str = "MAX(`id`)";
        $max_admin_where = NULL;
        $max_admin_bind = NULL;
        if ($this->admin_type == 1) {
            $admin_table = "`men`";
            $this->admin_some_gender = "men";
        } elseif ($this->admin_type == 2) {
            $admin_table = "`women`";
            $this->admin_some_gender = "women";
        } elseif ($this->admin_type == 3) {
            $admin_table = "`kids`";
            $this->admin_some_gender = "kids";
        }
        $data_admin = PdoM::Instance()->Select_All($admin_table, $admin_str, $admin_where, $admin_bind);
        $data_max_id = PdoM::Instance()->Select($admin_table, $max_admin_str, $max_admin_where, $max_admin_bind);
        foreach ($data_max_id as $item) {
            $last_final = $item;
        }

        $file = file_get_contents("data_json/data_" . $this->admin_type . ".json");  // Открыть файл data.json
        $taskList = json_decode($file, true);        // Декодировать в массив 
        if ($data_admin[0]) {
            foreach ($data_admin as $data) { //РЕНДЕР КАТАЛОГА
                $this->get_html($taskList, $data, $last_final, $this->admin_some_gender, $this->admin_type);
            }
        }
    }

    public function render_search()
    {
        $admin_str = "*";
        $admin_where = " WHERE `id` LIKE :search";
        $admin_bind = [':search' => $this->admin_search_data];
        $arr_genders = ["men" => "`men`", "women" => "`women`", "kids" => "`kids`",];
        $this->admin_type = 1;
        foreach ($arr_genders as $index => $item) {
            $admin_table = $item;
            $this->admin_some_gender = $index;
            $data_admin = PdoM::Instance()->Select_All($admin_table, $admin_str, $admin_where, $admin_bind);
            $file = file_get_contents("data_json/data_" . $this->admin_type . ".json");  // Открыть файл data.json
            $taskList = json_decode($file, true);        // Декодировать в массив 
            if ($data_admin[0]) {
                foreach ($data_admin as $data) { //РЕНДЕР КАТАЛОГА
                    $this->get_html($taskList, $data, 0, $this->admin_some_gender, $this->admin_type);
                }
            }
            $this->admin_type++;
        }
    }


    public function render_orders()
    {
        $orders_table = "`orders`";
        $orders_str = "`id`";
        $orders_where = " WHERE `status` = :status";
        $orders_bind = [':status' => 2];

        $data_orders = PdoM::Instance()->Select_All($orders_table, $orders_str, $orders_where, $orders_bind);

        foreach ($data_orders as $item) {
            $file = file_get_contents("C:\OpenServer\domains\prof6\orders\order_" . $item['id'] . ".json");
            $taskList = json_decode($file, true);
            $sum_subtotal = 0; ?>
            <div class="box_order">
                <?php
                $this->get_html_order_user($taskList[0]); ?>
                <div class="order_box_product">
        <?php
            foreach ($taskList as $index => $item) {
                if ($index != 0) {
                    $sum_subtotal = $sum_subtotal + $item['price'] * $item['quantity'];
                    $this->get_html_order_product($item);
                }
            }
            $this->get_html_order_tail($sum_subtotal, $taskList[0]['order_id']);
        }
    }

    public function update_order()
    {
        try {
            $orders_table = "`orders`";
            $orders_arr = ["`status` = '$this->admin_order_type'"];
            $orders_where = " WHERE `id`= :order_id";
            $orders_bind = [':order_id' => $this->admin_order_id];
            $data_admin = PdoM::Instance()->Update($orders_table, $orders_arr, $orders_where, $orders_bind);
            if ($data_admin == 0000) {
                header("Location: index.php?c=admin_orders");
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }


    public function add_data()
    {
        try {
            if ($this->admin_type == 1) {
                $admin_table = "`men`";
                $this->admin_some_gender = "men";
            } elseif ($this->admin_type == 2) {
                $admin_table = "`women`";
                $this->admin_some_gender = "women";
            } elseif ($this->admin_type == 3) {
                $admin_table = "`kids`";
                $this->admin_some_gender = "kids";
            }
            if ($this->admin_new_photo_name) {
                $path = "img/" . $this->admin_some_gender . "/" . $this->admin_photo_name;
                move_uploaded_file($this->admin_new_photo_name, $path);
            }
            $admin_arr = [
                "`name` = '$this->admin_product_name'",
                "`price` = '$this->admin_price'",
                "`photo_name` = '$this->admin_photo_name'"
            ];
            $admin_where = " WHERE `id`= :product_id";
            $admin_bind = [':product_id' => $this->admin_product_id];
            $data_admin = PdoM::Instance()->Update($admin_table, $admin_arr, $admin_where, $admin_bind);
            $file = file_get_contents("data_json/data_" . $this->admin_type . ".json");
            $taskList = json_decode($file, true);
            $taskList[$this->admin_product_id] = $this->admin_text;
            file_put_contents("data_json/data_" . $this->admin_type . ".json", json_encode($taskList, JSON_UNESCAPED_UNICODE));
            if ($data_admin == 0000) {
                header("Location: index.php?c=admin_catalog&type=$this->admin_type");
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
