<?php include "partials-admin/header.php"; ?>
<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM categories_tbl WHERE category_id = $id;";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
    }
?>
    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2>Edit Category</h2></div>
        <br>
        
        <div class="form-wrapper">
            <form action="../includes/update-category.inc.php" method="POST" class="pt-20">
                <div>
                    <label for="cat-name">Category Name:</label>
                    <input type="text" name="cat-name" id="cat-name" value="<?php echo $row['category_name'] ?>">

                    <label for="cat-code">Category Code:</label>
                    <input type="text" name="cat-code" id="cat-code" value="<?php echo $row['category_code'] ?>">

                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    
                    <div class="p-0 space-between">
                        <div class="p-0">
                            <a class="secondary-btn" href="<?php echo SITEURL;?>admin/manage-subjects.php">Back</a>
                            <button class="primary-btn" type="submit" name="submit">Update</button>
                        </div>
                        <div class="p-0 mt-10">
                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>"  onclick="javascript: return confirm('Do you want to delete this category?');" class="danger-btn">Remove</a>
                            <!-- <script>
                                function removeCategory() {
                                    return confirm('Please confirm deletion');
                                }
                            </script> -->
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


<?php include "partials-admin/footer.php"; ?>