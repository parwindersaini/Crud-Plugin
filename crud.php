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

// Step 2: Callback function to display the admin page and form
function student_form_page() {   
  require_once plugin_dir_path( __FILE__ ) . 'student-listing.php';    
  // require_once plugin_dir_path( __FILE__ ) . 'student_form.html';  
}

