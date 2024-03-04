<?php include('partials/menu.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <!-- Main Content Section Start-->
    <div class="main-content">
        <div class="wrapper">
           <h1>Manage Admin</h1> <br> <br>
           <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];  // displaying session message
                    unset($_SESSION['add']); //removing session message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];
                    unset($_SESSION['pwd-not-match']);
                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];
                    unset($_SESSION['change-pwd']);
                }
                
           ?> <br> <br>
           <!-- Button to add Admin -->
           <a href="add-admin.php" class="btn-primary"> Add Admin</a>
            <br> <br><br>
           <table class="tbl-full">
               <tr>
                   <th>S.N.</th>
                   <th>Full Name</th>
                   <th>Username</th>
                   <th>Actions</th>
               </tr>

                    <?php
                        //Query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //checking if the query is execcuted
                        if($res == TRUE)
                        {
                            //Count rows to check if we have data in database or not
                           // $count = $res -> num_rows; // function to get all the rows in database
                           $count =mysqli_num_rows($res);

                           $sn=1; //create a variable and assign the value

                            // check the num of rwos
                            if($count > 0)
                            {
                                                                                  
                               // we have data in database
                                while($rows = mysqli_fetch_assoc($res))
                                {
                                    // using while loop to get all the data from database
                                    // and while loop will rin as long as we have data in database

                                    //get individual data
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    // DISPLAY VALUES IN OUR TABLE
                                    ?>
                                         <tr>
                                            <td><?php echo $sn++;?></td>
                                            <td><?php echo $full_name;?></td>
                                            <td><?php echo $username;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id?>" class="btn-primary">Change Password</a>
                                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>

                                            </td>



                                    <?php

                               
                                }
                            }
                            else{
                                //we do not have any data in our database
                            }
                        }
                    

                    
                    ?>
        
           </table>
        </div>    
    
    </div>
    <!-- Main Content Section End-->

<?php include('partials/footer.php'); ?>
</body>
</html>


