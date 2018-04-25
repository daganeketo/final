<?php
require_once("config.php");
// Create connection
$conn = new mysqli(SERVER,USER,PASSWORD,DATABASE);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM PLogs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo "<td>" . $row["LoopOrder"] . "</td> <td>" . $row["Size"] . "</td> <td>" . $row["ElapsedTime"] . "</td>";
        echo '</tr>';
    }
} else {
    echo "";
}

$conn->close();
?>