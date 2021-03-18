<?php


namespace app;

use \PDO;
use app\models\Product;

class Database
{
    public PDO $pdo;
    public static Database $db;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=products", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }

    public function getProducts($search = "")
    {
        if ($search) {
            $statement = $this->pdo->prepare("SELECT * FROM PRODUCT WHERE title LIKE :title ORDER BY create_date DESC");
            $statement->bindValue(":title", "%$search%");
        } else {
            $statement = $this->pdo->prepare("SELECT * FROM PRODUCT ORDER BY create_date DESC;");
        }

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM product WHERE id=:id");
        $statement->bindValue("id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct(Product $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO product(title,image,description, price, create_date) 
        VALUES (:title, :image, :description, :price, :date);");
        $statement->bindValue("title", $product->title);
        $statement->bindValue("image", $product->imagePath);
        $statement->bindValue("description", $product->description);
        $statement->bindValue("price", $product->price);
        $statement->bindValue("date", date("Y-m-d H:i:s"));
        $statement->execute();
    }

    public function deleteProduct($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM product WHERE id=:id");
        $statement->bindValue("id", $id);
        $statement->execute();
    }

    public function updateProduct(Product $product)
    {
        $statement = $this->pdo->prepare("UPDATE product SET title=:title, description=:description, image=:image, price=:price WHERE id=:id");
        $statement->bindValue("title", $product->title);
        $statement->bindValue("image", $product->imagePath);
        $statement->bindValue("description", $product->description);
        $statement->bindValue("price", $product->price);
        $statement->bindValue("id", $product->id);
        $statement->execute();
    }
}