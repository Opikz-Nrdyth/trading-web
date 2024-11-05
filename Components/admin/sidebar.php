<?php
require_once("services/dbConnect.php");
if (isset($_SESSION["users"])) {
    $id = $_SESSION["users"];

    $query = "SELECT * FROM `users` WHERE id = '$id'";
    $sql = mysqli_query($conn, $query);

    $data = mysqli_fetch_assoc($sql);
    $nama = explode(" ", $data["name"]);
}

if (isset($_POST["logout"])) {
    session_unset();
    header("location:/login");
}
?>

<nav class="side-container open-container">
    <div class="profile-side">
        <img src="<?php echo $data["profile_picture"] ?>" alt="Profile">
        <div>
            <p class="name"><?php echo $nama[0] ?></p>
            <p class="status"><span><i class="fa-solid fa-circle"></i></span> Online</p>
        </div>
        <div class="arrow-close-side"><i class="fa-solid fa-arrow-left"></i></div>
    </div>
    <nav onclick="window.location.href = '/admin'">
        <span><i class="fa-solid fa-gauge-high"></i></span> Dashboard
    </nav>
    <nav onclick="window.location.href = '/admin/users'">
        <span><i class="fa-solid fa-users"></i></span> Users
    </nav>
    <nav onclick="window.location.href = '/admin/criptocurrency'">
        <span><i class="fa-solid fa-coins"></i></span> Cryptocurrency
    </nav>
    <nav onclick="window.location.href = '/admin/transactions'">
        <span><i class="fa-solid fa-money-bill-transfer"></i></span> Transactions
    </nav>
    <nav onclick="window.location.href = '/admin/settings'">
        <span><i class="fa-solid fa-gears"></i></span> Settings
    </nav>
    <nav>
        <form action="" method="post">
            <button class="btn-logout" name="logout"><i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i> Logout</button>
        </form>
    </nav>
</nav>