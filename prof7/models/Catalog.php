<?php
session_start();

abstract class Catalog_template
{
    abstract function get_content_cat();
    abstract function get_content_prd();
    abstract function get_content_search();
    abstract function render();
    abstract function render_search();
    abstract function render_low_block();
}

class Catalog extends Catalog_template
{
    public function __construct(
        $content,
        $footer,
        $cat_type,
        $cat_more_counter,
        $cat_some_gender,
        $cat_for_where,
        $cat_max_i,
        $cat_search_data

    ) {
        $this->content = $content;
        $this->footer = $footer;
        $this->cat_type = $cat_type;
        $this->cat_more_counter = $cat_more_counter;
        $this->cat_some_gender = $cat_some_gender;
        $this->cat_for_where = $cat_for_where;
        $this->cat_max_i = $cat_max_i;
        $this->cat_search_data = $cat_search_data;
    }

    private function get_html($taskList, $data, $last_final, $some_gender)
    {
?>
        <div class="product_item">
            <div class="box_pict">
                <img class="pict_img" src="img/<?= $this->cat_some_gender ?>/<?= $data['photo_name'] ?>" alt="product">
                <div class="bord_add_to_cart" onclick="addToCart(`<?= $this->cat_type ?>`, `<?= $data['id'] ?>`, `<?= $data['name'] ?>`, ``, `<?= $data['price'] ?>`, `<?= $data['photo_name'] ?>`, 1, `<?= $some_gender ?>`)">
                    <div class="add_to_cart">
                        <svg class="add_to_cart_img" width="32" height="29" viewBox="0 0 32 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="logo_svg" d="M26.2009 29C25.5532 28.9738 24.9415 28.6948 24.4972 28.2227C24.0529 27.7506 23.8114 27.1232 23.8245 26.475C23.8376 25.8269 24.1043 25.2097 24.5673 24.7559C25.0303 24.3022 25.6527 24.048 26.301 24.048C26.9493 24.048 27.5717 24.3022 28.0347 24.7559C28.4977 25.2097 28.7644 25.8269 28.7775 26.475C28.7906 27.1232 28.549 27.7506 28.1047 28.2227C27.6604 28.6948 27.0488 28.9738 26.401 29H26.2009ZM6.75293 26.32C6.75293 25.79 6.91011 25.2718 7.20459 24.8311C7.49907 24.3904 7.91764 24.0469 8.40735 23.844C8.89705 23.6412 9.43594 23.5881 9.95581 23.6915C10.4757 23.7949 10.9532 24.0502 11.328 24.425C11.7028 24.7998 11.9581 25.2773 12.0615 25.7972C12.1649 26.317 12.1118 26.8559 11.9089 27.3456C11.7061 27.8353 11.3626 28.2539 10.9219 28.5483C10.4812 28.8428 9.96304 29 9.43298 29C9.08087 29.0003 8.73212 28.9311 8.40674 28.7966C8.08136 28.662 7.78569 28.4646 7.53662 28.2158C7.28755 27.9669 7.09001 27.6713 6.9552 27.3461C6.82039 27.0208 6.75098 26.6721 6.75098 26.32H6.75293ZM10.553 20.686C10.2935 20.6868 10.0409 20.6024 9.83411 20.4457C9.62727 20.2891 9.47758 20.0689 9.40796 19.819L4.57495 2.36401H1.18201C0.868521 2.36401 0.567859 2.23947 0.346191 2.01781C0.124523 1.79614 0 1.49549 0 1.18201C0 0.868519 0.124523 0.567873 0.346191 0.346205C0.567859 0.124537 0.868521 5.81268e-06 1.18201 5.81268e-06H5.46301C5.7225 -0.00080736 5.97504 0.0837201 6.18176 0.240568C6.38848 0.397416 6.53784 0.617884 6.60693 0.868006L11.4399 18.323H24.6179L29.001 8.27501H14.401C14.2428 8.27961 14.0854 8.25242 13.9379 8.19507C13.7904 8.13771 13.6559 8.05134 13.5424 7.94108C13.4288 7.83082 13.3386 7.69891 13.277 7.55315C13.2154 7.40739 13.1836 7.25075 13.1836 7.0925C13.1836 6.93426 13.2154 6.77762 13.277 6.63186C13.3386 6.4861 13.4288 6.35419 13.5424 6.24393C13.6559 6.13367 13.7904 6.0473 13.9379 5.98994C14.0854 5.93259 14.2428 5.90541 14.401 5.91001H30.814C31.0097 5.90996 31.2022 5.95866 31.3744 6.05172C31.5465 6.14478 31.6928 6.27926 31.7999 6.44301C31.9078 6.60729 31.9734 6.79569 31.9908 6.99145C32.0083 7.18721 31.9771 7.38424 31.9 7.565L26.495 19.977C26.4026 20.1876 26.251 20.3668 26.0585 20.4927C25.866 20.6186 25.641 20.6858 25.411 20.686H10.553Z" fill="#E8E8E8" />
                        </svg>
                        <p class="add_to_cart_text">Add to Cart</p>
                    </div>
                </div>
            </div>
            <form action="index.php?c=catalog&move=product" method="POST" enctype="multipart/form-data">
                <input hidden name="number_g" type="text" value="<?= $this->cat_type ?>">
                <input hidden name="gender" type="text" value="<?= $this->cat_some_gender ?>">
                <input hidden name="id" type="text" value="<?= $data['id'] ?>">
                <input hidden name="name" type="text" value="<?= $data['name'] ?>">
                <input hidden name="price" type="text" value="<?= $data['price'] ?>">
                <input hidden name="number_g" type="text" value="<?= $this->cat_type ?>">
                <input hidden name="photo_name" type="text" value="<?= $data['photo_name'] ?>">
                <input hidden name="about" type="text" value="<?= $taskList[$data['id']] ?>">
                <input id="prd_sub_<?= $this->cat_some_gender ?>_<?= $data['id'] ?>" class="hide" type="submit">
                <label for="prd_sub_<?= $this->cat_some_gender ?>_<?= $data['id'] ?>">
                    <h3 class="pd_tittle"><?= $data['name'] ?></h3>
                    <p class="pd_text"><?= mb_substr($taskList[$data['id']], 0, 87, 'UTF-8') ?>...</p>
                    <p class="pd_price">$<?= $data['price'] ?></p>
                </label>
            </form>
            <input class="uniq_input" value="<?= $last_final ?>" hidden>
        </div>
    <?php
    }

