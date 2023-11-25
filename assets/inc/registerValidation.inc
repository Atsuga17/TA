<?php
    //validate
    function validate(&$errors, $field_list, $field_name, $pattern, $errMsg) {
        $check = array("email", "username");
        if (!db_check($field_list, $field_name) && in_array($field_name, $check)) {
            $errors[$field_name] = "*$field_name sudah terdaftar";
            return false;
        }
        if (!isset($field_list[$field_name]) || empty(trim($field_list[$field_name]))) {
            $errors[$field_name] = "*$field_name tidak boleh kosong";
            return false;
        } elseif (!preg_match($pattern, $field_list[$field_name])) {
            $errors[$field_name] = "*$errMsg";
            return false;
        } else {
            return true;
        }
    }

    //reset, prevent clear
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
    function validornot(&$errors, $post) {
        $pattern = array('username' => "/^[a-zA-Z0-9]{6,}+$/",'email' => "/^(([^\<\>()\[\]\\.,;:\s@\"]+(\.[^\<\>()\[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/", 'nama' => "/^[a-zA-Z\s]{3,55}+$/", 'telepon' => "/^(0)([0-9]{10,14})+$/", 'alamat' => "/^[a-zA-Z0-9\s\.,]+$/", 'password' => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/");
        $msg = array('username' => "username minimal terdiri dari 6 karakter kombinasi huruf & angka",'email' => "email tidak valid", 'nama' => "nama tidak valid", 'telepon' => "nomor telepon tidak valid", 'alamat' => "", 'password' => "password terdiri dari setidaknya 8 karakter, memiliki minimal 1 huruf kapital, huruf kecil, angka, & karakter spesial (!@#$%^&*)");
        foreach ($post as $key => $value) {
            if (isset($pattern[$key])) {
                if (isset($post[$key])) {
                    validate($errors, $post, $key, $pattern[$key], $msg[$key]);
                } else {
                    include $inc;
                }
            } elseif ($key == 'password2') {
                if ($post[$key] != $post['password']) {
                    $errors[$key] = "*password tidak cocok";
                }
            } elseif ($key == 'old') {
                if (isset($_SESSION['admin'])) {
                    $table = 'admin';
                } elseif (isset($_SESSION['manager'])) {
                    $table = 'manager';
                } else {
                    $table = 'user';
                }
                $id = $_SESSION['id'];
                if (!isset($post[$key]) || empty(trim($post[$key]))) {
                    $errors[$key] = "*password tidak boleh kosong";
                } else {
                    if (edit_check($post, $table, $id)) {
                        $errors[$key] = "*password salah";
                    }
                }
            }
        }
    }
?>




















































































































































































































































































































