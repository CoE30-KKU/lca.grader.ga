<?php needAdmin(); ?>
<div class="container mb-3" style="padding-top: 88px;" id="container">
    <h1 class="display-4 font-weight-bold text-center text-coekku">User</h1>
    <form action="../pages/admin_user_import.php" method="POST" enctype="multipart/form-data" id="importSTDfromCSV">
        <a class="btn btn-secondary mr-1" onclick="$('#uploadCSV').click();">Import User (CSV)</a>
        <a href="../static/elements/ImportUserFromREGKKUbyExcelCSV.pdf" target="_blank" class="btn-floating btn-sm btn-info ml-0"><i class="fas fa-question"></i></a>
        <input class="d-none" type="file" accept=".csv" name="uploadCSV" id="uploadCSV"/>
    </form>
    <script>
        $(document).ready(function () {
            $("#uploadCSV").change(function() { 
                if ($(this)[0].files.length > 0) {
                    swal({
                        title: "คำเตือน",
                        text: "คุณกำลังจะนำเข้ารายชื่อนักศึกษาเข้าสู่ระบบ",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true
                    }).then((willDelete) => {
                        if (willDelete) {
                            $("#importSTDfromCSV").submit();
                        }
                    });
                }
            });
        });
    </script>
    <div class="table-responsive">
        <table class="table table-sm table-striped w-100 d-block d-md-table" id="problemTable">
            <thead>
                <tr class="text-nowrap">
                    <th scope="col" class="font-weight-bold text-coekku text-right">#</th>
                    <th scope="col" class="font-weight-bold text-coekku">Student ID</th>
                    <th scope="col" class="font-weight-bold text-coekku">Name</th>
                    <th scope="col" class="font-weight-bold text-coekku">Email</th>
                    <th scope="col" class="font-weight-bold text-coekku">Role</th>
                    <th scope="col" class="font-weight-bold text-coekku">Semester</th>
                    <th scope="col"></th>
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
                            $admin = array_key_exists("admin", $prop) ? $prop["admin"] : false; ?>

                            <tr id="row_<?php echo $id; ?>">
                                <th class='text-right' scope='row'><?php echo $id; ?></th>
                                <td><div id="std_id_<?php echo $id; ?>"><?php echo $std_id; ?></div></td>
                                <td><div id="name_<?php echo $id; ?>"><?php echo $name; ?></div></td>
                                <td><div id="email_<?php echo $id; ?>"><?php echo $email; ?></div></td>
                                <td><div id="role_<?php echo $id; ?>"><?php echo ($admin) ? "Admin" : "Student"; ?></div></td>
                                <td data-order='<?php echo $year.$sems; ?>'><div id="extra_<?php echo $id; ?>"><?php echo $year." / ".$sems; ?></div></td>
                                <td><div id="func_<?php echo $id; ?>"><i class="text-warning fas fa-pencil-alt" onClick="functionButton(<?php echo $id; ?>);"></i> <i class="text-danger fas fa-trash-alt" onClick="deleteButton(<?php echo $id; ?>);"></i></div></td>
                            </tr>
                            
                        <?php }
                        $stmt->free_result();
                        $stmt->close();  
                    }
                }
                ?>
                <script>
                    function functionButton(id) {
                        var name = $("#name_" + id);
                        var std_id = $("#std_id_" + id);
                        var email = $("#email_" + id);
                        var role = $("#role_" + id);
                        var extra = $("#extra_" + id);
                        var funcBtn = $("#func_" + id);

                        var adminSelect = "";
                        var stdSelect = "";
                        if (role.html() == "Admin") adminSelect = "selected";
                        else                        stdSelect = "selected";

                        var extraHTML = extra.html().split(" / ");
                        var year = extraHTML[0];
                        var sems = extraHTML[1];
                        
                        name.html("<input id=\"input_name_" + id + "\" class=\"form-control form-control-sm\" type=\"text\" value=\""+name.html()+"\"/>");
                        std_id.html("<input id=\"input_std_id_" + id + "\" class=\"form-control form-control-sm\" type=\"text\" value=\""+std_id.html()+"\"/>");
                        email.html("<input id=\"input_email_" + id + "\" class=\"form-control form-control-sm\" type=\"text\" value=\""+email.html()+"\"/>");
                        role.html("<select id=\"input_role_"+ id + "\" class=\"custom-select custom-select-sm\"><option value=0 "+stdSelect+">Student</option><option value=1 "+adminSelect+">Admin</option></select>")
                        extra.html("<form class=\"form-inline\"><input placeholder=\"Y\" style=\"width: 55px;\" id=\"input_extra_1_" + id + "\" class=\"form-control form-control-sm\" type=\"text\" value=\""+year+"\"/><input placeholder=\"S\" style=\"width: 30px;\" id=\"input_extra_2_" + id + "\" class=\"form-control form-control-sm\" type=\"text\" value=\""+sems+"\"/></form>");
                        funcBtn.html("<i class=\"text-success fas fa-check\" onClick=\"saveButton("+id+");\"></i>");
                    }

                    function saveButton(id) {
                        var iname = $("#input_name_" + id);
                        var istd_id = $("#input_std_id_" + id);
                        var iemail = $("#input_email_" + id);
                        var irole = $("#input_role_" + id);
                        var iextra1 = $("#input_extra_1_" + id);
                        var iextra2 = $("#input_extra_2_" + id);

                        $.ajax({
                            type: 'POST',
                            url: '../pages/admin_user_save.php',
                            data: { 
                                'id': id,
                                'std_id': istd_id.val(),
                                'name': iname.val(),
                                'email': iemail.val(),
                                'role': irole.val(),
                                'year': iextra1.val(),
                                'sems': iextra2.val(),
                            },
                            success: function (data) { 
                                console.log(data);
                                if (data.indexOf("false") >= 0) {
                                    toastr.error("ไม่สามารถบันทึกข้อมูล '" + iname.val() + " #" + id + "' โปรดลองใหม่อีกครั้ง!");
                                } else {
                                    $("#name_" + id).html(iname.val());
                                    $("#std_id_" + id).html(istd_id.val());
                                    $("#email_" + id).html(iemail.val());
                                    $("#role_" + id).html((irole.val() == "0") ? "Student" : "Admin");
                                    $("#extra_" + id).html(iextra1.val() + " / " + iextra2.val());
                                    $("#func_" + id).html("<i class=\"text-warning fas fa-pencil-alt\" onClick=\"functionButton(" + id + ");\"></i> <i class=\"text-danger fas fa-trash-alt\" onClick=\"deleteButton(" + id + ");\"></i>");
                                    toastr.success("บันทึกข้อมูล '" + iname.val() + " #" + id + "' สำเร็จ!")
                                }
                            }
                        });
                    }

                    function deleteButton(id) {
                        swal({
                            title: "คำเตือน",
                            text: "คุณกำลังจะลบบัญชี #" + id,
                            icon: "warning",
                            buttons: true,
                            dangerMode: true
                        }).then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    type: 'POST',
                                    url: '../pages/admin_user_delete.php',
                                    data: { 
                                        'id': id
                                    },
                                    success: function (data) { 
                                        console.log(data);
                                        if (data.indexOf("false") >= 0) {
                                            toastr.error("พบข้อผิดพลาด ไม่สามารถลบข้อมูล #" + id +" ได้ โปรดลองใหม่อีกครั้ง!");                                    
                                        } else {
                                            $("#row_" + id).remove();
                                            toastr.success("ลบข้อมูล #" + id + " สำเร็จ!")
                                        }
                                    }
                                });
                            }
                        });
                    }
                </script>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#problemTable').DataTable({
            "lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
            'columnDefs': [ {
                'targets': [1,3,4,6], // column index (start from 0)
                'orderable': false, // set orderable false for selected columns
            }],
            "order": [[ 5, "desc" ]]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>