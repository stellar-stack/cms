<?php include "includes/header.php" ?>
<div id="wrapper">

    <?php //if($connection) echo 'connected'; 
    ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>


        


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome To Admin

                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>


                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $query = "SELECT * FROM posts";
                                    $select_all_post = mysqli_query($connection, $query);
                                    $post_counts = mysqli_num_rows($select_all_post);

                                    echo "<div class='huge'>{$post_counts}</div>"

                                    ?>

                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">



                                    <?php

                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($connection, $query);
                                    $comment_counts = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>{$comment_counts}</div>"


                                    ?>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


                                    <?php

                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($connection, $query);
                                    $post_users = mysqli_num_rows($select_all_users);

                                    echo "<div class='huge'>{$post_users}</div>"

                                    ?>


                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


                                    <?php

                                    $query = "SELECT * FROM categories";
                                    $select_all_comments = mysqli_query($connection, $query);
                                    $post_categories = mysqli_num_rows($select_all_comments);

                                    echo "<div class='huge'>{$post_categories}</div>"

                                    ?>


                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php

$query = "SELECT * FROM posts WHERE post_status = 'published' ";
$select_all_published_posts = mysqli_query($connection, $query);
$post_published_count = mysqli_num_rows($select_all_published_posts);

            $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
            $select_all_draft_posts = mysqli_query($connection, $query);
            $post_draft_count = mysqli_num_rows($select_all_draft_posts);

            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            $unapproved_comments = mysqli_query($connection, $query);
            $unapproved_count = mysqli_num_rows($unapproved_comments);

            $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
            $select_all_subscriber = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($select_all_subscriber);





            ?>


            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'Count'],

                            <?php


                            $element_text = [ 'Active Posts', 'All Possts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [ $post_counts, $post_published_count, $post_draft_count,  $comment_counts, $unapproved_count, $post_users, $subscriber_count,  $post_categories];


                            for ($i = 0; $i < 7; $i++) {

                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }


                            ?>


                            // ['Posts', 1000],

                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/footer.php" ?>