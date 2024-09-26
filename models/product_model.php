<?php
require_once 'C:/xampp/htdocs/onboarding-project/configs/db.php';

class productModel {
    private $db;
    private $connection;

    public function __construct() {
        try {
            $this->db = new DatabaseConnection();
            $this->connection = $this->db->getConnection();
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

   
    public function addNewProduct($name, $category, $price, $proCode, $description, $front_image, $other_images, $created_at, $updated_at) {
        $sql = "INSERT INTO products (name, category, price, proCode, description, front_image, other_images, created_at, updated_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }

        $stmt->bind_param("ssdssssss", $name, $category, $price, $proCode, $description, $front_image, $other_images, $created_at, $updated_at);

        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        $stmt->close();

        return true;
    }

    // Fetch all products from the database
    public function fetchProductDetails() {
        $sql = "SELECT * FROM products";
        $result = $this->connection->query($sql);

        if ($result === false) {
            throw new Exception("Error executing query: " . $this->connection->error);
        }

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }
    public function fetchProductById($product_id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }
    
        $stmt->bind_param("i", $product_id);

        $stmt->execute();

        $result = $stmt->get_result();
    
        $product = $result->fetch_assoc();
    
        $stmt->close();
    
        return $product;
    }
    public function deleteProductById($product_id) {
       
        $sql = "DELETE FROM products WHERE id = ?"; 
        $stmt = $this->connection->prepare($sql);
    
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }
    
        $stmt->bind_param("i", $product_id); 
    
        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }
        $stmt->close();
    }
    public function updateProduct($id, $name, $category, $price, $proCode, $description, $front_image, $other_images, $updated_at) {

        $sql = "UPDATE products 
                SET name = ?, category = ?, price = ?, proCode = ?, description = ?, front_image = ?, other_images = ?, updated_at = ? 
                WHERE id = ?";
    
        $stmt = $this->connection->prepare($sql);
    
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }

        $stmt->bind_param("ssdsssssi", $name, $category, $price, $proCode, $description, $front_image, $other_images, $updated_at, $id);
    
        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        $stmt->close();
        return true; 
    }
}
?>
