<!-- Implemented by - Richard Yoshioka  -->
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
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
  
  } else if ($form_type == 'order-form') {
    $phone = $_POST['phone'];
    $taco = $_POST['item'];
    $address = $_POST['address'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $drink = $_POST['drink'];
  
    $sql = "INSERT INTO orders (phone_number, item, quantity, price, drink) VALUES ('$phone', '$taco', '$quantity', '$price', '$drink')";
  
    $name = $_POST['name'];
  
    if (mysqli_query($conn, $sql)) {
      echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  
  } else {
    echo 'error';
  }
  
  $query = "SELECT COUNT(*) as count FROM customers WHERE phone_number = '$phone'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  
  if ($row['count'] > 0) {
    $customer_exists = true;
  } else {
    $customer_exists = false;
  }
  
  if($customer_exists) {
    $sql = "SELECT last_order FROM customers WHERE phone_number = '$phone'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $last_order_number = $row['last_order'];
  
    $sql = "SELECT name FROM customers WHERE phone_number = '$phone'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
  
    $sql = "SELECT street_address FROM customers WHERE phone_number = '$phone'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $street_address = $row['street_address'];;
  
    // now getting the actual last order
    $sql = "SELECT item FROM orders WHERE id = '$last_order_number'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $taco_choice = $row['item'];
  
    $sql = "SELECT quantity FROM orders WHERE id = '$last_order_number'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $quantity_choice = $row['quantity'];
  
    $sql = "SELECT drink FROM orders WHERE id = '$last_order_number'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $drink_choice = $row['drink'];
  
    $sql = "SELECT price FROM orders WHERE id = '$last_order_number'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $price_choice = $row['price'];
  }
  
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
                <div class="inputs">
                    <div class="top-form">
                        <div class="logo-wrapper">
                            <img class="image" src="../images/ricky_taco_truck_transparent.png" alt="Ricky's taco truck logo">
                        </div>
                        <div class="order-form">
                            <h1>Taco Order Form</h1>
                            <form id="phoneForm" action="../php/index-php.php" method="post">
                                <input type="hidden" name="form-type" value="phone-number-form">
                                <label for="phone">Phone Number:</label>
                                <input type="text" id="phone" name="phone" pattern="[0-9]{10}" value="<?php echo $phone; ?>" required>
                                <input class="button" id="submit-btn" type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                    <form id="orderForm" action="../php/index-php-2.php" method="post" style="display:block;">
                        <input type="hidden" name="form-type" value="order-form">
                        <input type="hidden" name="phone" value="<?php echo $phone?>">

                        <?php if($customer_exists) echo "<h2 style='padding-left:185px; color:green'> Welcome Back, $name!</h2>"; ?>

                        <h2>Customer Information</h2>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php if($customer_exists) echo "$name"; ?>" required>
                        <br>
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" value="<?php if($customer_exists) echo "$street_address"; ?>" required>
                        <hr>
                        <h2>Taco Order</h2>
                        <div class="taco-order">
                            <div class="fields">
                                <div>
                                    <label class="order-details" for="item">Item:</label>
                                    <select id="item" name="item">
                                        <option value="select-taco">- Select Taco -</option>
                                        <option value="vegan_taco" <?php if($customer_exists && $taco_choice == "vegan_taco") echo "selected"; ?>>Vegan Taco</option>
                                        <option value="mega_taco" <?php if($customer_exists && $taco_choice == "mega_taco") echo "selected"; ?>>Mega Taco</option>
                                        <option value="ultra_taco" <?php if($customer_exists && $taco_choice == "ultra_taco") echo "selected"; ?>>Ultra Taco</option>
                                        <option value="uber_taco" <?php if($customer_exists && $taco_choice == "uber_taco") echo "selected"; ?>>Uber Taco</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="order-details" for="quantity">Quantity:</label>
                                    <select id="quantity" name="quantity">
                                        <option value="1" <?php if($customer_exists && $quantity_choice == "1") echo "selected"; ?>>1</option>
                                        <option value="2" <?php if($customer_exists && $quantity_choice == "2") echo "selected"; ?>>2</option>
                                        <option value="3" <?php if($customer_exists && $quantity_choice == "3") echo "selected"; ?>>3</option>
                                        <option value="4" <?php if($customer_exists && $quantity_choice == "4") echo "selected"; ?>>4</option>
                                        <option value="5" <?php if($customer_exists && $quantity_choice == "5") echo "selected"; ?>>5</option>
                                        <option value="6" <?php if($customer_exists && $quantity_choice == "6") echo "selected"; ?>>6</option>
                                        <option value="7" <?php if($customer_exists && $quantity_choice == "7") echo "selected"; ?>>7</option>
                                        <option value="8" <?php if($customer_exists && $quantity_choice == "8") echo "selected"; ?>>8</option>
                                        <option value="9" <?php if($customer_exists && $quantity_choice == "9") echo "selected"; ?>>9</option>
                                        <option value="10" <?php if($customer_exists && $quantity_choice == "10") echo "selected"; ?>>10</option>
                                    </select>
                                </div>
                                <div id="drink-container">
                                    <label class="order-details" for="drink">Drink:</label>
                                    <select id="drink" name="drink">
                                        <option value="none" <?php if($customer_exists && $drink_choice == "none") echo "selected"; ?>>None</option>
                                        <option value="tea" <?php if($customer_exists && $drink_choice == "tea") echo "selected"; ?>>Tea</option>
                                        <option value="water" <?php if($customer_exists && $drink_choice == "water") echo "selected"; ?>>Water</option>
                                        <option value="coke" <?php if($customer_exists && $drink_choice == "coke") echo "selected"; ?>>Coke</option>
                                        <option value="drpepper" <?php if($customer_exists && $drink_choice == "drpepper") echo "selected"; ?>>Dr. Pepper</option>
                                        <option value="orange" <?php if($customer_exists && $drink_choice == "orange") echo "selected"; ?>>Orange</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h2>Your Order</h2>
                        <div class="resulting-facts">
                            <label for="price">Price:</label>
                            <br>
                                <input type="text" id="price" name="price" value="<?php if($customer_exists) echo "$price_choice"; ?>" readonly>
                                <br>
                            <label for="taco-result">Taco:</label>
                            <br>
                                <input type="text" id="taco-result" name="taco-result" value="<?php if($customer_exists) echo "$taco_choice"; ?>" readonly>
                                <br>
                            <label for="quantity-result">QTY:</label>
                            <br>
                                <input type="text" id="quantity-result" name="quantity-result" value="<?php if($customer_exists) echo "$quantity_choice"; ?>" readonly>
                                <br>
                            <label for="drink-result">Drink:</label>
                            <br>
                                <input type="text" id="drink-result" name="drink-result" value="<?php if($customer_exists) echo "$drink_choice"; ?>" readonly>
                        </div>
                        <h3>Would you like to:</h3>
                        <div id="bottom-buttons">
                            <input class="button" id="complete" type="submit" value="Complete Order">
                            <input class="button" id="clear" type="button" value="Clear Order" onclick="clearOrder()">
                        </div>
                    </form>
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