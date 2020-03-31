<?php
class User {
    /* Properties */
    private $conn;

    /* Get database access */
    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }

    /* List all users */
    public function get_users() {
     
        $stm = $this->conn->prepare("SELECT username, password FROM users");
        $stm->execute();
        return $data = $stm->fetchAll();
    }


    public function get_user_details() {
     
        $stm = $this->conn->prepare("SELECT * FROM users");
        $stm->execute();
        return $data = $stm->fetchAll();
    }

     public function getUserDropdownDetails() {
     
        $stm = $this->conn->prepare("SELECT username,id FROM users WHERE id!=1");
        $stm->execute();
        return $data = $stm->fetchAll();
    }

    public function check_login_details($email,$password) {
    $stm = $this->conn->prepare("SELECT id FROM users WHERE email=:email AND password=:password ");
    $stm->execute(['email'=>$email,'password'=>$password]);
    return $data = $stm->fetchAll();
    }

    public function save_user_details($username,$password,$mobile,$email,$address) {
    $stm = $this->conn->prepare("INSERT INTO users (username,password,mobile,email,address) VALUES ( :username, :password, :mobile, :email, :address)");
    $data=$stm->execute([':username'=>$username,':password'=>$password,':mobile'=>$mobile,':email'=>$email,':address'=>$address]);
    return $data;
    }
     
     public function save_logistics_details($user_id,$unitcost,$quantity,$total) {
    $stm = $this->conn->prepare("INSERT INTO logistics_details (user_id,unitcost,qunatity,total_amount) VALUES ( :user_id, :unitcost, :quantity, :total_amount)");
    $data=$stm->execute([':user_id'=>$user_id,':unitcost'=>$unitcost,':quantity'=>$quantity,':total_amount'=>$total]);
    return $data;
    }


 public function save_update_logistics_details($user_id,$unitcost,$quantity,$total,$id) {
    $stm = $this->conn->prepare("UPDATE logistics_details SET user_id = :user_id,unitcost = :unitcost,qunatity = :qunatity,total_amount = :total_amount WHERE id = :id");
    $data=$stm->execute([':user_id'=>$user_id,':unitcost'=>$unitcost,':qunatity'=>$quantity,':total_amount'=>$total,':id'=>$id]);
    return $data;
    }

    public function get_logistics_info_details($user_id) {
    $stm = $this->conn->prepare("SELECT ld.*,u.username,u.is_allowed FROM logistics_details AS ld LEFT JOIN users AS u ON ld.user_id=u.id WHERE ld.user_id=$user_id");
    $stm->execute();
    return $data = $stm->fetchAll();
    }

    public function get_all_logistics_info_details() {
    $stm = $this->conn->prepare("SELECT ld.*,u.username,u.is_allowed FROM logistics_details AS ld LEFT JOIN users AS u ON ld.user_id=u.id");
    $stm->execute();
    return $data = $stm->fetchAll();
    }


    public function get_logistics_info_based_on_id($id) {
    $stm = $this->conn->prepare("SELECT ld.*,u.username,u.is_allowed FROM logistics_details AS ld LEFT JOIN users AS u ON ld.user_id=u.id WHERE ld.id=$id");
    $stm->execute();
    return $data = $stm->fetchAll();
    }

   

     public function update_allow_status($id,$is_allowed) {
    $stm = $this->conn->prepare("UPDATE users SET is_allowed = :is_allowed WHERE id = :id");
    $data=$stm->execute([':is_allowed'=>$is_allowed,':id'=>$id]);
    return $data;
    }

    public function delete_logistics_details($id) {
    $stm = $this->conn->prepare("DELETE FROM logistics_details WHERE id = :id");
    $data=$stm->execute([':id'=>$id]);
    return $data;
    }
    
}

?>