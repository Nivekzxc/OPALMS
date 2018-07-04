<?php 
    include("../config/header.php");

    if(!isset($_SESSION['Username']))
        header("Location:../?PleaseLogInToContinue");
    if($emptype != 'Admin'){
        header("location:index.php?accessdenied");
    }
  ?>
    <div class="div-top-menu">
         <img src="../images/NBS.png" class="menu-logo" alt="NBS logo"> 
            <div class="menu-user-info">
                <ul>
                    <li>Welcome , </li>
                    <li><?php echo $ufirstname?></li>
                    <li><?php echo "<i>(".$emptype.")</i>" ?></li>
                    <li><img src="../uploads/EmpProfilePic/<?php echo $employeeimg; ?>" alt="Profile Picture" class="img" onclick='window.location = "viewemployee.php?empid=<?php echo $employeeid; ?>"'></li>
                </ul>
            </div>
    </div>
    <section class="side-left fixed left">
        <ul class="nav">
                        
            <?php if($emptype == "HR" || $emptype =="Human Resource"){ ?>
                        <li class="nav-item current"><a href="../dashboard/"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
                        <li class="nav-item"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-file-text"></i></span>Employee Leaves</a></li>
                        <li class="nav-item"><a href="../dashboard/addemployee.php"><span class="nav-icon"><i class="fa fa-user-plus"></i></span>Add Employee</a></li>
            <?php }
                elseif($emptype == "Admin"){ ?>
                        <li class="nav-item"><a href="../dashboard/"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
                        <li class="nav-item current"><a href="../dashboard/viewbranches.php"><span class="nav-icon"><i class="fa fa-building"></i></span>Branches</a></li>
                        <li class="nav-item"><a href="../dashboard/addbranch.php"><span class="nav-icon"><i class="fa fa-plus"></i></span>Add Branch</a></li>
            <?php } 
                else{
                    ?>
                    <li class="nav-item"><a href="../dashboard/viewemployee.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-address-card"></i></span>View My Profile</a></li>
                    <li class="nav-item"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-address-card"></i></span>My Leaves</a></li>
                    <li class="nav-item"><a href="../dashboard/applyleave.php?empid=<?php echo $employeeid ?>"><span class="nav-icon"><i class="fa fa-envelope"></i></span>Apply a leave</a></li>
            <?php } ?>
                    
                    <li class="nav-item"><a href="../dashboard/settings.php"><span class="nav-icon"><i class="fa fa-cog"></i></span>Settings</a></li>
                    <li class="nav-item"><a href="../dashboard/logout.php"><span class="nav-icon"><i class="fa fa-sign-out"></i></span>Sign out</a></li>
        </ul>
    </section>
    <section class="side-right fixed right">
    <section class="contentSection right clearfix">
        <div class="container"  style="padding-bottom:5%">
            <div class="wrapper employee_list clearfix">
                <div style="padding:10px 10px 10px 10px">
                    <h1>Branch Employees</h1>
                </div>
                <ul class="emp_list">
                    <li class="emp_list_head">
                        <div class="emp_item_head emp_id">Emp-ID</div>
                        <div class="emp_item_head emp_name">Name</div>
                        <div class="emp_item_head">Date Hired</div>
                        <div class="emp_item_head">Position</div>
                        <div class="emp_item_head">Branch</div>
                        <div class="emp_item_head emp_status">Status</div>
                        <div class="emp_item_head">Action</div>
                    </li>
                    <?php 
                        if (isset($_GET['branch'])) {
                            $Branch = $_GET['branch'];
                            $querygetID = mysql_query("SELECT BranchID FROM `tbl_branch` WHERE `BranchNumber`='$Branch'");
                                $fetchID = mysql_fetch_array($querygetID);
                                $EmpBranchID = $fetchID['BranchID'];

                            $getemployeesearch = mysql_query("SELECT * FROM tbl_employee WHERE BranchID ='$EmpBranchID'  ORDER BY EmployeeID ASC");

                            $getemployeecount = mysql_num_rows($getemployeesearch);
                            
                            $getposit = mysql_query("SELECT * FROM `tbl_employee`, `tbl_position` WHERE tbl_employee.`PositionID` = tbl_position.`PositionID`");

                    ?>
                    <div id="displayempList">
                        <?php
                            if($getemployeecount >= 1 ){
                                while($fetch = mysql_fetch_array($getemployeesearch)){
                                    $fetchposit = mysql_fetch_array($getposit);
                                    $firstname = $fetch['FirstName'];
                                    $middlename = $fetch['MiddleName'];
                                    $lastname = $fetch['LastName'];
                                    $datehired = $fetch['DateHired'];
                                    $status = $fetch['Status'];
                                    $branch = $fetch['BranchID'];
                                    $employid = $fetch['EmployeeID'];
                                    $datehired = date("jS F Y", strtotime($datehired));
                                    $position = $fetchposit['PositionName'];
                                
                                    
                                    
                                    if($middlename == ""){
                                        if($emptype == "HR"){
                                            echo '                                      
                                                <li class="emp_item">
                                                    <div class="emp_column emp_id">'.$employid.'</div>
                                                    <div class="emp_column emp_name">'.$firstname." ".$lastname.'</div>
                                                    <div class="emp_column">'.$datehired.'</div>
                                                    <div class="emp_column">'.$position.'</div>
                                                    <div class="emp_column">'.$branch.'</div>
                                                    <div class="emp_column emp_status">'.$status.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" title="View"><a href="../dashboard/viewemployee.php?empid='.$employid.'"><i class="fa fa-eye"></i></a></li>
                                                            <li class="action_item action_edit" title="Edit"><a href="../dashboard/edit.php?empid='.$employid.'"><i class="fa fa-pencil-square-o"></i></a></li>
                                                            <li class="action_item action_delete" title="Delete"><a href="../dashboard/delete.php?empid='.$employid.'"><i class="fa fa-trash-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        } 
                                        elseif ($emptype == 'Admin') {
                                            echo '                                      
                                                <li class="emp_item">
                                                    <div class="emp_column emp_id">'.$employid.'</div>
                                                    <div class="emp_column emp_name">'.$firstname." ".$lastname.'</div>
                                                    <div class="emp_column">'.$datehired.'</div>
                                                    <div class="emp_column">'.$position.'</div>
                                                    <div class="emp_column">'.$branch.'</div>
                                                    <div class="emp_column emp_status">'.$status.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" title="View"><a href="../dashboard/viewemployee.php?empid='.$employid.'"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        }
                                        else {
                                            echo '                                      
                                                <li class="emp_item">
                                                    <div class="emp_column emp_id">'.$employid.'</div>
                                                    <div class="emp_column emp_name">'.$firstname." ".$lastname.'</div>
                                                    <div class="emp_column">'.$datehired.'</div>
                                                    <div class="emp_column">'.$position.'</div>
                                                    <div class="emp_column">'.$branch.'</div>
                                                    <div class="emp_column emp_status">'.$status.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" title="View"><a href="../dashboard/viewemployee.php?empid='.$employid.'"<i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';                                          
                                        }
                                    } else {
                                        if($emptype == "HR"){
                                            echo '                                      
                                                <li class="emp_item">
                                                    <div class="emp_column emp_id">'.$employid.'</div>
                                                    <div class="emp_column emp_name">'.$firstname." ".$middlename." ".$lastname.'</div>
                                                    <div class="emp_column">'.$datehired.'</div>
                                                    <div class="emp_column">'.$position.'</div>
                                                    <div class="emp_column">'.$branch.'</div>
                                                    <div class="emp_column emp_status">'.$status.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view"  title="View"><a href="../dashboard/viewemployee.php?empid='.$employid.'"<i class="fa fa-eye"></i></a></li>
                                                            <li class="action_item action_edit" title="Edit"><a href="../dashboard/edit.php?empid='.$employid.'"><i class="fa fa-pencil-square-o"></i></a></li>
                                                            <li class="action_item action_delete"  title="Delete"><a href="../dashboard/delete.php?empid='.$employid.'"><i class="fa fa-trash-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        } 
                                        elseif ($emptype == 'Admin') {
                                            echo '                                      
                                                <li class="emp_item">
                                                    <div class="emp_column emp_id">'.$employid.'</div>
                                                    <div class="emp_column emp_name">'.$firstname." ".$lastname.'</div>
                                                    <div class="emp_column">'.$datehired.'</div>
                                                    <div class="emp_column">'.$position.'</div>
                                                    <div class="emp_column">'.$branch.'</div>
                                                    <div class="emp_column emp_status">'.$status.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" title="View"><a href="../dashboard/viewemployee.php?empid='.$employid.'"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        }

                                        else {

                                            echo '                                      
                                                <li class="emp_item">
                                                    <div class="emp_column emp_id">'.$employid.'</div>
                                                    <div class="emp_column emp_name">'.$firstname." ".$middlename." ".$lastname.'</div>
                                                    <div class="emp_column">'.$datehired.'</div>
                                                    <div class="emp_column">'.$position.'</div>
                                                    <div class="emp_column">'.$branch.'</div>
                                                    <div class="emp_column emp_status">'.$status.'</div>
                                                    <div class="emp_column">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view"  title="View"><a href="../dashboard/viewemployee.php?empid='.$employid.'"<i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                        }
                                    }
                                }
                
                            } else {
                                echo '<li class="emp_item"> No employee record found </li>';
                            }
                        ?>
                    </div>
                    <?php } ?>
                </ul>
            </div>
        </div>        
    </section>
    </section>
</body>
</html>