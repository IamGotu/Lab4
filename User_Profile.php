<?php
include('Authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('config/db_conn.php');
?>

<div class="content-wrapper">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Profile</h3>
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
                                    <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $_SESSION['auth_user']['email'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" value="<?php echo $_SESSION['auth_user']['phone_number'] ?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Address" value="<?php echo $_SESSION['auth_user']['address'] ?>" required>
                                </div>   

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control" placeholder="Password" required>
                                        </div>
                                    </div>
                                    
                                <div class="form-group">
                                    <label for="profile_picture">Profile Picture</label>
                                    <input type="file" id="profile_picture" name="profile_picture" class="form-control-file" required>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" name="UpdateUser" class="btn btn-info">Update</button>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
    </section>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>
