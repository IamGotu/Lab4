<?php
include('Authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/db_conn.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="Dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            
                <!-- Updating User's Profile Picture -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update User's Profile Picture</h3>
                    </div>
                    <div class="card-body">
                        
                        <?php
                            include('message.php');
                        ?>

                        <form action="Update_Profile.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="user_id" name="user_id" class="form-control" value="<?php echo $_SESSION['auth_user']['user_id'] ?>" required>

                            <div class="form-group">
                                <label for="profile_picture">Profile Picture</label>
                                <input type="file" id="profile_picture" name="profile_picture" class="form-control-file" required>
                            </div>

                            <div class="text-right">
                                <button type="submit" name="UpdatePicture" class="btn btn-info">Update</button>
                            </div>
                        </form>

                    </div>
                </div>


                <!-- Updating User Information -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Update User's Information</h3>
                    </div>
                    <div class="card-body">
                        
                        <?php
                            include('message.php');
                        ?>

                        <form action="Update_Profile.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" id="user_id" name="user_id" class="form-control" value="<?php echo $_SESSION['auth_user']['user_id'] ?>" required>

                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Full Name" value="<?php echo $_SESSION['auth_user']['full_name'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="">Birthdate</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?php echo $_SESSION['auth_user']['full_name'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" value="<?php echo $_SESSION['auth_user']['phone_number'] ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="<?php echo $_SESSION['auth_user']['address'] ?>" required>
                            </div>   

                            <div class="text-right">
                                <button type="submit" name="UpdateInfo" class="btn btn-info">Update</button>
                            </div>
                        </form>

                    </div>
                </div>


                <!-- Updating User Password -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update User's Password</h3>
                            </div>
                            <div class="card-body">
                                
                                <?php
                                    include('message.php');
                                ?>

                                <form action="Update_Profile.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" id="user_id" name="user_id" class="form-control" value="<?php echo $_SESSION['auth_user']['user_id'] ?>">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Current Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">New Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" name="UpdatePass" class="btn btn-info">Update</button>
                                    </div>
                                </form>
                                    
                            </div>
                        </div>

            </div>
        </div>
    </div>
</section>


</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
