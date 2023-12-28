<?php
// for local
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "taco_truck";
// $port = 3306;

//for droplet:
$servername = "localhost";
$username = "root";
$password = "MyNewPass1!";
$dbname = "taco_truck";
          

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$phone;
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$form_type = $_POST['form-type'];
if ($form_type == 'phone-number-form') {
  $phone = $_POST['phone'];
  $sql = "INSERT INTO orders (phone_number, item, quantity, price, drink) VALUES ('$phone')";
  echo $phone;

} else if ($form_type == 'order-form') {
  $phone = $_POST['phone'];
  $taco = $_POST['item'];
  $address = $_POST['address'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $drink = $_POST['drink'];


  $sql = "INSERT INTO orders (phone_number, item, quantity, price, drink) VALUES ('$phone', '$taco', '$quantity', '$price', '$drink')";

  if (!mysqli_query($conn, $sql)) {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
  $name = $_POST['name'];
  $address = $_POST['address'];

  $query_amount = "SELECT * FROM customers WHERE phone_number = '$phone'";
  $amount = $conn->query($query_amount);
  if ($amount->num_rows > 0) {
    $sql = "UPDATE customers SET name='$name', street_address='$address' WHERE phone_number='$phone'";
    if (!mysqli_query($conn, $sql)) {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  } else {
    $sql = "INSERT INTO customers (phone_number, name, street_address) VALUES ('$phone', '$name', '$address')";
    if (!mysqli_query($conn, $sql)) {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }

  // add last order
    $id_last_order = "SELECT * FROM orders WHERE phone_number IS NOT NULL ORDER BY id DESC LIMIT 1";
    $last_order_result = $conn->query($id_last_order);
    $last_order_row = $last_order_result->fetch_assoc(); 
    $last_order_num = $last_order_row['id']; 

  $sql = "UPDATE customers SET last_order='$last_order_num' WHERE phone_number='$phone'";
  if (!mysqli_query($conn, $sql)) {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

} else {
  echo 'error';
}
$sql = "SELECT id, item, price, drink FROM orders WHERE phone_number = '$phone'";
$table_result = mysqli_query($conn, $sql);

// close the database connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Taco Order Form</title>

    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js"></script>
</head>
<body>
    <nav>
        <img id="logo" src="../images/ricky_taco_truck_transparent.png" alt="Ricky's taco truck logo">
        <p>My Cart</p>
    </nav>
    <div class="image-word-container">
        <img class="background_image" src="../images/taco_in_city.png" alt="taco_trucks_on_gravel">
        <p class="text-overlay">Ricky's Uber Tacos</p>
    </div>
    <div class="image-word-container">
        <img class="background_image" src="../images/taco_in_lot.jpeg" alt="taco_trucks_on_lot">
        <p class="text-overlay">Austin's Favorite Tacos</p>
    </div>
    <div class="content-wrapper">
        <div class="content">
            <div class="cards">
                <h3 id="menu">Menu</h3>
                <div class="card-row">
                    <div class="card">
                        <img src="../images/vegan_taco.jpeg" alt="Card Image">
                        <div class="card-content">
                        <h3 class="card-title">Vegan Taco</h3>
                        <p class="price">$1.99</p>
                        <h3 class="card-subtitle">Nutrition (Per Serving)</h3>
                        <p class="card-text">
                            Calories: 157kcal | Carbohydrates: 27g | Protein: 13g | Fat: 1g | Fiber: 8g
                        </p>
                        </div>
                    </div>
                    <div class="card">
                        <img src="../images/mega_taco.jpeg" alt="Card Image">
                        <div class="card-content">
                        <h3 class="card-title">Mega Taco</h3>
                        <p class="price">$2.99</p>
                        <h3 class="card-subtitle">Nutrition (Per Serving)</h3>
                        <p class="card-text">
                            Calories: 290kcal | Carbohydrates: 43g | Protein: 29g | Fat: 4g | Fiber: 20g
                        </p>
                        </div>
                    </div>
                </div>
                <div class="card-row">
                <div class="card">
                    <img src="../images/ultra_taco.jpeg" alt="Card Image">
                    <div class="card-content">
                    <h3 class="card-title">Ultra Taco</h3>
                    <p class="price">$10.99</p>
                    <h3 class="card-subtitle">Nutrition (Per Serving)</h3>
                        <p class="card-text">
                            Calories: 4003kcal | Carbohydrates: 143g | Protein: 120g | Fat: 20g | Fiber: 190g
                        </p>
                    </div>
                </div>
                <div class="card">
                    <img src="../images/uber_taco.png" alt="Card Image">
                    <div class="card-content">
                    <h3 class="card-title">Uber Taco</h3>
                    <p class="price">$50.99</p>
                    <h3 class="card-subtitle">Nutrition (Per Serving)</h3>
                        <p class="card-text">
                            Calories: 90132kcal | Carbohydrates: 1929g | Protein: 340g | Fat: 103g | Fiber: 2340g
                        </p>
                    </div>
                </div>
                </div>
                <h3 id="drinks">Drinks</h3>
                <div class="image-gallery">
                    <div class="drink-image">
                        <img src="../images/tea.png" alt="Tea">
                        <p class="price drinks">$1.99</p>
                    </div>
                    <div class="drink-image">
                        <img src="../images/water.png" alt="Water">
                        <p class="price drinks">$0.99</p>
                    </div>
                    <div class="drink-image">
                        <img src="../images/coke.png" alt="Coke">
                        <p class="price drinks">$1.49</p>
                    </div>
                    <div class="drink-image">
                        <img src="../images/dr. pepper.png" alt="Dr. Pepper">
                        <p class="price drinks">$1.49</p>
                    </div>
                    <div class="drink-image">
                        <img src="../images/orange.png" alt="Orange Juice">
                        <p class="price drinks">$2.99</p>
                    </div>

                </div>
            </div>
            <div class="inputs-container">
                <div class="inputs" style="padding:100px 280px">
                    <h2 style="padding-left: 50px;">Order Successful!</h2>
                    <img src="../images/ricky_taco_truck_transparent.png" alt="taco_truck_logo" style="width:300px">
                    <h2>Past Orders for: <?php echo "$name"?></h2>
                    <?php
                    // Check if any rows were returned
                    if (mysqli_num_rows($table_result) > 0) {
                        // Output the table header
                        echo "<table>";
                        echo "<tr><th>Order #</th><th>Item</th><th>Price</th><th>Drink</th></tr>";
                        
                        // Loop through the rows and output the data
                        while ($row = mysqli_fetch_assoc($table_result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["item"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "<td>" . $row["drink"] . "</td>";
                            echo "</tr>";
                        }
                        
                        // Close the table
                        echo "</table>";
                    } else {
                        // Output a message if no rows were returned
                        echo "No results found.";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <nav>
            <p>Home</p>
            <p>About</p>
            <p>Contact</p>
        </nav>
        <p id="copy">&copy; 2023 Richard Yoshioka, Inc.</p>
      </footer>
</body>
</html>