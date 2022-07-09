<?php
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"], 1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if (isset($_POST['delete-product-btn'])) {
    if (!isset($_POST['delete-checkbox'])) {
        echo 'please select the checkboxes';
    } else {
        $all_id = $_POST['delete-checkbox'];
        $seperate_all_id = implode(",", $all_id);
        $query = "DELETE FROM product_tables WHERE product_form_id IN($seperate_all_id)";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            header("Location: index.php");
        } else {
            echo "something went wrong";
        };
    }
}
