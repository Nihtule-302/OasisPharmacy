<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
</head>
<body>
    <div class="container">
        <h2>Product Management</h2>
      
        <h3>Add Product</h3>
        <form action="modifyProducts.blade.php" method="post">
    Product ID: <input type="text" name="product_id"><br>
    Product Name: <input type="text" name="product_name"><br>
    Price: <input type="number" name="price"><br>
    Expiry Date: <input type="date" name="expiry_date"><br>
    <input type="submit" name="add_product" value="Add Product">
</form>


        
        <h3>Products</h3>
        <ul>
            <?php
            // Connect to the database
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "oasis_pharmacy";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

         
            if(isset($_POST['add_product'])) {
                $productName = $_POST['product_name'];
                $productId =$_POST['product_id'];
                $price = $_POST['price'];
                $expiryDate = $_POST['expiry_date'];

                
                $sql = "INSERT INTO pharmaceutical_products (product_name,product_id ,price, expiration_date) VALUES ('$productName', '$productId', '$price', '$expiryDate')";
                if ($conn->query($sql) === TRUE) {
                    echo "<li>New product added successfully.</li>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // delete product by name
            if(isset($_GET['delete_product'])) {
                $productName = $_GET['delete_product'];

                // Delete the product from the database by name
                $sql = "DELETE FROM pharmaceutical_products WHERE product_name='$productName'";
                if ($conn->query($sql) === TRUE) {
                    echo "<li>Product deleted successfully.</li>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

        // Display  products
$sql = "SELECT * FROM pharmaceutical_products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li>ID: {$row['product_id']} - Name: {$row['product_name']} - Price: {$row['price']} - Expiry Date: {$row['expiration_date']} <a href='modifyProducts.blade.php?delete_product={$row['product_name']}'>Delete</a></li>";
    }
} else {
    echo "No products available.";
}

            $conn->close();
            ?>
        </ul>
    </div>
</body>
</html>
