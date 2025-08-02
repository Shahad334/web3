<?php
// Simulate running the pose (in real scenario, you would send the pose to hardware)
$data = json_decode(file_get_contents("php://input"), true);
// You might want to set status=1 for the run pose, or log it
echo "RUN";