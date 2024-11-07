<?php
require_once("services/dbConnect.php");
session_start();
if (!isset($_SESSION["users"])) {
    header("location:/login");
} else {
    $id = $_SESSION["users"];

    if ($_SESSION["role"] != "admin") {
        header("location:/");
    }

    $query = "SELECT * FROM `users` WHERE id = '$id'";
    $sql = mysqli_query($conn, $query);

    if (mysqli_num_rows($sql) == 1) {
        $data = mysqli_fetch_assoc($sql);
    } else {
        session_unset();
        header("location:/login");
    }
}

?>
<nav class="navbar container-main-open">
    <div class="left-bars">
        <div class="bars"><i class="fa-solid fa-bars"></i></div>
        <div class="company">
            <img src="<?php echo "/" . $resultSettings["logo"] ?>" alt="Company Logo">
            <p><?php echo $resultSettings["company_name"] ?></p>
        </div>
    </div>
    <div class="profile">
        <img src="<?php echo $data["profile_picture"] ?>" alt="profile">
        <p><?php echo $data["name"] ?></p>
    </div>
</nav>