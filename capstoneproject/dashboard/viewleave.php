<?php 
    include("../config/header.php");

    if(!isset($_SESSION['Username']))
        header("Location:../?PleaseLogInToContinue");
    // if($emptype != 'Admin'){
    //     header("location:index.php?accessdenied");
    // }
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
                        <li class="nav-item"><a href="../dashboard/"><span class="nav-icon"><i class="fa fa-users"></i></span>All Employees</a></li>
                        <li class="nav-item current"><a href="../dashboard/viewleave.php"><span class="nav-icon"><i class="fa fa-file-text"></i></span>Employee Leaves</a></li>
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
                <br><hr>
                <?php
                    if($emptype = 'HR'){
                        $getleaves = mysql_query("SELECT * FROM tbl_leave ORDER BY LeaveID DESC");
                        $getleavescount = mysql_num_rows($getleaves);
                    }
                    if($emptype = 'User'){
                    $getleave = mysql_query("SELECT * FROM tbl_leave WHERE LeaveFilerEmpID = '$employeeid' ORDER BY LeaveID DESC");
                    $getleavecount = mysql_num_rows($getleave);
                    }

                ?>
                <ul class="emp_list">
                    <li class="emp_list_head">
                        <div class="branch_item_head branch_num">Leave ID</div>
                        <div class="branch_item_head branch_name">Employee Name</div>
                        <div class="branch_item_head branch_name">Employee Branch</div> 
                        <div class="branch_item_head branch_num">Leave Type</div>
                        <div class="branch_item_head branch_num">Status</div>
                    </li>
                    <div id="displayempList">
                        <?php
                            if($getleavecount > 0 ){
                                while($fetch = mysql_fetch_array($getleave)){
                                    $allLeaveID = $fetch['LeaveID'];
                                    $allLeaveType = $fetch['LeaveType'];
                                    $allLeaveFileDate = $fetch['LeaveFileDate'];
                                    $allLeaveDuration = $fetch['LeaveDuration'];
                                    $allLeaveDurationFrom = $fetch['LeaveDurationFrom'];
                                    $allLeaveDurationTo = $fetch['LeaveDurationTo'];
                                    $allLeaveContent = $fetch['LeaveContent'];
                                    $allLeaveAttachedFile = $fetch['LeaveAttachedFile'];
                                    $allLeaveFilerName = $fetch['LeaveFilerName'];
                                    $allLeaveFilerBranch = $fetch['LeaveFilerBranch'];
                                    $allLeaveFilerPosition = $fetch['LeaveFilerPosition'];

                                    $Count = mysql_query("SELECT COUNT(LeaveID) AS COUNT FROM tbl_leave WHERE LeaveID='$allLeaveID'");
                                    $fetchcount = mysql_fetch_array($Count);
                                    $checkstatus = mysql_query("SELECT * FROM `tbl_leave` , tbl_leave_approval WHERE `tbl_leave_approval`.LeaveID = `tbl_leave`.LeaveID AND `tbl_leave`.LeaveID='$allLeaveID'");
                                    $Count = mysql_num_rows($checkstatus);

                                    if($allLeaveFileDate != date("Y-m-d")){
                                            $Update = mysql_query("INSERT INTO `tbl_leave_approval`(`LeaveID`, `EmployeeID`, `Approval`, `ApprovedByName`, `ApprovedByID`, `ApprovedByBranch`, `LeavePointsDeduct`) VALUES ('$allLeaveID','$employeeid','Reject','Null','Null','Null','0')");
                                        }
                                    
                                        // if($Count > 0){
                                        //     $mysqlfetch = mysql_fetch_array($checkstatus);
                                        //     $FileDate = $mysqlfetch['LeaveFileDate'];
                                        //     if($FileDate != date("Y-m-d")){
                                        //         $Rejectedd = 1;
                                        //     }
                                        //     else{
                                        //         $Rejectedd = 0;
                                        //     }
                                        // }
                                        // else{
                                        //     $checkstatuss = mysql_query("SELECT * FROM `tbl_leave` WHERE LeaveID='$allLeaveID'");
                                        //     $Countt = mysql_num_rows($checkstatuss);
                                        //     if($Countt > 0){
                                        //     $mysqlfetchs = mysql_fetch_array($checkstatus);
                                        //     $FileDates = $mysqlfetch['LeaveFileDate'];
                                        //         if($FileDates != date("Y-m-d")){
                                        //             $Rejectedd = 1;
                                        //         }
                                        //         else{
                                        //             $Rejectedd = 0;
                                        //         }
                                        //     }
                                        // }


                                    echo '                                      
                                                <li class="branch_item">
                                                    <div class="branch_column branch_num">'.$allLeaveID.'</div>';?>
                                                    <div class="branch_column branch_name branchhover" onclick="window.location='approval.php?LeaveID=<?php echo $allLeaveID; ?>'">
                                                    <?php 

                                    echo            $allLeaveFilerName.'</div>
                                                    <div class="branch_column branch_name">'.$allLeaveFilerBranch.'</div>
                                                    <div class="branch_column branch_num">'.$allLeaveType.'</div>
                                                    <div class="branch_column branch_num">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view status" title="View"><a href="../dashboard/approval.php?LeaveID='.$allLeaveID.'"><i><strong>';
                                                            $sql = mysql_query("SELECT * FROM tbl_leave_approval WHERE LeaveID = '$allLeaveID'");
                                                            $count = mysql_num_rows($sql);
                                                                if($count>0){
                                                                $fetch = mysql_fetch_array($sql);
                                                                $fetched = $fetch['Approval'];                    
                                                                        if($fetched == 'Approved'){
                                                                            echo "<p style='color:white'>Approved</p>";
                                                                        }
                                                                        else{
                                                                            echo "<p style='color:white'>Rejected</p>";
                                                                        }
                                                                }
                                                                else{
                                                                    echo "<p style='color:white'>Pending</p>";
                                                                }


                                    echo                    '</strong></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                    }
                                }
                            elseif($getleavescount > 0 ){
                                while($fetch = mysql_fetch_array($getleaves)){
                                    $allLeaveID = $fetch['LeaveID'];
                                    $allLeaveType = $fetch['LeaveType'];
                                    $allLeaveFileDate = $fetch['LeaveFileDate'];
                                    $allLeaveDuration = $fetch['LeaveDuration'];
                                    $allLeaveDurationFrom = $fetch['LeaveDurationFrom'];
                                    $allLeaveDurationTo = $fetch['LeaveDurationTo'];
                                    $allLeaveContent = $fetch['LeaveContent'];
                                    $allLeaveAttachedFile = $fetch['LeaveAttachedFile'];
                                    $allLeaveFilerName = $fetch['LeaveFilerName'];
                                    $allLeaveFilerBranch = $fetch['LeaveFilerBranch'];
                                    $allLeaveFilerPosition = $fetch['LeaveFilerPosition'];

                                    $Count = mysql_query("SELECT COUNT(LeaveID) AS COUNT FROM tbl_leave WHERE LeaveID='$allLeaveID'");
                                    $fetchcount = mysql_fetch_array($Count);
                                    
                                    if($allLeaveFileDate != date("Y-m-d")){
                                            $Update = mysql_query("INSERT INTO `tbl_leave_approval`(`LeaveID`, `EmployeeID`, `Approval`, `ApprovedByName`, `ApprovedByID`, `ApprovedByBranch`, `LeavePointsDeduct`) VALUES ('$allLeaveID','$employeeid','Reject','Null','Null','Null','0')");
                                        }
                                    echo '                                      
                                                <li class="branch_item">
                                                    <div class="branch_column branch_num">'.$allLeaveID.'</div>';?>
                                                    <div class="branch_column branch_name branchhover" onclick="window.location='approval.php?LeaveID=<?php echo $allLeaveID; ?>'">
                                                    <?php 

                                    echo            $allLeaveFilerName.'</div>
                                                    <div class="branch_column branch_name">'.$allLeaveFilerBranch.'</div>
                                                    <div class="branch_column branch_num">'.$allLeaveType.'</div>
                                                    <div class="branch_column branch_num">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view status" title="View"><a href="../dashboard/approval.php?LeaveID='.$allLeaveID.'"><i><strong>';
                                                            $sql = mysql_query("SELECT * FROM tbl_leave_approval WHERE LeaveID = '$allLeaveID'");
                                                            $count = mysql_num_rows($sql);
                                                                if($count>0){
                                                                $fetch = mysql_fetch_array($sql);
                                                                $fetched = $fetch['Approval'];                    
                                                                        if($fetched == 'Approved'){
                                                                            echo "<p style='color:white'>Approved</p>";
                                                                        }
                                                                        else{
                                                                            echo "<p style='color:white'>Rejected</p>";
                                                                        }
                                                                }
                                                                else{
                                                                    echo "<p style='color:white'>Pending</p>";
                                                                }


                                    echo                    '</strong></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                    }
                                }
                            else {
                                echo '<li class="emp_item"> No Leave found </li>';
                            }

                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </section>
    </section>
</body>
</html>