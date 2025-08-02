<?php
$id = intval($_GET['id']);
$conn = new mysqli("localhost","root","","robot_arm");
$res = $conn->query("SELECT * FROM poses WHERE id=$id");
echo json_encode($res->fetch_assoc());