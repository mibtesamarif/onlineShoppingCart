<?php
include('query.php');
include('header.php');

if(!isset($_SESSION['adminEmail'])){
    echo "<script>location.assign('signin.php')</script>";
}
?>



            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Salse</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                   
                                    <th scope="col">Date</th>
                                    <th scope="col">Customer</th>                                
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                               $query = $pdo->query("select * from invoice");
                               $allInvoices = $query->fetchAll(PDO::FETCH_ASSOC);
                               foreach ($allInvoices as $key => $invoice){
                                ?>

                               
                                <tr>
                                    
                                    <td><?php echo $invoice['date_time']?></td>
                                    <td><?php echo $invoice['u_name']?></td>
                                    <td><?php echo $invoice['total_qty']?></td>
                                    <td><?php echo $invoice['total_amount']?></td>

                                    <td><?php echo $invoice['status']?></td>
                                    <?php
                                    if($invoice['status'] == "pending"){

                                   
                                    ?>
                                    <td>
                                    <form action="email.php" method="post"> 
                                    <button name="sendEmail"class="btn btn-sm btn-primary" >Detail</button>
                                    <input type="hidden" name="userEmail" value="<?php echo $invoice['u_email']?>">
                                    <input name="invoiceId" type="hidden" value="<?php echo $invoice['id']?>">
                                    </form>   
                                </td>
                                <?php
                                 }
                                 else{
                                    ?>

                                        <td><?php echo $invoice['status']?></td>

                                    <?php
                                 }
                                 ?>
                                </tr>
                                <?php
                               }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->




           <?php
           include('footer.php')
           ?>