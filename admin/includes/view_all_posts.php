<?php

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $postValueId) {

        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {

            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' Where 
            post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connection, $query);
                confirm($update_to_published_status);
                break;


            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' Where 
                post_id = {$postValueId} ";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirm($update_to_draft_status);
                break;


            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirm($update_to_delete_status);
                break;

            // added a clone functionality


            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $select_post_query = mysqli_query($connection, $query);
                while($row = mysqli_fetch_array($select_post_query)) {
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date'];
                $post_author = $row['post_author'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                }
                $copy_query = mysqli_query($connection, $query);
                if(!$copy_query) {
                    die("QUERY FAILED"  . mysqli_error($connection));
                }
                break;




        }
    }
}



?>


<form action="" method="post">


    <table class="table table-bordered table-hover">


        <div id="bulkOptionContainer" class="col-xs-4">

            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>

        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>category</th>
                <th>status</th>
                <th>image</th>
                <th>tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Seen</th>

            </tr>
        </thead>


        <tbody>

            <?php

            $query = "SELECT * FROM posts ORDER BY post_id DESC ";
            $select_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_posts)) {

                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_counts = $row['post_views_counts'];


                echo "<tr>";
            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>

            <?php

                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";

                $select_categories_id = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<td> {$cat_title} </td>";
                }



                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../img/$post_image' alt='image'></td>";
                echo "<td>$post_tags</td>";

$query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
$send_comment_query = mysqli_query($connection, $query);
$count_comments = mysqli_num_rows($send_comment_query);
                echo "<td><a href=''>$count_comments<a></td>";



                echo "<td> $post_date </td>";
                echo "<td> <a href='../post.php?p_id={$post_id}' > View Post </a> </td>";
                echo "<td> <a href='posts.php?source=edit_post&p_id={$post_id}' > Edit </a> </td>";
                echo "<td> 
                <a onClick=\" javascript: return confirm('Are you surre you want to delete');\" 
                href='posts.php?delete={$post_id}' > Delete </a> </td>";
                echo "<td> <a href='posts.php?reset={$post_id}'>{$post_views_counts}</a></td>";
                echo "</tr>";
            }





            ?>
        </tbody>
    </table>
</form>


<?php
if (isset($_GET['delete'])) {

    $the_post_id = $_GET['delete'];

    $query = "DELETE FROM posts WHERE 
                       post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);

    confirm($delete_query);

    header("Location: posts.php");
}


if (isset($_GET['reset'])) {

    $the_post_id = $_GET['reset'];

    $query = "UPDATE posts SET post_views_counts = 0
    WHERE post_id = " . mysqli_real_escape_string($connection, $_GET['reset']) . "" ;

    $reset_query = mysqli_query($connection, $query);

    confirm($reset_query);

    header("Location: posts.php");
}

