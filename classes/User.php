<?php 
class User {
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $password;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register()
    {
        $query = "INSERT INTO ".$this->table." (name, email, password) values(:name, :email, :password)";

        $stm = $this->conn->prepare($query);

        $this->password = password_hash($this->password, PASSWORD_BCRYPT);

        $stm->bindParam(":name", $this->name);
        $stm->bindParam(":email", $this->email);
        $stm->bindParam(":password", $this->password);
        return $stm->execute();
    }


    public function login()
    {
        $query = "SELECT * FROM ".$this->table." WHERE email = :email LIMIT 1";

        $stm = $this->conn->prepare($query);
        $stm->bindParam(":email", $this->email);
        $stm->execute();

        if($stm->rowCount() > 0) {
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if(password_verify($this->password, $row['password'])){
                $this->id = $row['id'];
                $this->name = $row['name'];
                return true;
            }
        }
        return false;


    }
}