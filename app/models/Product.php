<?php

class Product
{
    private $tableName = "products";
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProduct()
    {
        $this->db->query("SELECT * FROM $this->tableName");
        return $this->db->fetchAllResult();
    }

    public function getProductById(int $id)
    {
        $this->db->query("SELECT * FROM $this->tableName WHERE id=:origin_id");
        $this->db->bind("origin_id", $id);
        return $this->db->single();
    }

    public function byCategory(string $category)
    {
        $this->db->query("SELECT * FROM $this->tableName WHERE category = :ori_category");
        $this->db->bind('ori_category', $category);

        return $this->db->fetchAllResult();
    }
}
