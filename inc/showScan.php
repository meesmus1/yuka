<?php
include './dbh.php';
$response = array();
$html = "";

// Fetch data from the database
$sql = "SELECT * FROM `save` ORDER BY `createdAt`";
$statement = $conn->prepare($sql);
$statement->execute();
$results = $statement->get_result();

while ($row = $results->fetch_assoc()) {
    // Modal trigger button
    $html .= '<button class="" id="historybutton" data-bs-toggle="modal" data-bs-target="#modal-' . $row["id"] . '">' . $row['name'] . '</button>';

    // Modal structure
    $html .= '<div class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal-' . $row["id"] . '">
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            <h4 class="modal-title">' . $row["name"] . '</h4>
        </div>
        <div class="modal-body">
            <img src="' . $row["image"] . '" alt="Product Image" style="width: 100px; height: auto; margin: 10px auto;">
            <p>Nutri-Score: ' . strtoupper($row["nutriScore"]) . '</p>
            <p>Energy: ' . $row["energy"] . ' kcal</p>
            <p>Protein: ' . $row["protein"] . 'g</p>
            <p>Fiber: ' . $row["fiber"] . 'g</p>
            <p>Sugar: <span class="sugar-level ' . $row["sugarLevelClass"] . '">' . $row["sugar"] . 'g</span></p>
            <p>Saturated Fat: ' . $row["fat"] . 'g</p>
            <p>Salt: ' . $row["salt"] . 'g</p>
            <p>Negatives: ' . $row["negatives"] . '</p>
            <p>Score: ' . $row["score"] . '/100</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
  </div>
</div>';
}

// Return the generated HTML
echo json_encode($html);
