<?php needAdmin(); ?>
<div class="container mb-3" style="padding-top: 88px;" id="container">
    <h1 class="display-4 font-weight-bold text-center text-coekku">User</h1>
    <div class="table-responsive">
        <table class="table table-sm table-striped w-100 d-block d-md-table" id="problemTable">
            <thead>
                <tr class="text-nowrap">
                    <th scope="col" class="font-weight-bold text-coekku text-right">#</th>
                    <th scope="col" class="font-weight-bold text-coekku">Student ID</th>
                    <th scope="col" class="font-weight-bold text-coekku">Name</th>
                    <th scope="col" class="font-weight-bold text-coekku">Email</th>
                    <th scope="col" class="font-weight-bold text-coekku">Semester</th>
                </tr>
            </thead>
            <tbody class="text-nowrap">
                <?php
                $userID = isLogin() ? $_SESSION['user']->getID() : 0;
                $admin = isAdmin();
                if ($stmt = $conn -> prepare("SELECT * FROM `user` ORDER BY id")) {
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id']; $name = $row['name']; $std_id = $row['std_id']; $email = $row['email']; $sems = $row['sems']; $year = $row['year'];
                            $prop = json_decode($row['properties'], true);
                            if ($prop == null) $prop = array();
                            $rainbow = array_key_exists("rainbow", $prop) ? $prop["rainbow"] : false;
                            $admin = array_key_exists("admin", $prop) ? $prop["admin"] : false;

                            echo "<tr>
                                <th class='text-right' scope='row'>$id</th>
                                <td>$std_id</td>
                                <td>$name</td>
                                <td>$email</td>
                                <td data-order='$year$sems'>$year / $sems</td>
                            </tr>";
                            
                        }
                        $stmt->free_result();
                        $stmt->close();  
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#problemTable').DataTable({
            "lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
            'columnDefs': [ {
                'targets': [1,3], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],
            "order": [[ 0, "desc" ]]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>