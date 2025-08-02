<?php
$id = intval($_GET['id']);
$conn = new mysqli("localhost","root","","robot_arm");
$conn->query("DELETE FROM poses WHERE id=$id");
echo "OK";