<article>
    <div class="main_tittle_box">
        <div class="main_tittle_mini">
            <h3 class="pink_tittle">orders</h3>
        </div>
    </div>
</article>

<div class="reg_wrap">
    <div class="reviews_box">
        <?php
        if ($_GET['c'] == 'admin_orders') {
            $content = $admin->render_orders();
        }
        ?>
    </div>
</div>