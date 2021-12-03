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
                    <th>product_title</th>
                    <th>product_visual</th>
                    <th>datetime_submitted</th>
                    <th>author</th>
                    <th>tag</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nbo = 1;
                    $sql = "select * from posts";
                    $result = mysqli_query( $dbc, $sql);
                    while( $row = mysqli_fetch_array( $result ) ) {
                    ?>
                    <tr>
                        <th><?php echo $nbo; ?></th>
                        <td><?php echo $row['product_title']; ?></td>
                        <td><?php echo $row['product_visual']; ?></td>
                        <td><?php echo $row['datetime_submitted']; ?></td>
                        <td><?php echo $row['author']; ?></td>
                        <td><?php echo $row['tag']; ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $row['product_id']; ?>">
                                <i style="color:red;" class="pe-7s-pen"></i>
                            </a>
                        </td>
                        <td>
                            <a class="delete_product" delete_id="<?php echo $row['product_id']; ?>">
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