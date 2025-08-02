<?php
// index.php
$conn = new mysqli("localhost", "root", "", "robot_arm");
$poses = [];
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
$res = $conn->query("SELECT * FROM poses ORDER BY id ASC");
while ($row = $res->fetch_assoc()) $poses[] = $row;
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Robot Arm Control Panel</title>
<style>
body { font-family: Arial, sans-serif; background: #f7f7f7; }
.panel { background: #fff; padding: 30px; margin: 40px auto 0; border-radius: 6px; width: 680px; box-shadow: 0 0 20px #ccc; }
h2 { margin-top: 0; }
.slider-row { display: flex; align-items: center; margin-bottom: 10px; }
.slider-row label { width: 70px; }
.slider-row input[type=range] { flex: 1; margin: 0 10px; }
.slider-row span { width: 30px; text-align: right; }
button { margin-right: 6px; }
table { width: 100%; border-collapse: collapse; margin-top: 30px; background: #fff; }
th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
th { background: #f0f0f0; }
</style>
</head>
<body>
<div class="panel">
    <h2>Robot Arm Control Panel</h2>
    <form id="armForm">
        <?php for($i=1; $i<=6; $i++): ?>
        <div class="slider-row">
            <label>Motor <?= $i ?>:</label>
            <input type="range" min="0" max="180" value="90" id="motor<?= $i ?>" name="motor<?= $i ?>">
            <span id="val<?= $i ?>">90</span>
        </div>
        <?php endfor; ?>
        <button type="button" onclick="resetSliders()">Reset</button>
        <button type="button" onclick="savePose()">Save Pose</button>
        <button type="button" onclick="runPose()">Run</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <?php for($i=1; $i<=6; $i++): ?>
                <th>Motor <?= $i ?></th>
                <?php endfor; ?>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="poseTable">
            <?php foreach($poses as $row): ?>
            <tr data-id="<?= $row['id'] ?>">
                <td><?= $row['id'] ?></td>
                <?php for($i=1; $i<=6; $i++): ?>
                <td><?= $row['motor'.$i] ?></td>
                <?php endfor; ?>
                <td>
                    <button type="button" onclick="loadPose(<?= $row['id'] ?>)">Load</button>
                    <button type="button" onclick="removePose(<?= $row['id'] ?>)">Remove</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
for(let i=1;i<=6;i++){
    let slider = document.getElementById("motor"+i);
    let val = document.getElementById("val"+i);
    slider.oninput = ()=>{ val.textContent = slider.value; }
}
function resetSliders(){
    for(let i=1;i<=6;i++){
        let slider = document.getElementById("motor"+i);
        slider.value = 90;
        document.getElementById("val"+i).textContent = 90;
    }
}
function savePose(){
    let data = {};
    for(let i=1;i<=6;i++) data['motor'+i] = document.getElementById("motor"+i).value;
    fetch('save_pose.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(data)})
    .then(r=>r.json()).then(r=>{if(r.success)location.reload();});
}
function loadPose(id){
    fetch('get_run_pose.php?id='+id)
    .then(r=>r.json()).then(pose=>{
        for(let i=1;i<=6;i++){
            document.getElementById("motor"+i).value = pose['motor'+i];
            document.getElementById("val"+i).textContent = pose['motor'+i];
        }
    });
}
function removePose(id){
    if(!confirm("Remove pose?"))return;
    fetch('remove_pose.php?id='+id).then(()=>location.reload());
}
function runPose(){
    let data = {};
    for(let i=1;i<=6;i++) data['motor'+i] = document.getElementById("motor"+i).value;
    fetch('run_pose.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify(data)})
    .then(()=>alert("Robot arm is running!"));
}
</script>
</body>
</html>