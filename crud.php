<?php
/*
Plugin Name: Crud Plugin
Description: A WordPress plugin for CRUD operations on a custom table.
Version: 1.0
Author: Parwinder Singh
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}



// Plugin Activation Hook
register_activation_hook( __FILE__, 'create_table' );

function create_table() {
    global $wpdb;    
    // Define table name
    $table_name = $wpdb->prefix . 'student';    
    // SQL to create table
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
        student_name VARCHAR(50) NOT NULL,
        student_email VARCHAR(50) NOT NULL,
        class VARCHAR(50) NOT NULL,
        roll_no INT NOT NULL, 
        PRIMARY KEY (id)
    )";
    
    // Include upgrade.php for dbDelta()
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );    
    // Create table
    dbDelta( $sql );
}
// Plugin Deactivation Hook
register_deactivation_hook( __FILE__, 'delete_table' );

function delete_table() {
    global $wpdb;
    
    // Define table name
    $table_name = $wpdb->prefix . 'student';
    
    // SQL to drop table
    $sql = "DROP TABLE IF EXISTS $table_name";
    
    // Execute SQL
    $wpdb->query( $sql );
}


// Step 1: Add an Admin Menu Page
function student_form_menu() {
    add_menu_page(
        'Student Form',
        'Student Form',
        'manage_options',
        'custom-admin-form',
        'student_form_page'
    );
}
add_action('admin_menu', 'student_form_menu');

function custom_admin_form_enqueue_scripts($hook) {
    if ($hook != 'toplevel_page_custom-admin-form') {
        return;
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-admin-ajax-script', plugin_dir_url(__FILE__) . 'js/custom-admin-ajax-script.js', array('jquery'), '1.0', true);
    wp_localize_script('custom-admin-ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'custom_admin_form_enqueue_scripts');

require_once plugin_dir_path( __FILE__ ) . 'my_database_handler.php';



function student_form_page() {  
    $database_handler = new MyDatabaseHandler('student');
    $students = $database_handler->fetch_data(); 
  require_once plugin_dir_path( __FILE__ ) . 'student-listing.php';    
 //  require_once plugin_dir_path( __FILE__ ) . 'student_form.html';  
}


function handle_custom_admin_form_submission() {
    require_once plugin_dir_path( __FILE__ ) . 'my_database_handler.php';
    $database_handler = new MyDatabaseHandler('student');
    if (isset($_POST['data'])) {
            if($_POST['data']['id']){
                    $where = array( 'id' => $_POST['data']['id'] );
                    $database_handler->delete_data($where);
            $response = array(
                'success' => true, 
                'message' => 'Student data deleted successfully' // Optional message
            );
            }   
         parse_str($_POST['data'], $formData);
        if($formData){
            if(!empty($formData['id'])){

                        $where = array(
                            'id' => $formData['id'] 
                        );
                        $database_handler->update_data($formData,$where);                 
                        $response = array(
                            'success' => true, 
                            'message' => 'Student data Updated successfully' // Optional message
                        );
                    }else{  
                        
                        $database_handler->insert_data($formData);
                        $response = array(
                            'success' => true, 
                            'message' => $formData // Optional message
                        );
                    }

            }
        
    wp_send_json($response);
    }
}
add_action('wp_ajax_custom_admin_form_submit', 'handle_custom_admin_form_submission');


