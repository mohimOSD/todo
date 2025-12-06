<?php 

class Todo {
    private $conn;
    private $table = 'todos';

    public $id;
    public $user_id;
    public $task;
    public $status;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create()
    {
        $query = "INSERT INTO ".$this->table." (user_id, task) values(:user_id, :task )";

        $stm = $this->conn->prepare($query);

        $stm->bindParam(":user_id", $this->user_id);
        $stm->bindParam(":task", $this->task);
        return $stm->execute();
    }


    public function readAll()
    {
        $query = "SELECT * FROM ".$this->table." WHERE user_id = :user_id ORDER BY id desc";

        $stm = $this->conn->prepare($query);

        $stm->bindParam(":user_id", $this->user_id);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function read()
    {
        $query = "SELECT * FROM ".$this->table." WHERE user_id = :user_id and id = :id ORDER BY id desc";

        $stm = $this->conn->prepare($query);

        $stm->bindParam(":id", $this->id);
        $stm->bindParam(":user_id", $this->user_id);
        $stm->execute();

        return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function update()
    {
        $query = "UPDATE ".$this->table." set task=:task, status=:status where id=:id and user_id=:user_id";

        $stm = $this->conn->prepare($query);

        $stm->bindParam(":id", $this->id);
        $stm->bindParam(":task", $this->task);
        $stm->bindParam(":user_id", $this->user_id);
        $stm->bindParam(":status", $this->status);
        return $stm->execute();
    }




    public function delete()
    {
        $query = "DELETE FROM ".$this->table." WHERE id = :id AND user_id = :user_id";

        $stm = $this->conn->prepare($query);

        $stm->bindParam(":id", $this->id);
        $stm->bindParam(":user_id", $this->user_id);
        $stm->execute();

        return $stm;
    }

}