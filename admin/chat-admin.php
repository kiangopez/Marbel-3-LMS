<?php include"partials-admin/header.php"; ?>
<?php
    if($_GET['id'] == $_SESSION['adminId']) {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM admin_tbl WHERE id = $id;";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $admin_id = $row2['id'];
?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading mb-10"><h2>Messages</h2></div>
    <div class="chat-wrapper">
        <div class="chat-left">
        <form action="../includes/read-message-admin.inc.php" method="POST">
            <div class="chat-header">
                <p>Inbox</p>
                <div class="flex gap-20 c-header-items">
                    <button class="primary-btn" name="read">Read</button>
                    <input type="checkbox" name="selectall" id="checkAll"> <label for="checkall">Check all</label>
                        <script>
                            $("#checkAll").click(function () {
                                $('input:checkbox').not(this).prop('checked', this.checked);
                            });
                        </script>
                    <a class="blue" href="<?php echo SITEURL;?>admin/sent-message.php?id=<?php echo $id; ?>">Sent messages</a>
                </div>
            </div>
                <?php
                    $sql = "SELECT * FROM message WHERE receiver_id = $admin_id AND message_status = 'active' ORDER BY message_id DESC";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $message_id = $row['message_id'];
                            $content = $row['content'];
                            $date_sended = $row['date_sended'];
                            $receiver_name = $row['receiver_name'];
                            $sender_name = $row['sender_name'];
                            ?>
                            <div class="chat-message">
                                <div class="message-content">
                                    <?php echo $content; ?>
                                    <input type="hidden" name="user_id" value="<?php echo $id; ?>" >
                                </div>
                                <div class="msg-checkbox">
                                    <input type="checkbox" name="selector[]" value="<?php echo $message_id; ?>" >
                                </div>
                                <div class="message-footer">
                                    <div class="sender">
                                        <p>Sent by</p> <?php echo $sender_name;?> <?php echo $date_sended; ?>
                                    </div>
                                    <div class="message-btn">
                                        <a href="<?php echo SITEURL;?>admin/remove-message.php?id=<?php echo $message_id; ?>&user_id=<?php echo $id;?>" class="danger-btn" onclick="javascript: return confirm('Do you want to remove this message?');">Remove</a>
                                        <a class="primary-btn text-center" href="<?php echo SITEURL;?>admin/chat-reply.php?mes_id=<?php echo $message_id; ?>&user_id=<?php echo $id;?>">Reply</a>
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
        </form>
        <div class="chat-right">
            <div class="create-message-header">
                <p>Create Message</p>
            </div>
            <div class="create-message-for">
                <a href="<?php echo SITEURL;?>admin/chat-student.php?id=<?php echo $id; ?>">Student</a>
                <a href="<?php echo SITEURL;?>admin/chat-teacher.php?id=<?php echo $id; ?>">Teacher</a>
                <a class="blue" href="<?php echo SITEURL;?>admin/chat-admin.php?id=<?php echo $id; ?>">Admin</a>
            </div>
            
            <div class="create-message-to">
                <form action="../includes/chat-admin-to-admin.inc.php" method="POST">
                    <label for="receiver">To:</label>
                    <select class="chosen-select" name="receiver" id="receiver" required>
                        <option></option>
                            <script>
                                $(document).ready(function(){
                                    $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
                                })
                            </script>
                        <?php
                            $sql = "SELECT * FROM admin_tbl ORDER BY full_name ASC";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if($count > 0) {
                            while($row5 = mysqli_fetch_assoc($res)) {
                                $chat_admin_id = $row5['id'];
                                $full_name = $row5['full_name'];
                                ?>
                                    <option value="<?php echo $chat_admin_id; ?>"><?php echo $full_name;?></option>
                                <?php
                            }
                            }
                        ?>
                    </select>
                    <label for="message">Content:</label>
                    <textarea name="message" id="message" required></textarea>

                    <input type="hidden" name="usn" value="<?php echo $admin_id; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="receiver_id" value="<?php echo $chat_admin_id; ?>">
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