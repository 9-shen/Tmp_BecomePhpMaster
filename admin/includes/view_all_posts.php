<?php 

   if (isset($_POST['checkBoxArray'])) {
         
         foreach ($_POST['checkBoxArray'] as $postValueId ) {
              
          $bulk_options = $_POST['bulk_options'];

            switch ($bulk_options) {
                  case 'published':
                        $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                        $update_publish_status = mysqli_query($connection, $query);
                       confirm($update_publish_status);

                        break;
                  case 'draft';      
                        $query ="UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}";
                        $update_draft_status = mysqli_query($connection, $query);
                        confirm($update_draft_status);
                        break;
                  case 'delete';      
                        $query ="DELETE FROM posts WHERE post_id = {$postValueId}";
                        $update_delete_status = mysqli_query($connection, $query);
                        confirm($update_delete_status);
                        break;
                  default:
                        # code...
                        break;
            }

         }
   }



 ?>
<form action="" method="POST">



<table class="table table-bordered table-hover">


<div id="bulkOptionContainer" class="col-xs-4">
<select class="form-control" name="bulk_options" id="">
<option value="">Select Options</option>
<option value="published">Publish</option>
<option value="draft">Draft</option>
<option value="delete">Delete</option>
</select>

</div>
<div class="col-xs-4">
<input class="btn btn-success" type="submit" value="Apply"></input>
<a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
</div>



<tr>
<th> <input id="selectAllBoxes" type="checkbox"> </th>
<th>ID</th>
<th>Author</th>
<th>Title</th>
<th>Category</th>
<th>Status</th>
<th>Image</th>
<th>Tags</th>
<th>Comments</th>
<th>Date</th>
<th>Edit</th>
<th>Delete</th>

</tr>

<tbody>

<?php 

    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);

 while ($row = mysqli_fetch_assoc($select_posts)) {
            $post_id              = $row['post_id'];
            $post_category_id     = $row['post_category_id'];
            $post_title           = $row['post_title'];
            $post_author          = $row['post_author'];
            $post_date            = $row['post_date'];
            $post_image           = $row['post_image'];
            $post_content         = $row['post_content'];
            $post_tags            = $row['post_tags'];
            $post_comment_count   = $row['post_comment_count'];
            $post_status          = $row['post_status'];
            echo "<tr>";
            ?>

            <td> <input class='checkboxes' type='checkbox' name='checkBoxArray[]' value="<?php echo  $post_id; ?>"></td>

              <?php
            echo "<td>$post_id</td>";

            echo "<td>$post_author </td>";
            echo "<td>$post_title </td>";

 $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}' ";
$select_categories_id = mysqli_query($connection, $query);

 while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<td>$cat_title</td>";

      }

            echo "<td>$post_status </td>";
            echo "<td><img src='../images/$post_image' class='img-responsive' width='100'></td>";
            echo "<td>$post_tags</td>";
            echo "<td>$post_comment_count</td>";
            echo "<td>$post_date </td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id} '>Edit </a> </td>";
            echo "<td><a onClick=\" javascript: return confirm('Are You Sure You Want to delete'); \" href='posts.php?delete={$post_id} '>Delete </a> </td>";
            

           
            
            
           
            echo "</tr>";

 }          




 ?>	


</tbody>
</table>
</form>
<?php 
      
      if (isset($_GET['delete'])) {
      $the_post_id = $_GET['delete'];
      $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
      $delete_query = mysqli_query($connection, $query);
      header("location: posts.php");


      }

 ?>