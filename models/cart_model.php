
<?php
require_once 'C:/xampp/htdocs/onboarding-project/configs/db.php';

class CartModal {
    private $db;
    private $connection;

    public function __construct() {
        try {
            $this->db = new DataBaseConnection();
            $this->connection = $this->db->getConnection();
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    public function addToCart($user_email, $product_id, $quantity, $unit_price) {
        
        $total_price = $quantity * $unit_price;

       
        $sqlCheck = "SELECT quantity FROM cart WHERE user_email = ? AND product_id = ?";
        $stmtCheck = $this->connection->prepare($sqlCheck);
        if ($stmtCheck === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }

        $stmtCheck->bind_param("si", $user_email, $product_id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();
        

        if ($resultCheck->num_rows > 0) {
            $row = $resultCheck->fetch_assoc();
            $new_quantity = $row['quantity'] + $quantity; 
            $new_total_price = $new_quantity * $unit_price;

            $sqlUpdate = "UPDATE cart SET quantity = ?, total_price = ?, updated_at = NOW() 
                           WHERE user_email = ? AND product_id = ?";
            $stmtUpdate = $this->connection->prepare($sqlUpdate);
            if ($stmtUpdate === false) {
                throw new Exception("Error preparing statement: " . $this->connection->error);
            }

            $stmtUpdate->bind_param("idsi", $new_quantity, $new_total_price, $user_email, $product_id);
            if (!$stmtUpdate->execute()) {
                throw new Exception("Error executing statement: " . $stmtUpdate->error);
            }

            $stmtUpdate->close();
        } else {

            $sqlInsert = "INSERT INTO cart (user_email, product_id, quantity, unit_price, total_price) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmtInsert = $this->connection->prepare($sqlInsert);
            if ($stmtInsert === false) {
                throw new Exception("Error preparing statement: " . $this->connection->error);
            }

            $stmtInsert->bind_param("siidd", $user_email, $product_id, $quantity, $unit_price, $total_price);
            if (!$stmtInsert->execute()) {
                throw new Exception("Error executing statement: " . $stmtInsert->error);
            }

            $stmtInsert->close();
        }

        $stmtCheck->close();
        return true;
    }

    public function fetchCartItems($user_email) {
        $sql = "SELECT c.quantity, c.unit_price, c.total_price, p.front_image, p.name, p.category, p.id
                FROM cart c 
                JOIN products p ON c.product_id = p.id
                WHERE c.user_email = ?";
    
        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }
    
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $cartItems = [];
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }
    
        $stmt->close();
        return $cartItems;
    }
    
    
    public function removeFromCart($user_email, $product_id) {
        $sql_check = "SELECT quantity, unit_price FROM cart WHERE user_email = ? AND product_id = ?";
        $stmt_check = $this->connection->prepare($sql_check);
        if ($stmt_check === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }
        
        $stmt_check->bind_param("si", $user_email, $product_id);
        if (!$stmt_check->execute()) {
            throw new Exception("Error executing statement: " . $stmt_check->error);
        }
    
        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();
        $stmt_check->close();
    
        if ($row) {
            $quantity = $row['quantity'];
            $unit_price = $row['unit_price'];
    
            if ($quantity > 1) {
            
                $new_quantity = $quantity - 1;
                $new_total_price = $new_quantity * $unit_price;
                $sql_update = "UPDATE cart SET quantity = ?, total_price = ?, updated_at = NOW() WHERE user_email = ? AND product_id = ?";
                $stmt_update = $this->connection->prepare($sql_update);
                if ($stmt_update === false) {
                    throw new Exception("Error preparing statement: " . $this->connection->error);
                }
    
                $stmt_update->bind_param("idsi", $new_quantity, $new_total_price, $user_email, $product_id);
                if (!$stmt_update->execute()) {
                    throw new Exception("Error executing statement: " . $stmt_update->error);
                }
    
                $stmt_update->close();
            } else {
                $sql_delete = "DELETE FROM cart WHERE user_email = ? AND product_id = ?";
                $stmt_delete = $this->connection->prepare($sql_delete);
                if ($stmt_delete === false) {
                    throw new Exception("Error preparing statement: " . $this->connection->error);
                }
    
                $stmt_delete->bind_param("si", $user_email, $product_id);
                if (!$stmt_delete->execute()) {
                    throw new Exception("Error executing statement: " . $stmt_delete->error);
                }
    
                $stmt_delete->close();
            }
        }
    
        return true;
    }
    

    public function clearCart($user_email) {
        $sql = "DELETE FROM cart WHERE user_email = ?";

        $stmt = $this->connection->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }

        $stmt->bind_param("s", $user_email);

        if (!$stmt->execute()) {
            throw new Exception("Error executing statement: " . $stmt->error);
        }

        $stmt->close();
        return true;
    }
}
?>
