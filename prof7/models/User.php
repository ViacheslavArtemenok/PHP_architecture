<?php


abstract class User_template
{
    abstract function authorization();
    abstract function registration();
    abstract function update();
    abstract function exit();
    abstract function get_vars();
    abstract function get_footer();
}

class User extends User_template
{
    public function __construct(
        $reg_way,
        $reg_way_text,
        $content,
        $footer,
        $mega_title,
        $salt1,
        $salt2,
        $connect,
        $auth_login,
        $auth_pass,
        $get_first_name,
        $get_second_name,
        $get_age,
        $get_phone,
        $get_gend,
        $get_email,
        $get_passw,
        $path,
        $show_user_photo,
        $controller_name,
        $action,
        $login_selector
    ) {
        $this->reg_way = $reg_way;
        $this->reg_way_text = $reg_way_text;
        $this->content = $content;
        $this->footer = $footer;
        $this->mega_title = $mega_title;
        $this->salt1 = $salt1;
        $this->salt2 = $salt2;
        $this->connect = $connect;
        $this->auth_login = $auth_login;
        $this->auth_pass = $auth_pass;
        $this->get_first_name = $get_first_name;
        $this->get_second_name = $get_second_name;
        $this->get_age = $get_age;
        $this->get_phone = $get_phone;
        $this->get_gend = $get_gend;
        $this->get_email = $get_email;
        $this->get_passw = $get_passw;
        $this->path = $path;
        $this->show_user_photo = $show_user_photo;
        $this->controller_name = $controller_name;
        $this->action = $action;
        $this->login_selector = $login_selector;
    }

    public function authorization()
    {
        $get_check_pass = $this->salt1 . md5($this->auth_pass) . $this->salt2;
        $auth_table = "`users`";
        $auth_str = "`id`, `first_name`, `second_name`, `age`, `phone`, `gend`, `email`, `user_photo`";
        $auth_where = " WHERE `email`= :login AND `passw`= :passw";
        $auth_bind = [':login' => $this->auth_login, ':passw' => $get_check_pass];
        $data_auth = PdoM::Instance()->Select($auth_table, $auth_str, $auth_where, $auth_bind);
        if (!empty($data_auth)) {
            foreach ($data_auth as $index => $item) {
                $_SESSION["arr_login"]["$index"] = $item;
            }
            header("Location: index.php?c=$this->controller_name&action=4");
        } else {
            header("Location: index.php?c=$this->controller_name&action=8");
        }
    }
    public function registration()
    {
        if ($_FILES['photo_user']['tmp_name']) {
            $extension = pathinfo($_FILES['photo_user']['name'], PATHINFO_EXTENSION);
            $this->show_user_photo =  uniqid() . "." . $extension;
            move_uploaded_file($_FILES['photo_user']['tmp_name'], $this->path . $this->show_user_photo);
        } else $this->show_user_photo = "test.jpg";
        $get_password = $this->salt1 . md5($this->get_passw) . $this->salt2;
        $reg_table = "`users`";
        $reg_columns = "`first_name`, `second_name`, `age`, `phone`, `gend`, `email`, `passw`, `user_photo`";
        $reg_values = "'$this->get_first_name', '$this->get_second_name', '$this->get_age', '$this->get_phone', '$this->get_gend', '$this->get_email', '$get_password', '$this->show_user_photo'";
        $data_reg = PdoM::Instance()->Insert($reg_table, $reg_columns, $reg_values);
        if ($data_reg == 0000) {
            header("Location: index.php?c=$this->controller_name&action=3");
        } else header("Location: index.php?c=$this->controller_name&action=6");
    }
    public function update()
    {
        try {
            if ($_FILES['photo_user']['tmp_name']) {
                $extension = pathinfo($_FILES['photo_user']['name'], PATHINFO_EXTENSION);
                $this->show_user_photo =  uniqid() . "." . $extension;
                move_uploaded_file($_FILES['photo_user']['tmp_name'], $this->path . $this->show_user_photo);
            }
            $get_password = $this->salt1 . md5($this->get_passw) . $this->salt2;
            $upd_table = "`users`";
            $upd_arr = [
                "`first_name` = '$this->get_first_name'",
                "`second_name` = '$this->get_second_name'",
                "`age` = '$this->get_age'",
                "`phone` = '$this->get_phone'",
                "`gend` = '$this->get_gend'",
                "`passw` = '$get_password'",
                "`user_photo` = '$this->show_user_photo'"
            ];
            $upd_where = " WHERE `email`= :login_upd";
            $upd_bind = [':login_upd' => $this->get_email];
            $data_upd = PdoM::Instance()->Update($upd_table, $upd_arr, $upd_where, $upd_bind);
            if ($data_upd == 0000) {
                header("Location: index.php?c=$this->controller_name&action=5");
            } else header("Location: index.php?c=$this->controller_name&action=7");
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public function exit()
    {
        session_destroy();
        header("Location: index.php?c=$this->controller_name&action=1");
    }
    public function get_vars()
    {
        if ($this->login_selector) {
            $this->reg_way = 4;
            $this->reg_way_text = 'Login';
        }

        switch ($this->action) {
            case 1:
                $this->content = "views/authorization.php";
                $this->mega_title = "Authorization";
                break;
            case 2:
                $this->content = "views/registration.php";
                $this->mega_title = "Registration";
                break;
            case 3:
                $this->content = "views/authorization.php";
                $this->mega_title = "Registration is successful!!!";
                break;
            case 4:
                $this->content = "views/login.php";
                $this->mega_title = "Account";
                break;
            case 5:
                $this->content = "views/authorization.php";
                $this->mega_title = "Update data is successful!!!";
                break;
            case 6:
                $this->content = "views/authorization.php";
                $this->mega_title = "Registration error";
                break;
            case 7:
                $this->content = "views/authorization.php";
                $this->mega_title = 'Update data error';
                break;
            case 8:
                $this->content = "views/authorization.php";
                $this->mega_title = 'Authorization error (check your login or password)';
                break;
        }
        return ['reg_way' => $this->reg_way, 'reg_way_text' => $this->reg_way_text, 'content' => $this->content, 'mega_title' => $this->mega_title];
    }
    public function get_footer()
    {
        $this->footer = 'views/footer.php';
        return $this->footer;
    }
}
