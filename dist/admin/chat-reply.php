<?php include"partials-admin/header.php"; ?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading mb-10"><h2>Message</h2></div>
    <?php
        if(isset($_GET['user_id'])) {
            $message_id = $_GET['mes_id'];
            $id = $_GET['user_id'];
            $sql2 = "SELECT * FROM admin_tbl WHERE id = $id;";
            $res2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($res2);
            $usn = $row2['id'];
        }
    ?>
    <div class="chat-wrapper">
        <div class="chat-left">
        <?php
            $sql = "SELECT * FROM message WHERE message_id = $message_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count > 0) {
                while($row = mysqli_fetch_assoc($res)) {
                    $message_id = $row['message_id'];
                    $sender_id = $row['sender_id'];
                    $content = $row['content'];
                    $date_sended = $row['date_sended'];
                    $receiver_name = $row['receiver_name'];
                    $sender_name = $row['sender_name'];
        ?>
                        <div class="chat-header">
                            <p>Replying to: <?php echo $sender_name; ?> </p>
                            <div>
                                <a class="secondary-btn" href="<?php echo SITEURL;?>admin/chat.php?id=<?php echo $id; ?>">Back</a>
                            </div>
                        </div>
            
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
                <p>Write Message</p>
            </div>
            
            <div class="create-message-to">
                <form action="../includes/admin-chat-reply.inc.php" method="POST">
                    <label>To: <?php echo $sender_name; ?></label>
                    <label for="message">Content:</label>
                    <textarea name="message" id="message" required></textarea>
                    
                    <input type="hidden" name="receiver" value="<?php echo $sender_id;?>">
                    <input type="hidden" name="usn" value="<?php echo $usn; ?>">
                    <input type="hidden" name="receiver_name" value="<?php echo $sender_name; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button class="primary-btn" type="submit" name="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>

    

<?php include "partials-admin/footer.php"; ?>