<?php include('templates/header.admin.tpl.php') ?>
<?php include('templates/head.admin.tpl.php') ?>
<?php include('templates/sidebar.admin.tpl.php') ?>
<!--main-->
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Users
                <div class="page-title-subheading">This is an example.
                </div>
            </div>
        </div>   
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="card-body"><h5 class="card-title">Users table</h5>
        <table class="mb-0 table datatable" style="text-align: center;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nbo = 1;
                    $sql = "select * from users";
                    $result = mysqli_query( $dbc, $sql);
                    while( $row = mysqli_fetch_array( $result ) ) {
                    ?>
                    <tr>
                        <th><?php echo $nbo; ?></th>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>0<?php echo $row['phone']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['user_id']; ?>">
                                <i style="color:red;" class="pe-7s-pen"></i>
                            </a>
                        </td>
                        <td>
                            <a class="delete" delete_id="<?php echo $row['user_id']; ?>">
                                <i class="pe-7s-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        $nbo++;
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('templates/footer.admin.tpl.php') ?>