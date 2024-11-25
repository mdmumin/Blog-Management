<?php include "inc/header.php" ?>
<?php include "inc/sidebar.php" ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">
        <?php 
        if (!isset($_GET['deletpost']) || $_GET['deletpost'] == NULL) {
           echo "<script>window.location = 'postlist.php';'</script>";
        }else {
            $deletid    = $_GET['deletpost'];
            $deletquery = "select * from tbl_post where id='$deletid'";
            $deletedata = $db->delete($deletquery);
            if ($deletedata) {
                while ($delimg = $deletedata->fetch_assoc()) {
                    $dellink = $delimg['image'];
                    unlink($dellink);
                }
            }
            $delquery = "delete from tbl_post where id ='$deletid'";
            $deldata = $db->delete($delquery);
            if($deldata){
                echo "<span class='success'>Post data delete successfully.</span>";
                //echo "<script>alert('Post data delete successfully.');</script>";
            }else {
                echo "<span class='error'>Post data Not deleted !</span>";
                //echo "<script>alert('Post data Not deleted !');</script>";
            }
        }
        ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="5%">No.</th>
                        <th width="15%">Post Title</th>
                        <th width="23%">Description</th>
                        <th style="text-align: center;" width="10%">category</th>
                        <th width="10%">Image</th>
                        <th width="10%">Author</th>
                        <th width="7%">Tags</th>
                        <th width="10%">Date</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "select tbl_post.*, tbl_category.name from tbl_post 
                        inner join tbl_category 
                        on tbl_post.cat = tbl_category.id 
                        order by tbl_post.title desc";
                        $post = $db->select($query);
                        if ($post) {
                            $count=0;
                            while ($result = $post->fetch_assoc()) {
                                $count++;

                                
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $count; ?></td>
                        <td> <a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></td>
                        <td><?php echo $fm->textShorten($result['body'], 80); ?></td>
                        <td style="text-align: center;" ><a href="editpost.php?editpostid=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></td>
                        <td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" alt=""></td>
                        <td><?php echo $result['author']; ?></td>
                        <td><?php echo $result['tags']; ?></td>
                        <td><?php echo $fm->formatDate($result['date']); ?></td>
                        <td>
                            <a href="editpost.php?editpostid=<?php echo $result['id']; ?>">Edit</a> || 
                            <a onclick="return confirm('Are you sure to Delete');"
                            href="?deletpost=<?php echo $result['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    setupLeftMenu();
    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include "inc/footer.php" ?>