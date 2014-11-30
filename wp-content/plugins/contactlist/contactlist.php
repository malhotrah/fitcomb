<?php
/*
Plugin Name: Contact Entries Listing
Plugin URI: #
Description: Contact Form Entries
Author: Hitanshu (hitanshumalhotra@gmail.com, +919958205181), Gagan Kumar (gagan2789@gmail.com, +919999447719)
Author URI: http://hitanshumalhotra.com && http://gagankumar.in
Version: 1.0.0
Text Domain: contactlist
License: GPLv2
*/

function contactlist_delete_file(){
    global $wpdb;
    if(isset($_GET['task']) && $_GET['task'] == 'DeleteContact' && is_admin()){
        if(is_array($_GET['id'])){
            foreach($_GET['id'] as $id){
                $qry[] = "id='".(int)$id."'";
            }
            $cond = implode(" or ", $qry);
        } else
            $cond = "id='".(int)$_GET['id']."'";

        $wpdb->query("delete from wp_contact where ". $cond);
        echo "Enteries deleted <a href='/wp-admin/admin.php?page=contact-entries'>Click Here to Go back</a> ";
        die();
    }
}

function contactlist_menu()
{
    //echo get_option('wpdm_access_level','manage_options');die();
    add_menu_page("Contact Entries Manager","Contact Entries Manager",get_option('wpdm_access_level','manage_options'),'contact-entries','contactlist_admin_options',plugins_url('contactlist/img/donwloadmanager-16.png'));
    add_submenu_page( 'contact-entries', 'Contact Entries Manager', 'Listing', get_option('wpdm_access_level','manage_options'), 'folder-manager', 'contactlist_admin_options');
}


function contactlist_admin_options(){

    if(isset($_GET['success'])&&$_GET['success']==1){
        echo "
        <div id=\"message\" class=\"updated fade\"><p>
        Congratulation! Plugin is ready to use now.
        </div>
        ";
    }
        include('contactlist-list-files.php');
}

add_action("admin_menu","contactlist_menu");

add_action("init","contactlist_delete_file");



