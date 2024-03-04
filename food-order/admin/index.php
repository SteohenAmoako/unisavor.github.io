
<?php include('partials/menu.php'); ?>
    <!-- Main Content Section Start-->
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>  <br><br>
                    <?php
                    if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                    }
                    else{

                    }
                ?>
                <br><br>

            <div class="col-4 text-center">
                <?php
                    // sql query
                    $sql = "SELECT * FROM `tbl_category`";
                    
                    // execute the query
                    $res = mysqli_query($conn, $sql);
                    
                    // count rows
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count;?></h1>
                <br>
                Category
            </div>
            <div class="col-4 text-center">
                    <?php
                            // sql query
                            $sql2 = "SELECT * FROM `tbl_food`";
                            
                            // execute the query
                            $res2 = mysqli_query($conn, $sql2);
                            
                            // count rows
                            $count2 = mysqli_num_rows($res2);
                        ?>
                <h1><?php echo $count2;?></h1>
                <br>
                Foods
            </div>
            <div class="col-4 text-center">
                        <?php
                            // sql query
                            $sql3 = "SELECT * FROM `tbl_order`";
                            
                            // execute the query
                            $res3 = mysqli_query($conn, $sql3);
                            
                            // count rows
                            $count3 = mysqli_num_rows($res3);
                        ?>
                <h1><?php echo $count3;?></h1>
                <br>
                Orders
            </div>
            <div class="col-4 text-center">
                <?php 
                    // create sql query to get total revenue generated
                    // aggregate function in sql
                    $sql4 = "SELECT SUM(total) AS Total FROM `tbl_order` WHERE status ='Delivered'";
                    
                    // execute the query
                    $res4 = mysqli_query($conn, $sql4);

                    // get the value
                    $row4 = mysqli_fetch_assoc($res4);

                    // get the total revenue
                    $total_revenue = $row4['Total'];

                    // count rows
                    // $count4 = ($total_revenue != null) ? 1 : 0;
                ?>
                <h1>&#x20B5;<?php echo $total_revenue;?></h1>
                <br>
                Revenue Generated   
            </div>

            <div class="clearfix"></div>
           
        </div>    
    
    </div>
    <!-- Main Content Section End-->
<?php include('partials/footer.php'); ?>