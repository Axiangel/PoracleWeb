<?php
$conn2 = new mysqli($dbhost2 . ":" . $dbport2, $dbuser2, $dbpass2, $dbname2);
$conn2->set_charset("utf8");

// Use prepared statements to prevent SQL injection
$sql2 = "CALL user_curr_end(?)";
$stmt = $conn2->prepare($sql2);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result2 = $stmt->get_result();

$custom_profile_msg = ""; // Initialize the variable
while ($row2 = $result2->fetch_assoc()) {
    $custom_profile_msg = $row2['ends'];
}

$stmt->close(); // Close the prepared statement
$conn2->close(); // Close the database connection
?>
