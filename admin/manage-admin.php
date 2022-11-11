<?php include "partials-admin/header.php"; ?>
<?php
    if($_SESSION['role'] == "superadmin") {
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Manage Admin</h2></div>
        <br>
        <div class="p-20 flex">
            <a class="primary-btn" href="<?php echo SITEURL;?>admin/add-admin.php">Add Admin</a>
        </div>
        <br> <br>
        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add']; 
                unset($_SESSION['add']);
            }
        ?>
        <?php 
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update']; 
                unset($_SESSION['update']);
            }
        ?>
    <div class="manage-table-wrapper">
        <table class="tbl-full text-center">
            <tr>
                <th>Admin#</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php
                $sql = "SELECT * FROM admin_tbl";
                $res = mysqli_query($conn, $sql);

                if($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;

                    if($count > 0) {
                        while($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $uid = $rows['username'];
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $uid; ?></td>
                                <td>
                                    <a class="primary-btn" href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>">Update</a>
                                    <a class="secondary-btn" onclick="javascript: return confirm('Do you want to delete this Admin?');" href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>&user_id=<?php echo $_SESSION['adminId']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="4">No Data Available</td>
                        </tr>
                        <?php
                    }
                }
            ?>
            
        </table>
    </div>
    </section>
    <?php 
    } else {
      ?>
      <section class="dashboard wrapper column" id="dashboard">
          <div class="error-handler">
              <p>You're not allowed in this page</p> 
              <a class="blue" href="<?php echo SITEURL?>index.php">Return to Home</a>
              <p class="break">Error: Admin account don't match</p>
          </div>
      </section>
  <?php
    }
?>
<?php include "partials-admin/footer.php"; ?>
