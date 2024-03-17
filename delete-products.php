<?php

require('./mysqli_connect.php');
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $select_stmt = mysqli_stmt_init($dbcon);
    $select_query = "SELECT * FROM categories WHERE id = ?";
    mysqli_stmt_prepare($select_stmt, $select_query);
    mysqli_stmt_bind_param($select_stmt, 'i', $id);
    mysqli_stmt_execute($select_stmt);

    $result = mysqli_stmt_get_result($select_stmt);

    $row = mysqli_fetch_assoc($result);

    // Assuming the file path is stored in the 'product_image' column
    $filePath = $row['product_image'];

    // Define the base directory where the file is stored
    $baseDir = 'Uploads\\';

    // Construct the full file path
    $fullFilePath = $baseDir . $filePath;

    // Check if the file exists before attempting to delete it
    if (file_exists($fullFilePath)) {
        // Attempt to delete the file
        if (unlink($fullFilePath)) {
            // File deleted successfully, now delete the record from the database
            $delete_product_stmt = mysqli_stmt_init($dbcon);
            $delete_product_query = "DELETE FROM categories WHERE id = ?";
            mysqli_stmt_prepare($delete_product_stmt, $delete_product_query);
            mysqli_stmt_bind_param($delete_product_stmt, 'i', $id);
            $result = mysqli_stmt_execute($delete_product_stmt);

            if ($result) {
                echo "<script>
                alert('Deleted sucefully');
                window.location.href = 'add-products.php';
                
                </script>";
            } else {
                echo "Failed to delete record from database.";
            }
        } else {
            echo "Failed to delete file.";
        }
    } else {
        echo "File does not exist.";
    }
}
