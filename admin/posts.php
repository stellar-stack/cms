<?php include "includes/header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>





    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome To Admin
                        <small>User</small>
                    </h1>

<?php


if(isset($_GET['source'])) {

    $source = $_GET['source'];

} else {
    $source = '';
}

switch($source) {

    case '34';
        echo 'NICE';
        break;

    case '100';
        echo 'NICE 100';
        break;

    case '200';
        echo 'NICE 200';
        break;

        default: 
        include "includes/view_all_posts.php";
        //
        break;
}



?>






                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ?>