<?php include "view/commonHeader.php"; ?>
<div class="card">
    <div class="card-body table-border-style">
        <div class="table-responsive">
            <input type="text" id="myInput" onkeyup="mySearchFun()" placeholder="Search for names.." title="Type in a name">
            <table class="table table-inverse" id="portfolioTable" style="text-align:center;">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mobile No</th>
                        <th>Location</th>
                        <th>Registration Date</th>
                        <th>Approve</th>                        
                    </tr>
                </thead>
                <tbody>
                <?php
                $l=0;
                $SQL_USERS = mysqli_query($con,"SELECT id,concat(fname,' ',lname) as fullCustName,contactNo, concat(city,' ',state) as location,updatedDt FROM users where adminApprove='1' order by id desc");
                while ($FETCH_USERS = mysqli_fetch_assoc($SQL_USERS)) {
                    $l++;
                    $AUTO_USER_ID = $FETCH_USERS['id'];
                    
                    $uName = $FETCH_USERS['fullCustName'];
                    $contactNo = $FETCH_USERS['contactNo'];
                    $location = $FETCH_USERS['location'];
                    $updatedDt = $FETCH_USERS['updatedDt'];
                    
                ?>
                <!--onclick="showConfirmBoxFun(<?php echo $AUTO_USER_ID; ?>)"-->
                    <tr id="tr_<?php echo $AUTO_USER_ID; ?>" class="portfolio_tr_<?php echo $AUTO_USER_ID; ?>">
                        <td><span onclick="showConfirmBoxFun(<?php echo $AUTO_USER_ID; ?>)" class="deleteIconCls"><i class="icon feather icon-trash text-c-red mb-1 d-block"></i></span></td>
                        <td><?php echo $l; ?></td>
                        <td><?php echo $uName; ?></td>
                        <td><?php echo $contactNo; ?></td>
                        <td><?php echo $location; ?></td>
                        <td><?php echo $updatedDt; ?></td>
                        <td>
                            <a href="?page=userEdit&id=<?php echo $AUTO_USER_ID ?>" class="btn  btn-primary">Approve</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>