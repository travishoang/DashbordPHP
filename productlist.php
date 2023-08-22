<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
			<?php
			if(isset($delProduct)){
				echo $delProduct;
			}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Giá sản phẩm</th>
					<th>Danh mục</th>
					<th>Thương hiệu</th>
					<th>Hình ảnh</th>
					<th>Hoạt động</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$pd = new product();
				if(isset($_GET['productid'])){
					$id = $_GET['productid'];
					$delProduct = $pd->delete_product($id);
				}

				$productlist = $pd->show_product();
				if($productlist){
					$i=0;
					while($result = $productlist->fetch_assoc()){
						$i++;
	
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName'] ?></td>
					<td><?php echo $result['price'] ?></td>
					<td><?php echo $result['catName'] ?></td>
					<td><?php echo $result['brandName'] ?></td>
					<td><img src="uploads/<?php echo $result['image']?>" width="80" ></td>
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không?')" href="?productid=<?php echo $result['productId'] ?>">Delete</a></td>
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
