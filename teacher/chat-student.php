<?php include"partials-teacher/header.php"; ?>
<?php
    if($_GET['id'] == $_SESSION['teacherId']) {
        $id = $_GET['id'];
        $sql2 = "SELECT * FROM teachers_tbl WHERE teacher_id = $id;";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);
        $usn = $row2['URN'];
?>
<section class="dashboard wrapper column" id="dashboard">
    <div class="heading mb-10"><h2>Messages</h2></div>
    <div class="chat-wrapper">
        <div class="chat-left">
        <form action="../includes/read-message-teacher.inc.php" method="POST">
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
                    <a class="blue" href="<?php echo SITEURL;?>teacher/sent-message.php?id=<?php echo $id; ?>">Sent messages</a>
                </div>
            </div>
                <?php
                    $sql = "SELECT * FROM message WHERE receiver_id = $usn AND message_status = 'active' ORDER BY message_id DESC";
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
                                        <a href="<?php echo SITEURL;?>teacher/remove-message.php?id=<?php echo $message_id; ?>&user_id=<?php echo $id;?>" class="danger-btn" onclick="javascript: return confirm('Do you want to remove this message?');">Remove</a>
                                        <a class="primary-btn text-center" href="<?php echo SITEURL;?>teacher/chat-reply.php?mes_id=<?php echo $message_id; ?>&user_id=<?php echo $id;?>">Reply</a>
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
                <a class="blue" href="<?php echo SITEURL;?>teacher/chat-student.php?id=<?php echo $id; ?>">Student</a>
                <a href="<?php echo SITEURL;?>teacher/chat-teacher.php?id=<?php echo $id; ?>">Teacher</a>
            </div>
            
            <div class="create-message-to">
                <form action="../includes/chat-teacher-to-student.inc.php" method="POST">
                    <label for="receiver">To:</label>
                    <select class="chosen-select" name="receiver" id="receiver" required>
                    <option></option>
                        <script>
                            $(document).ready(function(){
                                $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
                            })
                        </script>
                    <?php
                        $sql = "SELECT * FROM students_tbl ORDER BY fname ASC";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);

                        if($count > 0) {
                           while($row = mysqli_fetch_assoc($res)) {
                               $student_id = $row['USN'];
                               $fname = $row['fname'];
                               $mname = $row['mname'];
                               $lname = $row['lname'];
                               $full_name = $fname.' '.$mname.' '.$lname;
                               ?>
                                <option value="<?php echo $student_id; ?>"><?php echo $full_name;?></option>
                               <?php
                           }
                        }
                    ?>
                    </select>
                    <label for="message">Content:</label>
                    <textarea name="message" id="message" required></textarea>

                    <input type="hidden" name="usn" value="<?php echo $usn; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                    <a class="blue" href="<?php echo SITEURL?>teacher/home.php">Return to Homepage</a>
                </div>
            </section>
            <?php
        }
        ?>
</section>

    

<?php include "partials-teacher/footer.php"; ?>