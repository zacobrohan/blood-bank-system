<?php
include 'conn.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $que_id = $_GET['id'];

    $sql = "DELETE FROM contact_query WHERE query_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $que_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Query deleted successfully";
    } else {
        echo "Error deleting query";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid query ID";
}
?>