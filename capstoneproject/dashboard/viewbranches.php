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
                <div class="menu-search">
                <form method="GET">
                    <input type="text" name="Search" placeholder="Search branch...">
                    <input type="submit" name="Searchingbranch" value="&#10140;">
                </form>
                <?php if(isset($_GET['Searchingbranch'])){
                    $Search = $_GET['Search'];
                    header("location:search.php?branch=$Search");
                    } ?>
            </div><br><hr>
                <?php
                    $getbranch = mysql_query("SELECT * FROM tbl_branch ORDER BY BranchNumber ASC");
                    $getbranchcount = mysql_num_rows($getbranch);

                    
                ?>
                <ul class="emp_list">
                    <li class="emp_list_head">
                        <div class="branch_item_head branch_num">Branch Number</div>
                        <div class="branch_item_head branch_name">Branch Name</div>
                        <div class="branch_item_head branch_name">Branch Address</div> 
                        <div class="branch_item_head branch_num">Branch Contact</div>
                        <div class="branch_item_head branch_num">Action</div>
                    </li>
                    <div id="displayempList">
                        <?php
                            if($getbranchcount >= 1 ){
                                while($fetch = mysql_fetch_array($getbranch)){
                                    $allbranchnumber = $fetch['BranchNumber'];
                                    $allbranchid = $fetch['BranchID'];
                                    $allbranchaddress = $fetch['BranchAddress'];
                                    $allbranchcontact = $fetch['BranchContact'];

                                    $Count = mysql_query("SELECT COUNT(EmployeeID) AS COUNT FROM tbl_employee WHERE BranchID = '$allbranchid'");
                                    $fetchcount = mysql_fetch_array($Count);

                                    echo '                                      
                                                <li class="branch_item">
                                                    <div class="branch_column branch_num">'.$allbranchnumber.'</div>
                                                    <div class="branch_column branch_name">'.$allbranchid.'</div>
                                                    <div class="branch_column branch_name">'.$allbranchaddress.'</div>
                                                    <div class="branch_column branch_num">'.$allbranchcontact.'</div>
                                                    <div class="branch_column branch_num">
                                                        <ul class="action_list">
                                                            <li class="action_item action_view" title="View"><a href="../dashboard/viewbranchemp.php?branch='.$allbranchnumber.'"><i class="fa fa-eye"></i></a></li>
                                                            <li class="action_item action_edit" title="Edit">
                                                            <a href="../dashboard/edit.php?branch='.$allbranchnumber.'"><i class="fa fa-pencil-square-o"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            ';
                                    }
                                }
                            else {
                                echo '<li class="emp_item"> No branch found </li>';
                            }
                        ?>
                    </div>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>