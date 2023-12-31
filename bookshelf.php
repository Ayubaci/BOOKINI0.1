<!-- check if the user is correctly authenticated-->
<?php
session_start();
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit;
}

//the navbar-->
include("header.html");
?>

<!-- start building our bookshelf-->
<div class="welcome-section b">
    <div class="bookshelf">
        <div class="filter-section">
            <form action="bookshelf.php" class="filters" method="post">

                <!-- creating our filters-->
                <!-- creating our filters by major-->
                <label for="major">Search by major:</label>
                <div class="radio-input-container">
                    <input type="radio" name="major" value="biology" id="biology">
                    <label for="biology">Biology</label>
                </div>
                <div class="radio-input-container">
                    <input type="radio" name="major" value="computerscience" id="computerscience">
                    <label for="computerscience">Computer Science</label>
                </div>
                <div class="radio-input-container">
                    <input type="radio" name="major" value="webprogramming" id="webprogramming">
                    <label for="webprogramming">Web Programming</label>
                </div>
                <br>

                <!-- creating our filters by modules-->
                <label for="module">Search by Modules:</label>
                <div class="radio-input-container">
                    <input type="radio" name="module" value="math" id="math">
                    <label for="math">Math</label>
                </div>
                <div class="radio-input-container">
                    <input type="radio" name="module" value="html" id="html">
                    <label for="html">HTML5</label>
                </div>
                <div class="radio-input-container">
                    <input type="radio" name="module" value="nature" id="nature">
                    <label for="nature">Nature</label>
                </div>
                <br>
                <input class="apply-btn" type="submit" value="Search" name="apply">
            </form>
        </div>
        <div class="display-books-section">
            <!-- here we gonna create a book generator to load our stored books to the html file:-->
            <!--first we are going to connect to our database where the books are sotred then retrieve thier data-->
            <?php
            include("connection.php");
            $sql = "SELECT * FROM books";
            $result = $conn->query($sql);
            // checking if the user applied anny fillters :
            if (isset($_POST["apply"])) {
                $filter = $_POST["major"];
                $sql_filter = "select * from books where field = '$filter'";
                $filter_result = $conn->query($sql_filter);
                if ($filter_result->num_rows > 0) {
                    while ($row = $filter_result->fetch_assoc()) {
                        //checking if the book is avialable:
                        if ($row["qnt"] >= 1) {
                            // Access individual fields using associative array keys
                            echo '<div class="a-book-card">
                                    <img class="book-img" src=' . $row["imgpath"] . '>
                                    <h3>Title: ' . $row["title"] . '</h3>
                                    <h4>Price: ' . $row["price"] . ' DA</h4>
                                    <form action="bookshelf.php" method="post">
                                        <input class="order-btn" type="submit" value="Order" name="order">
                                    </form>
                                </div>';
                        }
                    }
                }
            } elseif ($result->num_rows > 0) {
                // Loop through each row in the result set
                while ($row = $result->fetch_assoc()) {
                    //checking if the book is avialable:
                    if ($row["qnt"] >= 1) {
                        // Access individual fields using associative array keys
                        echo '<div class="a-book-card">
                                <img class="book-img" src=' . $row["imgpath"] . '>
                                <h3>Title: ' . $row["title"] . '</h3>
                                <h4>Price: ' . $row["price"] . ' DA</h4>
                                <form action="bookshelf.php" method="post">
                                    <input class="order-btn" type="submit" value="Order" name="order">
                                </form>
                            </div>';
                    }
                }
            } else {
                echo "No results";
            }
            ?>
        </div>
    </div>
</div>

<?php
//footer section:
include("footer.html");
?>