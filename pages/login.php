<?php
session_start();
require_once("./services/settings.php");
$result = readSettings();

require_once("services/dbConnect.php");

if (isset($_SESSION["users"])) {
    if ($_SESSION["role"] == "admin") {
        header("location:/admin");
    } else {
        header("location:/");
    }
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare a statement to retrieve email, password, and role
    $stmt = $conn->prepare("SELECT password, role, id FROM `users` WHERE email = ?");

    // Bind parameters
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify the password
        if ($password == $row['password']) {
            echo "Login Successful";
            $_SESSION["users"] = $row['id'];
            $_SESSION["role"] = $row['role'];
            if ($row['role'] == "admin") {
                header("location:/admin");
            } else {
                header("location:/");
            }
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link
        rel="icon"
        type="images/png"
        href="<?php echo $result["logo"] ?>" />
    <link rel="stylesheet" href="/Assets/Stylesheets/global.css">
    <link rel="stylesheet" href="/Assets/Stylesheets/login.css">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body>
    <!-- <div class="lottie-bg">
        <lottie-player src="/Assets/Lottie/say-hello.json" background="transparent" speed="1" loop autoplay></lottie-player>
    </div> -->
    <div class="lottie-bg">
        <img src="/Assets/Images/hello.gif" alt="Hello" width="220px" height="220px">

    </div>


    <form method="post" class="text-white container-login">
        <h2>Login</h2>
        <p>Masukan email dan password untuk login</p>
        <form action="" method="post">
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" placeholder="Masukan Email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" placeholder="Masukan Password" id="password" name="password" required>
                <button type="submit" name="login">LOGIN</button>
            </div>
        </form>
    </form>


    <script src="/Assets/Javascript/login.js"></script>
</body>

</html>