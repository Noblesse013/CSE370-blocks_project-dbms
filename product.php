
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
require 'DBconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_product'])) {
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $category = $_POST['product_category'];
        $quantity = $_POST['product_quantity'];

        $stmt = $conn->prepare("INSERT INTO product (name, price, category, quantity) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdsi", $name, $price, $category, $quantity);
        $stmt->execute();
        
    }
    
    if (isset($_POST['update_product'])) {
        $product_id = $_POST['product_id'];
        $name = $_POST['product_name'];
        $price = $_POST['product_price'];
        $category = $_POST['product_category'];
        $quantity = $_POST['product_quantity'];

        $stmt = $conn->prepare("UPDATE product SET name=?, price=?, category=?, quantity=? WHERE product_id=?");
        $stmt->bind_param("sdsii", $name, $price, $category, $quantity, $product_id);
        $stmt->execute();
        
    }
    
    if (isset($_POST['delete_product'])) {
        $id = $_POST['product_id'];

        $stmt = $conn->prepare("DELETE FROM product WHERE product_id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
    }
    if (isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];

        $stmt = $conn->prepare("DELETE FROM `order_details` WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();

        $stmt = $conn->prepare("DELETE FROM `order` WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        
    }
}

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin view</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
    <h1>Admin View</h1>
    <div class="container">
        <form method="POST" action="product.php">
            <h2>Add Product</h2>
            <label>Product Name:</label>
            <input type="text" name="product_name" required>
            <label>Price:</label>
            <input type="number" step="0.01" name="product_price" required>
            <label>Category:</label>
            <input type="text" name="product_category" required>
            <label>Quantity:</label>
            <input type="number" name="product_quantity" required>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <form method="POST" action="product.php">
            <h2>Update Product</h2>
            <label>Product ID:</label>
            <input type="number" name="product_id" required>
            <label>Product Name:</label>
            <input type="text" name="product_name" required>
            <label>Price:</label>
            <input type="number" step="0.01" name="product_price" required>
            <label>Category:</label>
            <input type="text" name="product_category" required>
            <label>Quantity:</label>
            <input type="number" name="product_quantity" required>
            <button type="submit" name="update_product">Update Product</button>
        </form>

        <form method="POST" action="product.php">
            <h2>Delete Product</h2>
            <label>Product ID:</label>
            <input type="number" name="product_id" required>
            <button type="submit" name="delete_product">Delete Product</button>
        </form>
    </div>


    <h1>Product List</h1>
    <?php
    $result = $conn->query("SELECT product_id, name, price, category, quantity FROM product");

    if ($result && $result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Quantity</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['product_id']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['price']) . "</td>
                    <td>" . htmlspecialchars($row['category']) . "</td>
                    <td>" . htmlspecialchars($row['quantity']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No products found.";
    }
    
    
    ?>
    
    <h1>Manage Orders</h1>
    <?php
    $result = $conn->query("SELECT o.order_id, o.buyer_id, b.username AS buyer_name, p.name AS product_name FROM `order` o JOIN buyer b ON o.buyer_id = b.buyer_id JOIN order_details od ON o.order_id = od.order_id JOIN product p ON od.product_id = p.product_id");

    if ($result && $result->num_rows > 0) {
        echo "<table>
                
                    <tr>
                        <th>Order ID</th>
                        <th>Buyer Name</th>
                        <th>Product Name</th>
                        <th>Actions</th>
                    </tr>
                
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['order_id']) . "</td>
                    <td>" . htmlspecialchars($row['buyer_name']) . "</td>
                    <td>" . htmlspecialchars($row['product_name']) . "</td>
                    <td>
                        <form method='POST' action='product.php' style='display: inline-block;'>
                            <input type='hidden' name='order_id' value='" . htmlspecialchars($row['order_id']) . "'>
                            <button type='submit' name='delete_order'>Delete Order</button>
                        </form>
                    </td>
                </tr>";
        }
        echo "</tbody>
            </table>";
    } else {
        echo "<p>No orders found.</p>";
    }
    $conn->close();
    ?>
        
</body>
</html>
