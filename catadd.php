<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php'; ?>
<?php
	$pd = new product;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $catName = $_POST['catName'];

        $inserCat = $cat->inser_prodyct($catName);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục mới</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($inserCat)){
                    echo $inserCat;
                }
                ?>
                 <form action="catadd.php" method="post" >
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" placeholder="Nhap Danh Muc San Pham" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>