<?php
class Users
{
    private $tableName = "users";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function check($username_or_email, $password)
    {
        if (str_contains($username_or_email, "@")) {
            $this->db->query("SELECT * FROM $this->tableName WHERE email = :origin_email AND password = :origin_password");
            $this->db->bind("origin_email", $username_or_email);
        } else {
            $this->db->query("SELECT * FROM $this->tableName WHERE username = :origin_username AND password = :origin_password");
            $this->db->bind("origin_username", $username_or_email);
        }
        $this->db->bind("origin_password", md5($password));
        return $this->db->single();
    }

    public function checkEmailOrUsername($username_or_email)
    {
        if (str_contains($username_or_email, "@")) {
            $this->db->query("SELECT * FROM $this->tableName WHERE email = :origin_email");
            $this->db->bind("origin_email", $username_or_email);
        } else {
            $this->db->query("SELECT * FROM $this->tableName WHERE username = :origin_username");
            $this->db->bind("origin_username", $username_or_email);
        }
        return $this->db->single();
    }

    public function addUser($user = ["name" => "", "username" => "", "email" => "", "password" => ""])
    {
        if (!empty($user["name"])) {
            // $this->db->query("INSERT INTO $this->tableName (name, username, email, password) VALUES ('" . $user['name'] . "', '" . $user['username'] . "', '" . $user['email'] . "', '" . $pw . "');");
            $this->db->query("INSERT INTO $this->tableName (name, username, email, password) VALUES (:ori_name, :ori_username, :ori_email, :ori_password)");
            $this->db->bind("ori_name", $user["name"]);
            $this->db->bind("ori_username", $user["username"]);
            $this->db->bind("ori_email", $user["email"]);
            $this->db->bind("ori_password", md5($user["password"]));

            return $this->db->execute();
        }
    }

    public function getUsers()
    {
        $this->db->query("SELECT * FROM $this->tableName");
        return $this->db->fetchAllResult();
    }
}
