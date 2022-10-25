<?php include"partials-admin/header.php"; ?>
<?php
    if($_GET['id'] == $_SESSION['adminId']) {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM admin_tbl WHERE id = $id;";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $usn = $row2['id'];

?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading mb-10"><h2>Messages</h2></div>
    <div class="chat-wrapper">
        <div class="chat-left">
            <div class="chat-header">
                <p>Inbox</p>
                <div>
                    <a class="secondary-btn" href="<?php echo SITEURL;?>admin/chat.php?id=<?php echo $id; ?>">Back</a>
                </div>
            </div>
                <?php
                    $sql = "SELECT * FROM message_sent WHERE sender_id = $usn ORDER BY message_sent_id DESC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $content = $row['content'];
                            $date_sended = $row['date_sended'];
                            $receiver_name = $row['receiver_name'];
                            $sender_name = $row['sender_name'];
                            ?>
                            <div class="chat-message">
                                <div class="message-content">
                                    <?php echo $content; ?>
                                </div>
                                <div class="message-footer">
                                    <div class="sender">
                                        <p>Sent by</p> <?php echo $sender_name;?> <?php echo $date_sended; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                       ?>
                       <div class="chat-message">
                                <div class="message-content text-center">
                                    <p>You have no messages</p>
                                </div>
                                <div class="message-footer">
                                    <div class="sender">
                                    </div>
                                    <div class="message-btn">
                                    </div>
                                </div>
                            </div>
                       <?php
                    }
                ?>
        </div>
        <div class="chat-right">
            <div class="create-message-header">
                <p>Create Message</p>
            </div>
            <div class="create-message-for">
                <a href="<?php echo SITEURL;?>admin/chat-student.php?id=<?php echo $id; ?>">Student</a>
                <a href="<?php echo SITEURL;?>admin/chat-teacher.php?id=<?php echo $id; ?>">Teacher</a>
            </div>
            <div class="create-message-to">
                <form action="" method="POST">
                    <label for="recipient">To:</label>
                    <select name="recipient" id="recipient">
                        <option value="">Choose student or teacher</option>
                    </select>
                    <label for="message">Content:</label>
                    <textarea name="message" id="message" ></textarea>

                    <button class="primary-btn" type="submit" name="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php
        } else {
            ?>
            <section class="dashboard wrapper column" id="dashboard">
                <div class="error-handler">
                    <p>You're not allowed in this page</p> 
                    <a class="blue" href="<?php echo SITEURL?>admin/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
</section>

<?php include "partials-admin/footer.php"; ?>