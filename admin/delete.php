<?php
include 'conn.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $que_id = $_GET['id'];

    try {
        $conn->beginTransaction();
        $stmt = $conn->prepare("DELETE FROM contact_query WHERE query_id=?");
        $stmt->bind_param("i", $que_id);
        $stmt->execute();
        $conn->commit();
        echo "Query deleted successfully";
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Invalid query ID";
}
?>