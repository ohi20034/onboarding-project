<?php

require_once 'C:/xampp/htdocs/onboarding-project/configs/db.php';

class UserModel{
    private $db;
    private $connection;

    public function __construct(){
        try{
            $this->db = new DatabaseConnection();
            $this->connection = $this->db->getConnection();
            
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
    }

    
    
    public function createUser($gender, $firstName, $lastName, $email, $streetAddress, $zipCode, $city, $country, $state, $telephone, $password) {
        $sql = "INSERT INTO users (gender, first_name, last_name, email, street_address, zip_code, city, country, state_province, telephone_number, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($sql);
        
        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error . " SQL: " . $sql);
        }
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        if (!$stmt->bind_param("sssssssssss", $gender, $firstName, $lastName, $email, $streetAddress, $zipCode, $city, $country, $state, $telephone, $hashedPassword)) {
            throw new Exception("Error binding parameters: " . $stmt->error);
        }
        
        if (!$stmt->execute()) {
            $error = $stmt->error;
            $stmt->close();
            throw new Exception("Error executing statement: " . $error);
        }
    
        $stmt->close();
        return true;
    }

    public function loginUser($email, $password) {

        $sql = "SELECT * FROM users WHERE email= ?";

        $statement = $this->connection->prepare($sql);
        $isSuccess = 0;
    
        // Prepare the statement
        
        if ($statement = $this->connection->prepare($sql)) {
            // Bind the parameter
            $statement->bind_param('s', $email);
            
            // Execute the statement
            $statement->execute();
            
            // Get the result
            $result = $statement->get_result();
            
            // Fetch the user (since email should be unique, there should be at most 1 row)
            if ($row = $result->fetch_assoc()) {
                // Verify the password
                $hashedPassword = $row["password"];
                if (password_verify($password, $hashedPassword)) {
                    return true; // Success
                } else {
                    return "Invalid password";
                }
            } else {
                return "Invalid email";
            }
        } else {
            return "Database query failed";
        }
    }
    public function getUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email = ?";

        $stmt = $this->connection->prepare($sql);

        if ($stmt === false) {
            throw new Exception("Error preparing statement: " . $this->connection->error);
        }
        if (!$stmt->bind_param("s", $email)) {
            throw new Exception("Error binding parameters: " . $stmt->error);
        }
    
        if (!$stmt->execute()) {
            $error = $stmt->error;
            $stmt->close();
            throw new Exception("Error executing statement: " . $error);
        }
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc(); // Fetch user data

        $stmt->close();

        return $userData; // Return user data or null if not found
    }

}

?>
