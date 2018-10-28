<?php include 'includes/db.php';?>
<?php include 'includes/header.php';?>

<button onclick="topFunction()" id="myBtn" title="Go to top" >Move to Top</button>
<div id="divBoxed" class="container">

    <div class="main_center_div" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

    <div class=" row-fluid  notop nobottom div_style">
            <!--title bar-->
			<div class="row-fluid   ">
                <div class="span12">

                    <div id="divLogo" class="pull-left">
                        <a href="index.php" id="divSiteTitle" style=" color:#E0E0E0 ; font-size:38px ;">DEALS <b style=" color:#54A4DE ; ">IN</b> PAKISTAN </a>
						<span  id="divSiteTitle" style=" color:#E0E0E0; " >|</span>
                        <span id="divTagLine" style=" color:#E0E0E0; padding-left:0px">HotDeals / Discounts / Sale in Rawalpindi, Islamabad</span>
                    </div>
				</div>	
			</div>
			<!--menu bar or Navigation-->
			
<?php include 'includes/navigation.php'; ?>


           
    </div>

<div class="contentArea">

  <div class="divPanel notop page-content div_stylepanale2">
            

  <div class="row-fluid">
			<!--Edit Ads Content Area here-->
         <div class="span8" id="divMain">  

         	<?php

         	if (isset($_GET['p_id'])) {
         		
         		$the_post_id = escape($_GET['p_id']);
         		$the_post_author = escape($_GET['author']);
         	}

            $per_page = 5;

            if (isset($_GET['page'])) {

                $page = escape($_GET['page']);
        
            } else {
                
                $page = "";
            }

            if ($page == "" || $page == 1) {
                
                $page_1 = 0;

            } else {
                
                $page_1 = ($page * $per_page) - $per_page; //if on page 2, 2*5=10, 10-5=5 , nxt 5 posts
            }

            //spearate post for admin and users
            if (isset($_SESSION['user_role']) && $_SESSION['user_role']== 'admin') {
    
                $post_query_count = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' ";                
               
            }else {

            $post_query_count = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' && post_status = 'published' ";
          
            }

            $find_count = mysqli_query($con,$post_query_count);
            $count = mysqli_num_rows($find_count);

            if ($count < 1) {

                // if post_status == 'published'
                echo '<center><h1>No posts available</h1></center>';
                
            }else {
                

            $count = ceil($count / $per_page);  //ceil for upr round loating point


           	$query = "SELECT * FROM posts WHERE post_user = '{$the_post_author}' ORDER BY post_id DESC LIMIT $page_1,$per_page";

         	$select_all_posts_query = mysqli_query($con,$query);

         	while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
         		
         		$post_title = escape($row['post_title']);
         		// $post_author = $row['post_author'];
                $post_author = escape($row['post_user']);
         		$post_user = escape($row['post_user']);
         		$post_image = escape($row['post_image']);
         		$post_content = $row['post_content'];
         		// $post_address= $row['post_address'];
         		// $post_contact_number = $row['post_contact_number'];
         		// $post_website = $row['post_website'];
         		// $post_facebook = $row['post_facebook'];
         		// $post_twitter = $row['post_twitter'];
         		$post_tags = escape($row['post_tags']);

         		?>


         	<div class="row-fluid">		
		        <div class="span2"> 
                <a href="post.php?p_id=<?php echo $post_id; ?>">                         
                    <img class="img-responsive img-polaroid" src="images/<?php echo $post_image ?>"   style="margin:5px 0px 15px"; alt="image"> 
                </a> 
                </div>

                <div class="span10">            
                    <h3 style="color:#206BA4;">
                        <a class="post_heading" style="color:#206BA4;font-size: 26px" href="post.php?p_id=<?php echo $post_id; ?> "><?php echo $post_title ?></a>
                    </h3>
					<div class="btn-group btn-breadcrumb">
            <a href="#" class="btn btn-primary disabled btn-lg">All Post</a>

            <div class="btn btn-default visible-xs-block hidden-xs visible-sm-block ">...</div>
            <a href="#" class="btn btn-default disabled " style="color: #2475AE">by </a>
            <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>" class="btn btn-default " style="font-weight: bold;"> <?php echo $post_author ?></a>
            <a href="#" class="btn btn-default disabled visible-lg-block visible-md-block" style="color: #2475AE">in </a>
            <a href="#" class="btn btn-default visible-lg-block visible-md-block" style="font-weight: bold;"> <?php echo $post_tags ?></a>,
           <!-- <a href="#" class="btn btn-default visible-lg-block visible-md-block " style="font-weight: bold;">Ramadan Deals</a> -->
             <a href="#" class="btn btn-warning  btn-comment"><i class="fa fa-comment" style="font-size: 17px;"></i></a>   
        </div>
                </div>		 
            </div>
			<div class="row-fluid">
				<div class="span2">
				</div>
				<div class="span10 ">  
                <a href="post.php?p_id=<?php echo $post_id; ?>">                         
                    <img src="images/<?php echo $post_image ?>"  alt="image" class="img-fluid image_style"> 
                </a>  
                </div>          
			</div>
			
			<div class="row-fluid">
				<div class="span12" style=" text-align:center;"><?php echo $post_content ?></div> 
			</div>
			
			<br>
			

         <?php } }?>
         	
			
			
			<!-- Blog Comments -->

            <?php 

            if (isset($_POST['create_comment'])) {

                $the_post_id = escape($_GET['p_id']);
               $comment_author  = escape(trim($_POST['comment_author']));
               $comment_email   = escape($_POST['comment_email']);
               $comment_content = escape(trim($_POST['comment_content']));

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                   

               $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

               $query .= "VALUES ($the_post_id ,'{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

               $create_comment_query = mysqli_query($con,$query);

               if (!$create_comment_query) {
                die("QUERY FAILED.".mysqli_error($con));
               }


                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                $query .= "WHERE post_id = $the_post_id ";
                $update_comment_count = mysqli_query($con,$query);


            }else{

                echo "<script>alert('Comments fields cannot be empty')</script>";
            }

                }
                
             
            ?>
             
			
			<hr>
			<!--start pagination here-->
            <div class="row-fluid">
            <div class="span2"></div>
             <div class="span8 pagination">
            <ul>
                <?php 

                for($i=1; $i <= $count; $i++){

                if ($i == $page) {
                    echo "<li '><a class='number current' href='author_posts.php?author=$post_author&p_id=$the_post_id&page={$i}'>{$i}</a></li>";
                } else {
                    echo "<li><a href='author_posts.php?author=$post_author&p_id=$the_post_id&page={$i}'>{$i}</a></li>";             
                }

                    
                }
                ?>
            </ul>
            </div>
            </div> <!-- End .pagination -->
				<div class="clear"></div>
			 			 
                </div>
				<!--End Ads Content Area here-->
				
				<!--Edit Sidebar Categories, TAgs....Content here-->
            <?php include 'includes/sidebar.php';?>
				<!--End Sidebar Categories, TAgs....Content here-->
            </div>

            <div id="footerInnerSeparator"></div>
        </div>
    </div>
	
	<!-- footer start -->
	<?php include 'includes/footer.php';?>