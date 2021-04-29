<!-- Body Starts Here -->

<?php 
    if(isset($_GET['student_id']))
    {
        $student_id=$_GET['student_id'];
        $tbl_name='tbl_student';
        $where="student_id=$student_id";
        $query=$obj->select_data($tbl_name,$where);
        $res=$obj->execute_query($conn,$query);
        $count_rows=$obj->num_rows($res);
        if($count_rows==1)
        {
            $row=$obj->fetch_data($res);
            $first_name=$row['first_name'];
            $last_name=$row['last_name'];
            $email=$row['email'];
            $username=$row['username'];
            $password=$row['password'];
            $contact=$row['contact'];
            $gender=$row['gender'];
            $faculty=$row['faculty'];
            $is_active=$row['is_active'];
        }
        else
        {
            header('location:'.SITEURL.'admin/index.php?page=students');
        }
    }
    else
    {
        header('location:'.SITEURL.'admin/index.php?page=students');
    }
?>

<div class="main">
            <div class="content">
                <div class="report">
                    
                    <form method="post" action="" class="forms">
                        <h2>Update Student</h2>
                      <?php 
                            if(isset($_SESSION['validation']))
                            {
                                echo $_SESSION['validation'];
                                unset($_SESSION['validation']);
                            }
                            if(isset($_SESSION['update']))
                            {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                            }
                        ?>
                        <span class="name">First Name</span> 
                        <input type="text" name="first_name" value="<?php echo $first_name; ?>" required="true" /><br />
                        
                        <span class="name">Last Name</span>
                        <input type="text" name="last_name" value="<?php echo $last_name; ?>" required="true" /><br />
                        
                        <span class="name">Email</span>
                        <input type="email" name="email" value="<?php echo $email; ?>" required="true" /><br />
                        
                        <span class="name">Username</span>
                        <input type="text" name="username" value="<?php echo $username; ?>" required="true" /><br />
                        
                        <span class="name">Password</span>
                        <input type="text" name="password" value="<?php echo $password; ?>" required="true" /><br />
                        
                        <span class="name">Contact</span>
                        <input type="tel" name="contact" value="<?php echo $contact; ?>" /><br />
                        
                        <span class="name">Gender</span>
                        <input <?php if($gender=='male'){echo "checked='checked'";} ?> type="radio" name="gender" value="male" /> Male 
                        <input <?php if($gender=='female'){echo "checked='checked'";} ?> type="radio" name="gender" value="female" /> Female 
                        <input <?php if($gender=='other'){echo "checked='checked'";} ?> type="radio" name="gender" value="other" /> Other
                        <br />
                        
                        <span class="name">Faculty</span>
                        <select name="faculty">
                          
                           <?php 
                                //Get Faculties from database
                                $tbl_name="tbl_faculty";
                                $query=$obj->select_data($tbl_name);
                                $res=$obj->execute_query($conn,$query);
                                $count_rows=$obj->num_rows($res);
                                if($count_rows>0)
                                {
                                    while($row=$obj->fetch_data($res))
                                    {
                                        $faculty_id=$row['faculty_id'];
                                        $faculty_name=$row['faculty_name'];
                                        ?>
                                        <option <?php if($faculty==$faculty_id){echo"selected='selected'";} ?> value="<?php echo $faculty_id; ?>"><?php echo $faculty_name; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">Uncategorized</option>
                                    <?php
                                }
                            ?>
                      </select>
                      </br>
                  
                      <span class="name">Is Active?</span>
                        <input <?php if($is_active=='yes'){echo "checked='checked'";} ?> type="radio" name="is_active" value="yes" /> Yes 
                        <input <?php if($is_active=='no'){echo "checked='checked'";} ?> type="radio" name="is_active" value="no" /> No
                        <br />
                        
                        <input type="submit" name="submit" value="Update Student" class="btn-update" style="margin-left: 15%;" />
                        <a href="<?php echo SITEURL; ?>admin/index.php?page=students"><button type="button" class="btn-delete">Cancel</button></a>
                    </form>
                    
