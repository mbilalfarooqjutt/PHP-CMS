<center><h1 style="color:#5990BB ">View All Comments</h1></center><br>
                        <table class="table table-bordered table-hover">
                        	<thead>
                        		<tr>
                        			<!-- <th>Id</th> -->
                        			<th>Author</th>
                        			<th>Comment</th>
                        			<th>Email</th>
                        			<th>In Response to</th>
                        			<th>Date</th>
                        			<th>Delete</th>
                        		</tr>
                        	</thead>
	                        <tbody>

	                        	<?php 
	                        	 $user = $_SESSION['username'];

								$query = "SELECT * FROM comments WHERE EXISTS (SELECT * FROM posts WHERE posts.post_id = comments.comment_post_id AND posts.post_user = '{$user}' AND comment_status = 'approved')";

								$select_comments = mysqli_query($con,$query);

								while ($row = mysqli_fetch_assoc($select_comments)) {
								$comment_id = escape($row['comment_id']);
								$comment_post_id = escape($row['comment_post_id']);
								$comment_author = escape(trim($row['comment_author']));
								$comment_content = escape(trim($row['comment_content']));
								$comment_email = escape($row['comment_email']);
								$comment_date = escape($row['comment_date']);
								
								echo "<tr>";
								// echo "<td>$comment_id</td>";
								echo "<td>$comment_author</td>";
								echo "<td>$comment_content</td>";

						// 		$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
      //                           $edit_categories_id = mysqli_query($con,$query);

      //                           while ($row = mysqli_fetch_assoc($edit_categories_id)) {
      //                           $cat_id = $row['cat_id'];
      //                           $cat_title = $row['cat_title'];

						// 		echo "<td>{$cat_title}</td>";

						// }
							
						echo "<td>$comment_email</td>";


						$query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
						$select_post_id_query = mysqli_query($con,$query);
						while ($row = mysqli_fetch_assoc($select_post_id_query)) {

							$post_id = escape($row['post_id']);
							$post_title = escape($row['post_title']);

							echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
						}
						


						echo "<td>$comment_date</td>";
						echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
						echo "</tr>";

						}
	                        ?>
	                        	
	                        </tbody>
	                    </table>

	                  <?php  

	                   if (isset($_GET['delete'])) {
	                   	
	                   	$the_comment_id = escape($_GET['delete']);

	                   	$query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
	                   	$delete_query = mysqli_query($con,$query);
	                   	?>
        <script>
            
            window.top.location = "comments.php";
        </script>
        <?php
	                   	// header("Location: comments.php");

	                   }
	                   ?>