    public function get_content_cat()
    {
        if ($this->cat_type == 1) {
            $this->cat_some_gender = "men";
        } elseif ($this->cat_type == 2) {
            $this->cat_some_gender = "women";
        } elseif ($this->cat_type == 3) {
            $this->cat_some_gender = "kids";
        }
        $this->content = "views/catalog.php";
        $this->footer = "views/footer.php";
        return ['content' => $this->content, 'footer' => $this->footer, 'gender' => $this->cat_some_gender];
    }
    public function get_content_prd()
    {
        $this->content = "views/product.php";
        return $this->content;
    }
    public function get_content_search()
    {
        $this->content = "views/search.php";
        return $this->content;
    }


    public function render()
    {
        $down = $this->cat_more_counter;
        if (empty($this->cat_more_counter)) {
            $down = 0;
        }
        $up = $down + 10;
        $cat_str = "*";
        $cat_where = " WHERE `id` > :down AND `id` < :up";
        $cat_bind = [':down' => $down, ':up' => $up];
        $max_cat_str = "MAX(`id`)";
        $max_cat_where = NULL;
        $max_cat_bind = NULL;
        if ($this->cat_type == 1) {
            $cat_table = "`men`";
            $this->cat_some_gender = "men";
        } elseif ($this->cat_type == 2) {
            $cat_table = "`women`";
            $this->cat_some_gender = "women";
        } elseif ($this->cat_type == 3) {
            $cat_table = "`kids`";
            $this->cat_some_gender = "kids";
        }
        $data_cat = PdoM::Instance()->Select_All($cat_table, $cat_str, $cat_where, $cat_bind);
        $data_max_id = PdoM::Instance()->Select($cat_table, $max_cat_str, $max_cat_where, $max_cat_bind);
        foreach ($data_max_id as $item) {
            $last_final = $item;
        }

        $file = file_get_contents("data_json/data_" . $this->cat_type . ".json");  // Открыть файл data.json
        $taskList = json_decode($file, true);        // Декодировать в массив 
        if ($data_cat[0]) {
            foreach ($data_cat as $data) { //РЕНДЕР КАТАЛОГА
                $this->get_html($taskList, $data, $last_final, $this->cat_some_gender);
            }
        }
    }
    public function render_search()
    {
        $cat_str = "*";
        $cat_where = " WHERE `name` LIKE :search";
        $cat_bind = [':search' => '%' . $this->cat_search_data . '%'];
        $arr_genders = ["men" => "`men`", "women" => "`women`", "kids" => "`kids`",];
        $this->cat_type = 1;
        foreach ($arr_genders as $index => $item) {
            $cat_table = $item;
            $this->cat_some_gender = $index;
            $data_cat = PdoM::Instance()->Select_All($cat_table, $cat_str, $cat_where, $cat_bind);
            $file = file_get_contents("data_json/data_" . $this->cat_type . ".json");  // Открыть файл data.json
            $taskList = json_decode($file, true);        // Декодировать в массив 
            if ($data_cat[0]) {
                foreach ($data_cat as $data) { //РЕНДЕР КАТАЛОГА
                    $this->get_html($taskList, $data, 0, $this->cat_some_gender);
                }
            }
            $this->cat_type++;
        }
    }
    public function render_low_block()
    {
        $this->cat_type = rand(1, 3);
        $cat_str = "*";
        $cat_where = " WHERE `id` IN ($this->cat_for_where)";
        $max_cat_str = "MAX(`id`)";
        $max_cat_where = NULL;
        $max_cat_bind = NULL;
        if ($this->cat_type == 1) {
            $cat_table = "`men`";
            $this->cat_some_gender = "men";
        } elseif ($this->cat_type == 2) {
            $cat_table = "`women`";
            $this->cat_some_gender = "women";
        } elseif ($this->cat_type == 3) {
            $cat_table = "`kids`";
            $this->cat_some_gender = "kids";
        }
        $data_max_id = PdoM::Instance()->Select($cat_table, $max_cat_str, $max_cat_where, $max_cat_bind);
        foreach ($data_max_id as $item) {
            $last_final = $item;
        }
        $arr_r = [];
        for ($i = 1; $i < $this->cat_max_i; $i++) {
            $r = rand(1, $last_final);
            $ch = 0;
            if (count($arr_r) != 0) {
                foreach ($arr_r as $item) {
                    if ($item == $r) {
                        $ch = 1;
                    }
                }
                if ($ch == 0) {
                    $arr_r[":r" . $i] = $r;
                } else $i--;
            } else {
                $arr_r[":r" . $i] = $r;
            }
        }

        $cat_bind = $arr_r;
        $data_cat = PdoM::Instance()->Select_All($cat_table, $cat_str, $cat_where, $cat_bind);
        $file = file_get_contents("data_json/data_" . $this->cat_type . ".json");  // Открыть файл data.json
        $taskList = json_decode($file, true);        // Декодировать в массив 
        if ($data_cat[0]) {
            foreach ($data_cat as $data) { //РЕНДЕР КАТАЛОГА
                $this->get_html($taskList, $data, $last_final, $this->cat_some_gender);
            }
        } ///↓↓↓ ОДИНОКИЙ </div> - ЭТО ЗАКРЫВАЕМ <div class="wrap_product"> из верстки
    ?>
        </div>
        <div class="box_btn">
            <a class="btn" href="index.php?c=catalog&type=<?= $this->cat_type ?>">Browse All Product</a>
        </div>
<?php
    }
}
