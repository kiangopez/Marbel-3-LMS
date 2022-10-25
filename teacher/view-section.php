<?php include "partials-teacher/header.php"; ?>

    <?php
        if(is_numeric($_GET['id'])) {

            $sql_er = "SELECT * FROM section_tbl WHERE section_id =". $_GET['id'];
            $res_er = mysqli_query($conn, $sql_er);
            $count_er = mysqli_num_rows($res_er);
    
            if($count_er == true) {
                $row = mysqli_fetch_assoc($res_er);
                $section_id = $row['section_id'];
                $section_name = $row['section_name'];
                
                $sql = "SELECT * FROM section_tbl AS s
                    INNER JOIN categories_tbl AS c
                        ON s.category_id = c.category_id
                    WHERE s.section_id = $section_id;
                ;";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);
                $category_name = $row['category_name'];

        
    ?>

    <section class="dashboard wrapper column" id="dashboard">
        <div class="heading p-20"><h2><?php echo $category_name." ".$section_name; ?></h2></div>
        <div class="enroll-btn p-20">
            <a href="<?php echo SITEURL;?>teacher/manage-section.php" class="secondary-btn btn-20 mt-20">Back</a>
        </div>
        <br>
        <div class="view-section">
            <table class="tbl-full text-center">
                <tr>
                    <th>Student Name</th>
                    <th>Last Online</th>
                </tr>
                <?php
                    $sql1 = "SELECT * FROM students_tbl WHERE section_id = $section_id ORDER BY fname ;";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);

                    if($count1 > 0) {
                        while($row1 = mysqli_fetch_assoc($res1)) {
                            $full_name = $row1['fname']." ".$row1['mname']." ".$row1['lname'];
                            $usn = $row1['USN'];
                            ?>
                                <tr>
                                    <td><?php echo $full_name; ?></td>
                                    <td>
                                        <?php
                                            $sql2 = "SELECT * FROM user_log WHERE user_usn = $usn ORDER BY user_log_id desc LIMIT 1";
                                            $res2 = mysqli_query($conn, $sql2);
                                            $count2 = mysqli_num_rows($res2);
                                            $row2 = mysqli_fetch_assoc($res2);
                                            
                                            if(!$row2) {
                                                ?> 
                                                    <p>No Login Record</p>
                                                <?php
                                            } else {
                                                function time_elapsed_string($datetime, $full = false) {
                                                    date_default_timezone_set('Asia/Manila');

                                                    $now = new DateTime;
                                                    $ago = new DateTime($datetime);
                                                    $diff = $now->diff($ago);
                                                
                                                    $diff->w = floor($diff->d / 7);
                                                    $diff->d -= $diff->w * 7;
                                                
                                                    $string = array(
                                                        'y' => 'year',
                                                        'm' => 'month',
                                                        'w' => 'week',
                                                        'd' => 'day',
                                                        'h' => 'hour',
                                                        'i' => 'minute',
                                                        's' => 'second',
                                                    );
                                                    foreach ($string as $k => &$v) {
                                                        if ($diff->$k) {
                                                            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                                        } else {
                                                            unset($string[$k]);
                                                        }
                                                    }
                                                
                                                    if (!$full) $string = array_slice($string, 0, 1);
                                                    return $string ? implode(', ', $string) . ' ago' : 'just now';
                                                }

                                                 $thedate = $row2['activity_date'];
                                                 
                                                //  $month = substr($thedate, 9, 10);
                                                $year = substr($thedate, 6, 2);
                                                $month = substr($thedate, 3, 2);
                                                $day = substr($thedate, 0, 2);
                                                $time = substr($thedate, 9, 8);
                                                $final_date = "20".$year."-".$month."-".$day." ".$time;
                                                // $finaldate = strtotime ( $thedate );echo"<br>"; echo date ( 'Y-m-d h:i:s' , $finaldate );
                                                $displaydate = time_elapsed_string($final_date);
                                                ?>
                                                    <p class="italic"><?php echo $displaydate; ?></p>
                                                <?php
                                            }                
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }

                    } else {
                        ?>
                            <tr>
                                <td colspan="2">No Students Available</td>
                            </tr>
                        <?php
                    }
                ?>
            </table>
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
