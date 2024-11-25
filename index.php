
<!-- header section -->
<?php include 'inc/header.php'; ?>

<!-- slider section -->
<?php include 'inc/slider.php'; ?>

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
		<!-- Start pagination -->
	    <?php 
		$per_page = 3;
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		}else{
			$page=1;
		}
		$start_form = ($page-1) * $per_page;
		?>
		<!-- End pagination -->
        <?php
			$query = "select * from tbl_post limit $start_form, $per_page";
			$post = $db->select($query);
			if ($post) {
				while($result = $post->fetch_assoc()){				
		?>
        <div class="samepost clear">
            <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
            <h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h4>
            <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image" /></a>
            <p>
			<?php echo $fm->textShorten($result['body']); ?>
            </p>
            <div class="readmore clear">
                <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
            </div>
        </div>

        <?php
		  	
		}  ?> <!-- end while loop -->
		<!-- Start pagination -->
		<?php
		$query = "select * from tbl_post";
		$result =  $db->select($query);
		$total_row = mysqli_num_rows($result);
		$total_page = ceil($total_row/$per_page);

		echo "<span class='pagination'><a href='index.php?page=1'>".'First page'."</a>";

		for ($i=1; $i <= $total_page ; $i++) {
			echo "<a href='index.php?page=".$i."'>".$i."</a>";
		}
		echo "<a href='index.php?page=$total_page'>".'Last page'."</a></span>";
		 
		?>
		<!-- End pagination -->
		<?php 	} else{
				header("location:404.php");
			}
		?>
    </div>

    <!-- sidebar section -->
    <?php include 'inc/sidebar.php'; ?>
</div>

<!--Start Footer section -->
<?php include 'inc/footer.php'; ?>
<!--End Footer section -->

<style>
	.pagination{
display: block;
font-size: 20px;
margin-top: 10px;
text-align: center;
}
.pagination a{
background-color: #5cc6de none repeat scroll 0 0;
border: 1px solid #a584f3;
border-radius: 3px;
color: #333;
margin-left: 2px;
padding: 2px 10px;
text-decoration: none;
}
.pagination a:hover{
background: #b7f383 none repeat scroll 0 0;
/* color: #fff; */
}
</style>