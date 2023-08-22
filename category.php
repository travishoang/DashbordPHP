<?php
include_once '../lib/database.php';
include_once '../helpers/format.php';
?>

<?php
/**
 * 
 */
class category 
{
	private $db;
    private $fm;
	function __construct()
	{
		$this ->db = new Database();
        $this->fm = new Format();
	}

    public function inser_category($catName){
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this ->db ->link, $catName );

        if ( empty( $catName) ){
            $alert = '<span class="error"> Danh Muc Khong Duoc De Trong </span>';
            return $alert;
        }else{
            $query = "INSERT INTO tbl_category(catName) VALUE ('$catName')";
            $result = $this->db->insert($query);
            if($result){
                $alert = '<span class="success"> Them Danh Muc Thanh Cong </span>';
                return $alert;
            }else{
                $alert = '<span class="error"> Them Danh Muc Khong Thanh Cong </span>';
                return $alert;
            } 
        }
        }

    public function show_category(){
        $query = "SELECT * FROM tbl_category order by catId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_category($catName,$id){
        $catName = $this->fm->validation($catName);

        $catName = mysqli_real_escape_string($this ->db ->link, $catName );
        $id = mysqli_real_escape_string($this ->db ->link, $id );


        if ( empty( $catName) ){
            $alert = '<span class="error"> Danh Muc Khong Duoc De Trong </span>';
            return $alert;
        }else{
            $query = "UPDATE tbl_category SET catName = '$catName' WHERE catID = '$id'";
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

    public function delete_category($id){
        $query = "DELETE FROM tbl_category WHERE catID = '$id'";
        $result = $this->db->delete($query);
        if($result){
            $alert = '<span class="success">Xoa Danh Muc Thanh Cong </span>';
            return $alert;
        }else{
            $alert = '<span class="error"> Xoa Danh Muc Khong Thanh Cong </span>';
            return $alert;
        } 

    }

    public function getcatbyId($id){
        $query = "SELECT * FROM tbl_category WHERE catID = '$id'";
        $result = $this->db->select($query);
        return $result;
    }



    }

?>