<?php
$id = intval($_POST['id']);
$conn = new mysqli("localhost","root","","robot_arm");
$conn->query("UPDATE poses SET status=0 WHERE id=$id");
echo "OK";