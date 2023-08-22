<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';
?>

<?php
/**
 * 
 */
class product  {
	private $db;
    private $fm;
	function __construct()
	{
		$this ->db = new Database();
        $this->fm = new Format();
	}

    public function inser_product($data,$files){
        $productName = mysqli_real_escape_string($this ->db ->link,$data['productName']);
        $brand = mysqli_real_escape_string($this ->db ->link,$data['brand']);
        $category = mysqli_real_escape_string($this ->db ->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this ->db ->link,$data['product_desc']);
        $price = mysqli_real_escape_string($this ->db ->link,$data['price']);
        $type = mysqli_real_escape_string($this ->db ->link, $data['type']);
       
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;

        if ( $productName == ""|| $brand == ""||$category == ""||$product_desc == ""||$type == ""||$price == ""|| $file_name== ""){
            $alert = '<span class="error"> Các trường không được rỗng </span>';
            return $alert;
        }else{
            move_uploaded_file($file_temp,$uploaded_image);
            $query = "INSERT INTO tbl_product(productName, brandid, catId, product_desc,type, price,image) VALUE ('$productName','$brand','$category','$product_desc','$type','$price','$unique_image')";
            $result = $this->db->insert($query);
            if($result){
                $alert = '<span class="success"> Thêm sản phẩm thành công </span>';
                return $alert;
            }else{
                $alert = '<span class="error"> Thêm sản phẩm không thành công </span>';
                return $alert;
            } 
        }
        }

    public function show_product (){
        $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
        FROM tbl_product  INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catID 
        INNER JOIN tbl_brand ON tbl_product.brandid = tbl_brand.brandId
        order by tbl_product.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_product($data,$files,$id){
        $productName = mysqli_real_escape_string($this ->db ->link,$data['productName']);
        $brand = mysqli_real_escape_string($this ->db ->link,$data['brand']);
        $category = mysqli_real_escape_string($this ->db ->link, $data['category']);
        $product_desc = mysqli_real_escape_string($this ->db ->link,$data['product_desc']);
        $price = mysqli_real_escape_string($this ->db ->link,$data['price']);
        $type = mysqli_real_escape_string($this ->db ->link, $data['type']);
       
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;
        if ( $productName == ""|| $brand == ""||$category == ""||$product_desc == ""||$price == ""||$type == ""){
            $alert = '<span class="error"> Các trường không được rỗng </span>';
            return $alert;
        }else{

            if(!empty($file_name)){
                if ($file_size >20480) {
                    echo "<span class='error'>Image Size should be less then 2MB! </span>";
                }

                elseif (in_array($file_ext, $permited)== false){
                echo "<span class='error'>You can upload only:-" .implode(',', $permited)."</span>";
                }
                $query = "UPDATE tbl_product SET
                productName = '$productName',
                brandid = '$brand',
                catId = '$category',
                product_desc = '$product_desc',
                price = '$price',
                type = '$type',
                image = '$unique_image'
                WHERE productId = '$id'";
            }else{   
                $query = "UPDATE tbl_product 
                SET productName = '$productName', brandid = '$brand', catId = '$category', product_desc = '$product_desc', price = '$price', type = '$type'
                WHERE productId = '$id'";
            }
            $result = $this->db->update($query);
            if($result){
                $alert = '<span class="success">Sửa sản phẩm thành công </span>';
                return $alert;
            }else{
                $alert = '<span class="error"> Sửa sản phẩm không thành công </span>';
                return $alert;
            } 
        }

    }

    public function delete_product($id){
        $query = "DELETE FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = '<span class="success">Xoa Danh Muc Thanh Cong </span>';
            return $alert;
        }else{
            $alert = '<span class="error"> Xoa Danh Muc Khong Thanh Cong </span>';
            return $alert;
        } 

    }

    public function getproductbyId($id){
        $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }



    }

?>