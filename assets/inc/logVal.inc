<?php
    //prevent clear
    function valinp(&$data, $val) {
        if (isset($data[$val])) {
            echo trim($data[$val]);
        }
    }

    //display err msg
    function errMsg($data, $post, $val) {
        if (isset($data[$val])) {
            echo $data[$val];
        }
    }
    
    //all valid ?
    function validornot($post, &$errors, $inc) {
        foreach ($post as $key => $value) {
            if ($key != 'kunci') {
                if (!isset($post[$key]) || empty(trim($post[$key]))) {
                    $errors[$key] = "*$key tidak boleh kosong";
                }
            } else {
                $kunci = array('Manager_99', 'Admin_99');
                if (!empty(trim($post[$key]))) {
                    if (!in_array($post[$key], $kunci)) {
                        $errors[$key] = "*$key salah";
                    }
                }
            }
        }
        if (db_check($post, 'id')) {
            if (!empty(trim($post['id']))) {
                $errors['id'] = "*id belum terdaftar";
            }
        } else {
            if (!check($post)) {
                $errors['password'] = "*password salah";
            }
        }
        if ($errors) {
            include $inc;
        } else {
            session_start();
            $_SESSION['id'] = $post['id'];
            if ($post['kunci'] == "") {
                $_SESSION['user'] = true;
                header("location: user/index.php");
            } else {
                if ($post['kunci'] == 'Admin_99') {
                    $_SESSION['admin'] = true;
                    header("location: admin/administrator/index.php");
                } else {
                    $_SESSION['manager'] = true;
                    header("location: admin/manager/index.php");
                }
            }
            exit();
        }
    }
?>