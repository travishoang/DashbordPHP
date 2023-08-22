<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';
?>

<?php
/**
 * 
 */
class brand 
{
	private $db;
    private $fm;
	function __construct()
	{
		$this ->db = new Database();
        $this->fm = new Format();
	}

    public function inser_brand($brandName){
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this ->db ->link, $brandName );

        if ( empty( $brandName) ){
            $alert = '<span class="error"> Danh Muc Khong Duoc De Trong </span>';
            return $alert;
        }else{
            $query = "INSERT INTO tbl_brand(brandName) VALUE ('$brandName')";
            $result = $this->db->insert($query);
            if($result){
                $alert = '<span class="success"> Thêm Thương hiệu thành công </span>';
                return $alert;
            }else{
                $alert = '<span class="error"> Thêm thương hiệu không thành công </span>';
                return $alert;
            } 
        }
        }

    public function show_brand (){
        $query = "SELECT * FROM tbl_brand order by brandId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_brand($brandName,$id){
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this ->db ->link, $brandName );
        $id = mysqli_real_escape_string($this ->db ->link, $id );


        if ( empty( $brandName) ){
            $alert = '<span class="error"> Danh Muc Khong Duoc De Trong </span>';
            return $alert;
        }else{
            $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
            $result = $this->db->update($query);
            if($result){
                $alert = '<span class="success">Sua Danh Muc Thanh Cong </span>';
                return $alert;
            }else{
                $alert = '<span class="error"> Sua Danh Muc Khong Thanh Cong </span>';
                return $alert;
            } 
        }

    }

    public function delete_brand($id){
        $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = '<span class="success">Xoa Danh Muc Thanh Cong </span>';
            return $alert;
        }else{
            $alert = '<span class="error"> Xoa Danh Muc Khong Thanh Cong </span>';
            return $alert;
        } 

    }

    public function getbrandbyId($id){
        $query = "SELECT * FROM tbl_brand WHERE brandId= '$id'";
        $result = $this->db->select($query);
        return $result;
    }



    }

?>