<?php
    //session_start();

    class Connection
    {
    public $pdo;

        public function __construct()
        {
            $host='localhost';
            $dbname='todo';
            $user='root';
            $password='';

            try
            {
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $_SESSION['connected']=true;
            }catch (PDOException $e){
                $_SESSION['connected']=false;
            }
        }

        public function getTask(){
            $sql = "SELECT * FROM task";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getTaskById($id){
            $sql = "SELECT * FROM task WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        public function setTask($note)
        {
            $sql = "INSERT INTO task (title, description) VALUES (:tit, :desc)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':tit', $note['title']);
            $stmt->bindValue(':desc', $note['description']);
            return $stmt->execute();
        }

        public function updateTask($note){
            $sql = "UPDATE task SET title = :tit, description = :desc WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':tit', $note['title']);
            $stmt->bindValue(':desc', $note['description']);
            $stmt->bindValue(':id', $note['id']);
            return $stmt->execute();
        }

        public function deleteTask($id){
            $sql = "DELETE FROM task WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        }


    }





?>