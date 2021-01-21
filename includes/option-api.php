<?php
    // Hàm add_option               Tạo
        // add_option('logo', 'http://localhost/wordpress/wp-content/uploads/2016/12/favico.png');
    // Hàm get_option               Lấy
        // echo get_option('logo');
    // Hàm delete_option            Xoá
        // delete_option('logo');
    // Hàm update_option            Sửa
        // update_option('logo', 'TIEPNGUYEN');


    // Hàm bổ sung menu con vào một menu cha
    function add_submenu_options() {
        add_submenu_page(
            'themes.php', // Menu cha
            'Theme Options', // Tiêu đề của menu
            'Theme Options', // Tên của menu
            'manage_options',// Vùng truy cập, giá trị này có ý nghĩa chỉ có supper admin và admin đc dùng
            'theme-options', // Slug của menu
            'access_menu_options' // Hàm callback hiển thị nội dung của menu
        );
    }
    // Hàm xử lý Form
    function access_menu_options() { 
        if (!empty($_POST['save-theme-option'])) {

            $logo = $_POST['logo'];
            $osdm = $_POST['osdm'];

            // Cập nhật (nếu chưa có thì hệ thống tự thêm mới)
            update_option('logo', $logo);
            update_option('theme_option_danh_muc', $osdm);
        }
        // Lấy thông tin trong bảng Options (để code này sau phần update vì nó load sau, sẽ thấy được luôn kq trong Form)
        $logo = get_option('logo');
        $osdm = get_option('theme_option_danh_muc');

        require('template/theme-option.php');
    }
    // Thêm hành động hiển thị menu con vào Action admin_menu Hooks
    add_action('admin_menu', 'add_submenu_options');
?>