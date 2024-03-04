<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        
        <!-- Button to add Food -->

<br> <br><br>
        <?php 
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']); 
            }
        ?>
   <table class="tbl-full">
       <tr>
           <th>S.N.</th>
           <th>Food</th>
           <th>Price</th>
           <th>Qty</th>
           <th>Total</th>
           <th>Order</th>
           <th>Status</th>
           <th>Customer Name</th>
           <th>Contact</th>
           <th>Email</th>
           <th>Address</th>
           <th>Action</th>
       </tr>
       <?php 
        // get all the orders from database
         $sql = "SELECT * FROM tbl_order ORDER BY id DESC";  //DISPLAY THE LATEST ORDER AT FIRST

        // execute query
        $res = mysqli_query($conn,$sql);
        // count rows
        $count = mysqli_num_rows($res);

        $sn = 1; //create a serial number and set its initial to 1

        if($count > 0 ){
            // order available
            while($row=mysqli_fetch_assoc($res)){
                // get all the order details
                $id = $row['id'];
                $food=$row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $total =$row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
                $customer_contact = $row['customer_contact'];

                ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $food?></td>
                        <td><?php echo $price?></td>
                        <th><?php echo $qty?></th>
                        <th><?php echo $total?></th>
                        <th><?php echo $order_date?></th>
                        <td>
                            <?php 
                                // ordered, On Delivery, Deliverred, Cancelled
                                if($status == 'delivered'){
                                    echo "<lable style='color: orange'>$status</lable>";
                                }
                                else if($status == 'Delivered'){
                                    echo "<lable style='color: green'>$status</lable>";
                                }
                                else if($status == 'Canceled'){
                                    echo "<lable style='color: red'>$status</lable>";
                                }
                            ?>
                        </td>
                        <th><?php echo $status?></th>

                        <th><?php echo $customer_name?></th>
                        <th><?php echo $customer_contact?></th>
                        <th><?php echo $customer_email?></th>
                        <th><?php echo $customer_address?></th>
                            <td>
                                <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">Update Order</a>

                            </td>
                    </tr>
                <?php
            }
        }
        else{
            // order not available
            echo "<tr><td colspan='12' class='error'>Orders Not Available.</td><tr>";
        }
       ?>
      
       
   </table>
    </div>

</div>

<?php include('partials/footer.php') ?>
