    <nav>
        <div class="main_tittle_box">
            <div class="main_tittle">
                <h3 class="pink_tittle">NEW ARRIVALS </h3>
                <div class="way">
                    <a class="way_text" href="index.php">HOME&nbsp;</a>
                    <a class="way_text" href="index.php?c=catalog&type=<?= $config_type ?>"><?= $config_some_gender ?>&nbsp;</a>
                    <a class="way_text" href="index.php?c=catalog&type=<?= $config_type ?>">NEW ARRIVALS</a>
                </div>
            </div>
        </div>
        <div class="product_menu">

        </div>
    </nav>
    <div id="box_for_goods" class="wrap_product">
        <?php
        if ($_GET['c'] == 'catalog') {
            $catalog->render();
        }
        ?>
    </div>
    <form id="more_goods" class='box_btn'>
        <input type="text" id="more_goods_input" name="more_goods" value="9" hidden>
        <input type="text" name="type" value="<?= $config_type ?>" hidden>
        <input type="submit" id="more_goods_submit" hidden>
        <label for="more_goods_submit" class='btn'>More goods</label>
    </form>
    <a href="#" class='box_btn logo_right_img'>
        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve">
            <g>
                <g id="_x35__25_">
                    <g>
                        <path class="logo_svg" d="M535.5,0h-459C34.253,0,0,34.253,0,76.5v459C0,577.747,34.253,612,76.5,612h459c42.247,0,76.5-34.253,76.5-76.5v-459
				C612,34.253,577.747,0,535.5,0z M491.856,414.726c-7.516,7.555-19.698,7.555-27.215,0l-158.335-158.91L147.97,414.726
				c-7.516,7.555-19.699,7.555-27.196,0c-7.516-7.555-7.516-19.775,0-27.33l170.978-171.589c3.997-4.017,9.314-5.738,14.573-5.47
				c5.24-0.268,10.557,1.453,14.573,5.47l170.978,171.589C499.354,394.95,499.354,407.171,491.856,414.726z" fill="#E8E8E8" />
                    </g>
                </g>
            </g>
        </svg>
    </a>