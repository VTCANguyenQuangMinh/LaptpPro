﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php
  $cat= new category();
  if(!isset($_GET['delid']) || $_GET['delid'] == NULL){
	// echo "<script> window.location = 'catlist.php' </script>";
	
}else {
	$id = $_GET['delid']; // Lấy catid trên host
	$delCat = $cat -> del_category($id); // hàm check delete Name khi submit lên
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách loại CPU</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Loại CPU</th>
							<th>Xử lý</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$show_cate = $cat->show_category();
					if($show_cate){
						$i=0;
						while($result=$show_cate->fetch_assoc()){
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId']; ?>">Edit</a> || <a onclick = "return confirm('Are you want to delete???')" href="?delid=<?php echo $result['catId']; ?>">Delete</a></td>
						</tr>
					<?php
						}
					}
					?>	
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

