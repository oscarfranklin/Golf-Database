
<?php

$connect = mysqli_connect(
    'db', # service name
    'php_docker', # username
    'password', # password
    'php_docker' # db table
);

// Initialize variables
$product_id = "";
$cost_per_unit = 0;
$quantity_in_stock = 0;
$connect = mysqli_connect('db', 'php_docker', 'password', 'php_docker');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    if(isset($_POST["product_id"])) {
        $product_id = $_POST["product_id"];
    }
    if(isset($_POST["cost_per_unit"])) {
        $cost_per_unit = $_POST["cost_per_unit"];
    }
    if(isset($_POST["quantity_in_stock"])) {
        $quantity_in_stock = $_POST["quantity_in_stock"];
    }

    // Validate input (add more validation if needed)
    if (empty($product_id)) {
        echo "Product ID is required.";
        // Handle validation error or exit script
        exit;
    }
    if (!is_numeric($cost_per_unit)) {
        echo "Cost per unit must be a number.";
        // Handle validation error or exit script
        exit;
    }
    if (!is_numeric($quantity_in_stock)) {
        echo "Quantity in stock must be a number.";
        // Handle validation error or exit script
        exit;
    }

    // Your SQL queries and other logic...
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product ID from form
    $product_id = $_POST["product_id"];

    // Validate product ID (you might want to perform additional validation here)

    // Connect to your database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement for product deletion
    $sql = "DELETE FROM Products WHERE ProductID = '$product_id'";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Product with ID $product_id has been successfully removed.";
    } else {
        echo "Error removing product: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
// Prepare SQL statement for product insertion
$sql = "INSERT INTO Products (ProductID, CostPerUnit, QuantityInStock) 
VALUES ('$product_id', '$cost_per_unit', '$quantity_in_stock')";
// Execute SQL query
// Ensure $connect is initialized and the connection is successful
if ($connect) {
    // Check if product ID is empty
    if (empty($product_id)) {
        echo "Error: Product ID cannot be empty.";
    } else {
        // Prepare SQL statement for product insertion
        $sql = "INSERT INTO Products (ProductID, CostPerUnit, QuantityInStock) 
                VALUES ('$product_id', '$cost_per_unit', '$quantity_in_stock')";

        // Execute SQL query
        if ($connect->query($sql) === TRUE) {
            echo "Product added successfully!";
        } else {
            // Check for duplicate entry error
            if ($connect->errno == 1062) {
                echo "Error adding product: Product ID already exists.";
            } else {
                echo "Error adding product: " . $connect->error;
            }
        }
    }
} else {
    // Handle connection error
    echo "Error: Database connection failed.";
}


// Prepare SQL statement for updating quantity in stock
// Example initialization of $new_quantity, replace with your actual logic
$new_quantity = 0;

// Ensure $connect is initialized and the connection is successful
if ($connect) {
    // Prepare SQL statement for updating quantity in stock
    $sql = "UPDATE Products SET QuantityInStock = '$new_quantity' WHERE ProductID = '$product_id'";

    // Execute SQL query
    if ($connect->query($sql) === TRUE) {
        echo "Quantity in stock updated successfully!";
    } else {
        echo "Error updating quantity in stock: " . $connect->error;
    }
} else {
    // Handle connection error
    echo "Error: Database connection failed.";
}

// Ensure $connect is initialized and the connection is successful
if ($connect) {
    // Prepare SQL statement to select all products
    $sql = "SELECT * FROM Products";

    // Execute SQL query
    $result = $connect->query($sql);

    if ($result) {
        // Check if there are any products
        if ($result->num_rows > 0) {
            // Display products table
            echo "<h2>Products</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Product ID</th><th>Cost Per Unit</th><th>Quantity In Stock</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ProductID"] . "</td>";
                echo "<td>" . $row["CostPerUnit"] . "</td>";
                echo "<td>" . $row["QuantityInStock"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No products found.";
        }
    } else {
        // Handle query error
        echo "Error retrieving products: " . $connect->error;
    }
} else {
    // Handle connection error
    echo "Error: Database connection failed.";
}


// Check if there are any products
if ($result->num_rows > 0) {
    // Display products table
    echo "<h2>Products</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Product ID</th><th>Cost Per Unit</th><th>Quantity In Stock</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ProductID"] . "</td>";
        echo "<td>" . $row["CostPerUnit"] . "</td>";
        echo "<td>" . $row["QuantityInStock"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No products found.";
}
// Ensure $connect is initialized and the connection is successful
if ($connect) {
    // Prepare SQL statement to select all clients
    $sql = "SELECT * FROM Clients";

    // Execute SQL query
    $result = $connect->query($sql);

    if ($result) {
        // Check if there are any clients
        if ($result->num_rows > 0) {
            // Display clients table
            echo "<h2>Clients</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Client ID</th><th>Number Of Orders</th><th>Phone Number</th><th>Location</th><th>Client Discount</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ClientID"] . "</td>";
                echo "<td>" . $row["NumberOfOrders"] . "</td>";
                echo "<td>" . $row["PhoneNumber"] . "</td>";
                echo "<td>" . $row["Location"] . "</td>";
                echo "<td>" . $row["ClientDiscount"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No clients found.";
        }
    } else {
        // Handle query error
        echo "Error retrieving clients: " . $connect->error;
    }
} else {
    // Handle connection error
    echo "Error: Database connection failed.";
}


// Check if there are any clients
if ($result->num_rows > 0) {
    // Display clients table
    echo "<h2>Clients</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Client ID</th><th>Number Of Orders</th><th>Phone Number</th><th>Location</th><th>Client Discount</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ClientID"] . "</td>";
        echo "<td>" . $row["NumberOfOrders"] . "</td>";
        echo "<td>" . $row["PhoneNumber"] . "</td>";
        echo "<td>" . $row["Location"] . "</td>";
        echo "<td>" . $row["ClientDiscount"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No clients found.";
}
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $client_id = $_POST["client_id"];
}
    // Connect to your database
    $servername = "localhost";
    $username = "your_username"; // Replace with your database username
    $password = "your_password"; // Replace with your database password
    $dbname = "your_database_name"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to select client information
    $sql = "SELECT * FROM Clients WHERE ClientID = '$client_id'";

    // Execute SQL query
    $result = $conn->query($sql);

    // Display client information for editing
    if ($result->num_rows > 0) {
        echo "<h2>Edit Client Information</h2>";
        echo "<form action='update_client.php' method='post'>";
        while($row = $result->fetch_assoc()) {
            echo "Client ID: <input type='text' name='client_id' value='" . $row["ClientID"] . "' readonly><br>";
            echo "Number Of Orders: <input type='text' name='number_of_orders' value='" . $row["NumberOfOrders"] . "'><br>";
            echo "Phone Number: <input type='text' name='phone_number' value='" . $row["PhoneNumber"] . "'><br>";
            echo "Location: <input type='text' name='location' value='" . $row["Location"] . "'><br>";
            echo "Client Discount: <input type='text' name='client_discount' value='" . $row["ClientDiscount"] . "'><br>";
        }
        echo "<input type='submit' value='Update Client'>";
        echo "</form>";
    } else {
        echo "Client not found.";
    }
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to delete client
$sql = "DELETE FROM Clients WHERE ClientID = '$client_id'";

// Execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "Client with ID $client_id has been successfully deleted.";
} else {
    echo "Error deleting client: " . $conn->error;
}
// Prepare SQL statement to insert client
$sql = "INSERT INTO Clients (ClientID, NumberOfOrders, PhoneNumber, Location, ClientDiscount)
VALUES ('$client_id', '$number_of_orders', '$phone_number', '$location', '$client_discount')";

// Execute SQL query
if ($conn->query($sql) === TRUE) {
echo "New client added successfully!";
} else {
echo "Error adding client: " . $conn->error;
}
// Prepare SQL statement to select all product orders
$sql = "SELECT * FROM ProductOrders";

// Execute SQL query
$result = $conn->query($sql);

// Display product orders table
if ($result->num_rows > 0) {
    echo "<h2>Product Orders</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Product ID</th><th>Order ID</th><th>Product Quantity</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ProductID"] . "</td>";
        echo "<td>" . $row["OrderID"] . "</td>";
        echo "<td>" . $row["ProductQuantity"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No product orders found.";
}
// Prepare SQL statement to select all Order IDs
$sql = "SELECT DISTINCT OrderID FROM Orders";

// Execute SQL query
$result = $conn->query($sql);

// Display Order IDs
if ($result->num_rows > 0) {
    echo "<h2>Order IDs</h2>";
    echo "<ul>";

    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["OrderID"] . "</li>";
    }

    echo "</ul>";
} else {
    echo "No Order IDs found.";
}
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $product_id = $_POST["product_id"];
    $cost_per_unit = $_POST["cost_per_unit"];
    $discount = $_POST["discount"];

    // Calculate total sale after applying discount
    $total_sale = $cost_per_unit - ($cost_per_unit * ($discount / 100));
    // Prepare SQL statement to insert order
    $sql = "INSERT INTO Orders (ProductID, ProductQuantity, TotalSale, OrderDate)
            VALUES ('$product_id', 1, '$total_sale', NOW())";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully!";
    } else {
        echo "Error placing order: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>