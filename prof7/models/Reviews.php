<?php
session_start();

abstract class Reviews_template
{
    abstract function get_content_rev();
    abstract function get_content_rev_success();
    abstract function get_content_rev_error();
    abstract function render();
    abstract function add_review();
    abstract function add_capture();
}

class Reviews extends Reviews_template
{
    public function __construct(
        $content,
        $rev_get_name,
        $rev_get_city,
        $rev_user_photo,
        $rev_path,
        $rev_text
    ) {
        $this->content = $content;
        $this->rev_get_name = $rev_get_name;
        $this->rev_get_city = $rev_get_city;
        $this->rev_user_photo = $rev_user_photo;
        $this->rev_path = $rev_path;
        $this->rev_text = $rev_text;
    }

    private function get_html($taskList, $data, $i)
    {
?>
        <div class="review_block">
            <div class="review_left">
                <img class="img_reviews" src="img/faces/<?= $data['photo_name'] ?>" alt="face">
                <p><?= $data['name'] ?></p>
                <p><?= $data['city'] ?></p>
            </div>
            <div>
                <p class="text_right"><?= $taskList[$i] . "<br>" . "<br>" ?><?= date("H:i", strtotime($data['date'])) . "<br>" ?><?= date("d.m.Y", strtotime($data['date'])) ?></p>
            </div>
        </div>
    <?php

    }

    public function get_content_rev()
    {
        $this->content = "views/reviews.php";
        return $this->content;
    }
    public function get_content_rev_success()
    {
        $this->content = "views/success_rev.php";
        return $this->content;
    }
    public function get_content_rev_error()
    {
        $this->content = "views/error_rev.php";
        return $this->content;
    }

    public function render()
    {
        $rev_table = "`reviews`";
        $rev_str = "*";
        $rev_where = NULL;
        $rev_bind = NULL;
        $data_rev = PdoM::Instance()->Select_All($rev_table, $rev_str, $rev_where, $rev_bind);
        $file = file_get_contents('data_json/data.json');  // Открыть файл data.json
        $taskList = json_decode($file, true);
        $i = 1;      // Декодировать в массив 
        foreach ($data_rev as $data) {
            $this->get_html($taskList, $data, $i);
            $i++;
        }
    }

    public function add_review()
    {
        if ($_FILES['photo_rev']['tmp_name']) {
            $extension = pathinfo($_FILES['photo_rev']['name'], PATHINFO_EXTENSION);
            $this->rev_user_photo =  uniqid() . "." . $extension;
            move_uploaded_file($_FILES['photo_rev']['tmp_name'], $this->rev_path . $this->rev_user_photo);
        }
        $rev_table = "`reviews`";
        $rev_columns = "`name`, `city`, `photo_name`";
        $rev_values = "'$this->rev_get_name', '$this->rev_get_city', '$this->rev_user_photo'";
        $data_rev = PdoM::Instance()->Insert($rev_table, $rev_columns, $rev_values);
        $file = file_get_contents('data_json/data.json');
        $text_set = json_decode($file, true);
        $text_set[] = $this->rev_text;
        file_put_contents('data_json/data.json', json_encode($text_set, JSON_UNESCAPED_UNICODE));
    }

    public function add_capture()
    {
        $x = rand(1, 10);
        $y = rand(1, 10);
        $res = $x + $y; ?>
        <input type="hidden" name="correct" value="<?= $res ?>">
        <p class="add_inp">Защита от роботов: вычислите <?= $x ?> + <?= $y ?> = <input name="answer" style="width: 20px;" type="text"></p>
<?php
    }
}
