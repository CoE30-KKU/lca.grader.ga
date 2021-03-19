<div class="homepage">
    <div class="container h-100 w-100">
        <div class="h-100 w-100 row align-items-center">
            <div class="col-12 col-md-8">
                <h1 class="font-weight-bold text-center text-coekku">Donation</h1>
                <div class="d-flex justify-content-center"><img src="../static/elements/promptpay.png" class="z-depth-1 mb-3" width="300" /></div>
                <h5 class="text-center font-weight-bold">Palapon Soontornpas / พลภณ สุนทรภาส</h5>
                <p class="text-center">
                    <b>Promptpay / TrueWallet</b> : <code>090-8508007</code><br>
                    <b>SCB</b> : <code>551-442288-3</code><br>
                    <b>KBank</b> : <code>084-3-24454-8</code> [ไม่ใช่เบอร์โทรศัพท์!]<br>
                    <a id="donateSubmit" class="btn btn-coekku">ส่งเอกสารการโอนเงินโดเนท</a>
                    <script>
                        $("#donateSubmit").on('click', function() {
                            window.open('./submit','popUpWindow','height=200,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
                        });
                    </script>
                </p>
            </div>
            <div class="col-12 col-md-4">
                <div class="table-responsive">
                <h4 class="font-weight-bold text-center text-coekku">Donator</h4>
                <p class="text-center text-muted"><small>ทุกคนที่บริจาคจะได้รับ <text class="rainbow font-weight-bold">ชื่อสีรุ้ง</text> (ถาวร)</small></p>
                    <table class="table table-hover w-100" id="submissionTable">
                        <thead>
                            <tr class="text-nowrap me">
                                <th scope="col" class="font-weight-bold text-coekku">User</th>
                                <th scope="col" class="font-weight-bold text-coekku">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="text-nowrap">
                            <?php
                                $json = json_decode(file_get_contents("https://api.11th.studio/p0ndja/donation_grader"), true);
                                $amount = 0;
                                foreach ($json as $j) {
                                    $time = strtotime($j['timestamp']); $month = date('m', $time);
                                    $curMonth = date('m', time());
                                    if ($month == $curMonth) {
                                        echo "<tr><th scope='row'>".$j['name']."</th><td>".$j['value']." ฿</td></tr>";
                                        $amount += $j['value'];
                                    }
                                }                                
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php $val = ($amount / 150)*100;
                if ($val > 100) $val = 100; ?>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-coekku" role="progressbar" style="width: <?php echo $val;?>%" aria-valuenow="<?php echo $val;?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small><?php echo $amount; ?>/150 THB (<?php echo number_format((float) $val, 2, '.', ''); ?>%)</small>
            </div>
        </div>
    </div>
</div>