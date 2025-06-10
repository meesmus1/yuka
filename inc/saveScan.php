<?php

include './dbh.php';
$response = array();

$name = $_POST['name'];
$image = $_POST['image'];
$nutriScore = $_POST['nutriScore'];
$energy = $_POST['energy'];
$protein = $_POST['protein'];
$fiber = $_POST['fiber'];
$sugarLevelClass = $_POST['sugarLevelClass'];
$sugar = $_POST['sugar'];
$fat = $_POST['fat'];
$salt = $_POST['salt'];
$negatives = $_POST['negatives'];
$score = $_POST['score'];
$userId = $_POST['userId'];

// Checken of het item al bestaat
$checkSql = "SELECT * FROM `save` WHERE `name` = ? AND `userId` = ?";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("ss", $name, $userId);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result->num_rows > 0) {
    // Item bestaat, dus updaten
    $updateSql = "UPDATE `save` SET `image` = ?, `nutriScore` = ?, `energy` = ?, `protein` = ?, `fiber` = ?, `sugarLevelClass` = ?, `sugar` = ?, `fat` = ?, `salt` = ?, `negatives` = ?, `score` = ? WHERE `name` = ? AND `userId` = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssssssssssss", $image, $nutriScore, $energy, $protein, $fiber, $sugarLevelClass, $sugar, $fat, $salt, $negatives, $score, $name, $userId);
   
} else {
    // Item bestaat nog niet, dus invoegen
    $id = generate_uuid_v4();
    $insertSql = "INSERT INTO `save`(`id`, `name`, `image`, `nutriScore`, `energy`, `protein`, `fiber`, `sugarLevelClass`, `sugar`, `fat`, `salt`, `negatives`, `score`, `userId`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $insertStmt = $conn->prepare($insertSql);
    $insertStmt->bind_param('ssssssssssssss', $id, $name, $image, $nutriScore, $energy, $protein, $fiber, $sugarLevelClass, $sugar, $fat, $salt, $negatives, $score, $userId);
   
}

echo json_encode($response);

?>
