<script>
    $('.launchModal').on('click', function () {
        $('#modalTitle').html('Loading...');
        $('#modalBody').html('<div class="d-flex justify-content-center"><img class="img-fluid" align="center" src="<?php echo randomLoading(); ?>"></div>');
        $('#modalBodyCode').html("<div></div>");
        var title = $(this).data('title');
        var subID = $(this).data('id');
        var userID = $(this).data('uid');
        var owner = $(this).data('owner');
            $.ajax({
                type: 'GET',
                url: '../pages/submission_gen.php',
                data: {
                    'id': subID
                },
                success: function (data) {
                    $('#modalBody').html(data);
                }
            }).then(function() {
                if (owner) {
                    $.ajax({
                        type: 'GET',
                        url: '../pages/submission_code.php?target=' + subID,
                        data: {
                            'id': subID
                        },
                        success: function (data) {
                            $('#modalBodyCode').html('<pre><code>' + data + '</code></pre>');
                            $('pre > code').each(function() {
                                hljs.highlightBlock(this);
                            });
                        }
                    });
                }
            }).then(function() {
                $('#modalTitle').html(title);
            });
        });
</script>

<!-- Announcement Modal -->
<div class="modal animated jackInTheBox fadeOut" id="announcementPopup" name="announcementPopup" tabindex="-1" role="dialog"
    aria-labelledby="announcementTitle" aria-hidden="true">
    <div class="modal-dialog modal-notify modal-coekku modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="annoucementTitle">ข่าวประชาสัมพันธ์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="https://s3.p0nd.ga/54654.jfif"
                    class="img-fluid w-100 d-flex justify-content-center mb-3 z-depth-2">
                <div class="modal-text">
                    <p>ทางผู้พัฒนาขอความร่วมมือจากผู้เข้าชมเว็บไซต์ทุก ๆ ท่าน ร่วมตอบแบบสำรวจความพึงพอใจในการใช้งานเว็บไซต์ <a href="https://grader.ga/">grader.ga</a> และ/หรือ <a href="https://lca.grader.ga/">lca.grader.ga</a><br><p class="text-right">ขอบคุณครับ<br>PondJa<sup>TH</sup></p>
                    </p>
                    <div class="text-center"><a href="https://p0nd.ga/graderga_survey" target="_blank" class="btn btn-coekku"><h1 class="animated infinite pulse">ตอบแบบสอบถาม</h1></a></div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-md btn-warning" data-dismiss="modal">ปิดหน้าต่าง</a>
            </div>
        </div>
    </div>
</div>
<!-- Announcement Modal -->

<!-- Popup Modal -->
<div class="modal animated fade" id="modalPopup" name="modalPopup" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-notify modal-coekku modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBodyBody">
                <div id="modalBody"></div>
                <div id="modalBodyCode"></div>
            </div>
        </div>
    </div>
</div>
<!-- Popup Modal -->
<?php 
    if (isset($_SESSION['swal_error']) && isset($_SESSION['swal_error_msg'])) { 
        errorSwal($_SESSION['swal_error'],$_SESSION['swal_error_msg']);
        $_SESSION['swal_error'] = null;
        $_SESSION['swal_error_msg'] = null;
    }
?>
<?php 
    if (isset($_SESSION['swal_warning']) && isset($_SESSION['swal_warning_msg'])) { 
        warningSwal($_SESSION['swal_warning'],$_SESSION['swal_warning_msg']);
        $_SESSION['swal_warning'] = null;
        $_SESSION['swal_warning_msg'] = null;
    }
?>
<?php 
    if (isset($_SESSION['swal_success'])) { 
        successSwal($_SESSION['swal_success'],$_SESSION['swal_success_msg']);
        $_SESSION['swal_success'] = null;
        $_SESSION['swal_success_msg'] = null;
    }
?>
<script>
    $("#logoutBtn").click(function () {
        swal({
            title: "ออกจากระบบ ?",
            text: "คุณต้องการออกจากระบบหรือไม่?",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "../logout/";
            }
        });
    });
</script>