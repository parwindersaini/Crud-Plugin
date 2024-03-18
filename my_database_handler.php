<?php
class MyDatabaseHandler {
    private $table_name;
    private $db;

    public function __construct($table_name) {
        global $wpdb;
        $this->table_name = $wpdb->prefix . $table_name;
        $this->db = $wpdb;
    }

    public function create_table() {
        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name (
            id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
            student_name VARCHAR(255) NOT NULL,
            class VARCHAR(50) NOT NULL,
            roll_no INT NOT NULL,
            PRIMARY KEY (id)
        )";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function insert_data($data) {
        $this->db->insert($this->table_name, $data);
    }

    public function update_data($data, $where) {
        $this->db->update($this->table_name, $data, $where);
    }

    public function delete_data($where) {
        $this->db->delete($this->table_name, $where);
    }

    public function fetch_data($where = '', $orderby = '', $limit = '') {
        $query = "SELECT * FROM $this->table_name";

        if (!empty($where)) {
            $query .= " WHERE $where";
        }

        if (!empty($orderby)) {
            $query .= " ORDER BY $orderby";
        }

        if (!empty($limit)) {
            $query .= " LIMIT $limit";
        }

        return $this->db->get_results($query, ARRAY_A);
    }
}
