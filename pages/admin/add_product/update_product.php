<?php
require_once '../../../models/product_model.php';

if (!isset($_GET['id'])) {
    echo "Product ID is missing.";
    exit();
}
$id = $_GET['id'];

try {
    $productModel = new productModel();
    $product = $productModel->fetchProductById($id);
    if (!$product) {
        echo "Product not found.";
        exit();
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'] ?? '';
    $categories = $_POST['categories'] ?? '';
    $price = $_POST['price'] ?? '';
    $code = $_POST['code'] ?? '';
    $description = $_POST['description'] ?? '';

    $uploadDir = __DIR__ . '/photo/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!empty($_FILES['front-image']['name'])) {
        $frontImage = $_FILES['front-image']['name'];
        move_uploaded_file($_FILES['front-image']['tmp_name'], $uploadDir . $frontImage);
    } else {
        $frontImage = $_POST['existing_front_image'];
    }
    $otherImages = [];
    if (!empty($_FILES['other-images']['name'][0])) {
        foreach ($_FILES['other-images']['tmp_name'] as $key => $tmp_name) {
            $otherImageName = $_FILES['other-images']['name'][$key];
            move_uploaded_file($tmp_name, $uploadDir . $otherImageName);
            $otherImages[] = $otherImageName;
        }
    }
    if (empty($otherImages)) {
        $otherImages = explode(',', $_POST['existing_other_images']);
    }
    $otherImagesString = implode(',', $otherImages);

    try {
        $productModel->updateProduct(
            $id, $name, $categories, $price, $code, $description,
            $frontImage, $otherImagesString, date('Y-m-d H:i:s')
        );
        header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
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
    <link rel="stylesheet" href="style_update_product.css">
    <title>Update Product</title>
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
                <input type="hidden" name="existing_front_image" value="<?php echo htmlspecialchars($product['front_image']); ?>">
                <input type="hidden" name="existing_other_images" value="<?php echo htmlspecialchars($product['other_images']); ?>">

                <div class="product-name">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($product['name']); ?>">
                </div>

                <div class="product-categories">
                    <label for="categories">Categories:</label>
                    <select id="categories" name="categories" required>
                        <option value="mobile" <?php if ($product['category'] == 'mobile') echo 'selected'; ?>>Mobile</option>
                        <option value="laptop" <?php if ($product['category'] == 'laptop') echo 'selected'; ?>>Laptop</option>
                        <option value="keyboard" <?php if ($product['category'] == 'keyboard') echo 'selected'; ?>>Keyboard</option>
                        <option value="mouse" <?php if ($product['category'] == 'mouse') echo 'selected'; ?>>Mouse</option>
                        <option value="headphone" <?php if ($product['category'] == 'headphone') echo 'selected'; ?>>Headphone</option>
                    </select>
                </div>

                <div class="product-price">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" step="0.01" required value="<?php echo htmlspecialchars($product['price']); ?>">
                </div>

                <div class="product-code">
                    <label for="code">Product Code:</label>
                    <input type="text" id="code" name="code" required value="<?php echo htmlspecialchars($product['proCode']); ?>">
                </div>

                <div class="product-description">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                </div>

                <div class="front-image">
                    <label for="front-image">Front Image:</label>
                    <input type="file" id="front-image" name="front-image">
                    <?php if ($product['front_image']): ?>
                        <p>Current Image: <img src="/onboarding-project/pages/admin/add_product/photo/<?php echo htmlspecialchars($product['front_image']); ?>" width="100"></p>
                    <?php endif; ?>
                </div>

                <div class="other-images">
                    <label for="other-images">Other Images:</label>
                    <input type="file" id="other-images" name="other-images[]" multiple>
                    <?php if (!empty($product['other_images'])): ?>
                        <p>Current Images:</p>
                        <?php foreach (explode(',', $product['other_images']) as $image): ?>
                            <img src="/onboarding-project/pages/admin/add_product/photo/<?php echo htmlspecialchars($image); ?>" width="100">
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <button type="submit">Update Product</button>
                </div>
            </form>
        </section>
    </main>
    <script src="/pages/admin/add_product/script_update_product.js"></script>
</body>
</html>