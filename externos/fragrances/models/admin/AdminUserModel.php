<?php

class AdminUserModel extends Driver{

    public function getUsers(){ // $sql = literally the request
        $sql ="SELECT * FROM users u
            ORDER BY u.id DESC";

        $result = $this->getRequest($sql); // getting the db ready with $sql

        $rows = $result->fetchAll(PDO::FETCH_OBJ); // excecute the request & keeping the data
        $tabUser = [];

        foreach($rows as $row){
            $user = new Users();
            $user->setId($row->id);
            $user->setLogin($row->login);
            $user->setName($row->name);
            $user->setEmail($row->email);
            $user->setPassword($row->password);
            $user->setStatus($row->status);
            array_push($tabUser,$user);
        }
            return $tabUser;
    }

    public function updateStatus(Users $user){

        $sql = "UPDATE users
                SET status=:status
                WHERE id=:id";
        $result = $this->getRequest($sql, ['status'=>$user->getStatus(), 'id'=>$user->getId()]);

        return $result->rowCount();
        
    }

    public function signIn($loginEmail, $pass){

        $sql = "SELECT * FROM users 
                WHERE (login = :logEmail OR email =:logEmail ) AND password = :pass";
        $result = $this->getRequest($sql, ['logEmail'=>$loginEmail, 'pass'=>$pass]);

        $row = $result->fetch(PDO::FETCH_OBJ);

        return $row;
    }

    public function register(Users $user){

        $sql = "SELECT * FROM users
                WHERE email=:email ";
        $result = $this->getRequest($sql, ['email'=>$user->getEmail()]);

        if($result->rowCount() == 0){

            $req = "INSERT INTO users(login, name, email, password, status)
                    VALUES(:login, :name, :email, :password, :status)";

            $tabUsers = [
                'login'=>$user->getLogin(),
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>$user->getPassword(),
                'status'=>$user->getStatus()
            ];

            $res = $this->getRequest($req, $tabUsers);
            return $res;
        }else{
            return "Cet user existe déjà";
        }
    }

    public function userFinder(Users $user){
        $sql = "SELECT * FROM users
                WHERE id = :id";
        $result = $this->getRequest($sql, ['id'=>$user->getId()]);
        
        if($result->rowCount() > 0){

            $userRow = $result->fetch(PDO::FETCH_OBJ);
            $newUser = new Users();
            $newUser->setId($userRow->id);
            $newUser->setLogin($userRow->login);
            $newUser->setName($userRow->name);
            $newUser->setEmail($userRow->email);
            $newUser->setPassword($userRow->password);
            $newUser->setStatus($userRow->status);
    
            return $newUser;
        }

    }

    public function updateUser(Users $user){

        $sql = "UPDATE users
                SET login = :login,
                    name = :name,
                    email = :email,
                    password = :password,
                    status = status
                    
                    WHERE id = :id";

        $tabUsers = [
            'id'=>$user->getId(),
            'login'=>$user->getLogin(),
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'password'=>$user->getPassword(),
            'status'=>$user->getStatus()
        ];

        $result = $this->getRequest($sql, $tabUsers);

        return $result->rowCount();
    }
}