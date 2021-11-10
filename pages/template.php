<div class="container" style="padding-top: 88px;">
    <div class="container mb-3" id="container">
        <?php
            $assignment = array();
            if ($stmt = $conn->prepare("SELECT * FROM `assignment` ORDER BY `id` DESC")) {
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($assignment, array($row['id']=>array(
                            "name"=>$row['name'],
                            "assigner"=>$row['assigner'],
                            "assignee"=>json_decode($row['assignee'], true),
                            "problem"=>json_decode($row['problem'], true),
                            "properties"=>json_decode($row['properties'], true)
                        )));
                    }
                }
            }
        ?>
    </div>
</div>
