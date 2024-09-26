
<?php
require_once '../../../models/product_model.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productModel = new productModel();

    // Sanitize and retrieve input values
    $name = $_POST['name']?? '';
    $categories = $_POST['categories']?? '';
    $price = $_POST['price']?? '';
    $code = $_POST['code']?? '';
    $description = $_POST['description'] ?? '';
    
    // Directory for uploading images
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/onboarding-project/pages/admin/add_product/photo/';

    // Check if the directory exists, if not, create it
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create directory with full permissions
    }

    // Handle front image upload
    $frontImage = $_FILES['front-image']['name'];
    $frontImagePath = $uploadDir . $frontImage;
    if (move_uploaded_file($_FILES['front-image']['tmp_name'], $frontImagePath)) {
        echo "Front image uploaded successfully: " . $frontImagePath;
    } else {
        echo "Failed to upload front image.";
    }

    // Handle other images upload (if multiple)
    $otherImages = [];
    foreach ($_FILES['other-images']['name'] as $index => $otherImage) {
        $otherImagePath = $uploadDir . $otherImage;
        if (move_uploaded_file($_FILES['other-images']['tmp_name'][$index], $otherImagePath)) {
            $otherImages[] = $otherImage; // Store filenames
        } else {
            echo "Failed to upload other image: " . $otherImage;
        }
    }

    $otherImagesString = implode(',', $otherImages); // Convert array to string for storing in the database

    try {
        // Add new product with image paths
        $productModel->addNewProduct($name, $categories, $price, $code, $description, $frontImage, $otherImagesString, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
        
        // Redirect to the same page after successful product addition
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_add_product.css">
    <title>Admin Panel</title>
</head>
<body>
    <header>
        <div class="logo">
            <a href="../admin.php">MyShop</a>
        </div>
        <div class="header-title">
            <h1>Admin Dashboard</h1>
        </div>
    </header>

    <main>
        
        <section class="product-add-form">
            <form action="" method="post" id="productAdd" class="product-add" enctype="multipart/form-data">
                <div class="product-name">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="product-categories">
                    <label for="categories">Categories:</label>
                    <select id="categories" name="categories" required>
                        <option disabled selected>Select a category</option>
                        <option value="mobile">Mobile</option>
                        <option value="laptop">Laptop</option>
                        <option value="keyboard">Keyboard</option>
                        <option value="mouse">Mouse</option>
                        <option value="headphone">Headphone</option>
                    </select>
                </div>
                <div class="product-price">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required>
                </div>
                <div class="product-code">
                    <label for="code">Product Code:</label>
                    <input type="text" id="code" name="code" required>
                </div>
                <div class="product-description">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required></textarea>
                </div>
                <div class="front-image">
                    <label for="front-image">Front Image:</label>
                    <input type="file" id="front-image" name="front-image" required>
                </div>
                <div class="other-images">
                    <label for="other-images">Other Images:</label>
                    <input type="file" id="other-images" name="other-images[]" multiple required>
                </div>
                <div class="form-group">
                    <button type="submit">Add</button>
                </div>


            </form>
        </section>
    </main>
    <script src="/pages/admin/add_product/script_add_product.js"></script>
</body>
</html>
