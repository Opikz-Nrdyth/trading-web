<?php
require_once("services/dbConnect.php");
require_once("services/settings.php");
$resultSettings = readSettings();

function fetchData()
{
    global $conn;
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $query);

    return $result;
}

function generateId($length = 8)
{
    $number = '';
    for ($i = 0; $i < $length; $i++) {
        $number .= rand(0, 9);
    }
    return $number;
}

if (isset($_POST["addData"])) {
    $name = $_POST["name"];
    $role = $_POST["role"];
    $gander = $_POST["gander"];
    $phone_number = $_POST["phone_number"];
    $work = $_POST["work"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $capital_amount = $_POST["capital_amount"];
    $profile = $_FILES["profile"];
    $id = generateId();

    // Allowed file types and size limit (1MB)
    $allowed_types = ['image/jpg', 'image/png', 'image/jpeg'];
    $max_file_size = 1048576; // 1MB

    // Target directory
    $target_dir = "Assets/Images/profile/";
    $file_extension = pathinfo($profile["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $id . '.' . $file_extension;


    // Check file type
    if (!in_array($profile["type"], $allowed_types)) {
        echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Hanya diperbolehkan File JPG, JPEG, dan PNG</span> </div>';
        exit;
    }

    // Check file size
    if ($profile["size"] > $max_file_size) {
        echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: File terlalu besar! hanya diperbolehkan 1mb</span> </div>';
        exit;
    }

    // Check if upload directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if ($address != "" && $password != "") {
        if (move_uploaded_file($profile["tmp_name"], $target_file)) {
            $query = "INSERT INTO `users`(`id`, `email`, `password`, `role`, `name`, `address`, `gender`, `phone_number`, `work`, `capital_amount`, `profile_picture` ) VALUES ('$id','$email','$password','$role','$name','$address','$gander','$phone_number','$work','$capital_amount','/$target_file')";
            $sql = mysqli_query($conn, $query);
            if ($sql) {
                echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Berhasil Menambah Users Baru!</span> </div>';
            } else {
                echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Gagal Menambah User Baru!</span> </div>';
            }
        }
    }
}

if (isset($_POST["editData"])) {
    $id = $_POST["userId"];
    $name = $_POST["name"];
    $role = $_POST["role"];
    $gander = $_POST["gander"];
    $phone_number = $_POST["phone_number"];
    $work = $_POST["work"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $capital_amount = $_POST["capital_amount"];
    $profile = $_FILES["profile"];

    // Check if a new profile photo is uploaded
    if ($profile['name'] != '') {
        // Allowed file types and size limit (1MB)
        $allowed_types = ['image/jpg', 'image/png', 'image/jpeg'];
        $max_file_size = 1048576; // 1MB

        // Target directory
        $target_dir = "Assets/Images/profile/";
        $file_extension = pathinfo($profile["name"], PATHINFO_EXTENSION);
        $target_file = $target_dir . $id . '.' . $file_extension;

        // Check file type
        if (!in_array($profile["type"], $allowed_types)) {
            echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Hanya diperbolehkan File JPG, JPEG, dan PNG</span> </div>';
            exit;
        }

        // Check file size
        if ($profile["size"] > $max_file_size) {
            echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: File terlalu besar! hanya diperbolehkan 1mb</span> </div>';
            exit;
        }

        // Check if upload directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move the uploaded file and update the database
        if (move_uploaded_file($profile["tmp_name"], $target_file)) {
            // First, delete the old image if exists
            $old_profile_query = "SELECT profile_picture FROM users WHERE id='$id'";
            $result = mysqli_query($conn, $old_profile_query);
            $old_profile = mysqli_fetch_assoc($result)['profile_picture'];
            if ($old_profile && file_exists($old_profile)) {
                unlink($old_profile);
            }

            // Update query with the new profile picture
            $query = "UPDATE `users` SET `email`='$email', `role`='$role', `name`='$name', `address`='$address', `gender`='$gander', `phone_number`='$phone_number', `work`='$work', `capital_amount`='$capital_amount', `profile_picture`='/$target_file' WHERE `id`='$id'";
        }
    } else {
        // Update without changing the profile picture
        $query = "UPDATE `users` SET `email`='$email', `role`='$role', `name`='$name', `address`='$address', `gender`='$gander', `phone_number`='$phone_number', `work`='$work', `capital_amount`='$capital_amount' WHERE `id`='$id'";
    }

    $sql = mysqli_query($conn, $query);
    if ($sql) {
        echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Berhasil Update Users!</span> </div>';
    } else {
        echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Gagal Update User!</span> </div>';
    }
}


if (isset($_POST["deleteUser"])) {
    $id = $_POST["userId"];
    if ($id != "") {
        // Get the user's profile picture
        $profile_query = "SELECT profile_picture FROM users WHERE id='$id'";
        $result = mysqli_query($conn, $profile_query);
        $profile = mysqli_fetch_assoc($result)['profile_picture'];

        // Delete user data
        $query = "START TRANSACTION; DELETE FROM `transactions` WHERE user_id='$id'; DELETE FROM `deposits` WHERE user_id='$id'; DELETE FROM `withdrawals` WHERE user_id='$id'; DELETE FROM `users` WHERE id='$id'; COMMIT;";
        $sql = mysqli_multi_query($conn, $query);
        if ($sql) {
            // If user had a profile picture, delete the file from the server
            if ($profile && file_exists($profile)) {
                unlink($profile);
            }
            echo "Berhasil";
        } else {
            echo "Gagal Menghapus Data";
        }
    } else {
        echo "Gagal Menghapus Data";
    }
}


$result = fetchData();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Trader Go</title>
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/global.css">
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/users.css">
    <link
        rel="icon"
        type="images/png"
        href="/Assets/Images/company-logo.png" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <?php
    require_once("Components/admin/navbar.php");
    require_once("Components/admin/sidebar.php");
    ?>

    <main class="container-main-open">
        <button class="add-data" onclick="openModal()">Tambah Data</button>
        <div class="container-table">
            <table class="table-desktop">
                <thead>
                    <tr>
                        <th>UserID</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Pekerjaan</th>
                        <th>No Telephone</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $data["id"] ?></td>
                            <td><?php echo $data["name"] ?></td>
                            <td>
                                <p class="<?php echo $data["role"] ?>"><?php echo $data["role"] ?></p>
                            </td>
                            <td><?php echo $data["gender"] ?></td>
                            <td><?php echo $data["address"] ?></td>
                            <td><?php echo $data["email"] ?></td>
                            <td><?php echo $data["work"] ?></td>
                            <td><?php echo $data["phone_number"] ?></td>
                            <td>
                                <button class="btn-edit" onclick="editUser('<?php echo $data['id'] ?>', '<?php echo $data['name'] ?>', '<?php echo $data['role'] ?>', '<?php echo $data['gender'] ?>', '<?php echo $data['address'] ?>', '<?php echo $data['email'] ?>', '<?php echo $data['password'] ?>', '<?php echo $data['work'] ?>', '<?php echo $data['phone_number'] ?>', '<?php echo $data['capital_amount'] ?>')"><i class="fa-solid fa-pen"></i></button>
                                <button class="btn-delete" onclick="deleteUser(`<?php echo $data['id'] ?>`)"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="modal">
            <div class="modal-content">
                <p>Tambah Users</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="userId" placeholder="user ID">
                    <input type="text" name="name" placeholder="Nama Lengkap">
                    <select name="role">
                        <option value="client">Client</option>
                        <option value="admin">Admin</option>
                    </select>
                    <select name="gander">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>

                    <input type="number" name="phone_number" placeholder="Nomer Telephone">
                    <input type="text" name="work" placeholder="Pekerjaan">
                    <textarea name="address" placeholder="Masukan Alamat"></textarea>
                    <input type="email" name="email" placeholder="Email">
                    <input type="text" name="password" placeholder="Password">
                    <input type="number" name="capital_amount" placeholder="Saldo">
                    <input type="file" accept="image/*" name="profile" placeholder="profile">
                    <div class="conatiner-button">
                        <button type="button" onclick="closeModal()">Batal</button>
                        <button type="submit" name="addData">Prosess</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        function closeModal() {
            document.querySelector('.modal').style.display = 'none';
        }

        function openModal() {
            document.querySelector('.modal').style.display = 'block';
            document.querySelector('input[name="userId"]').setAttribute("style", "display:none")
        }

        setTimeout(() => {
            document.querySelector(".alert").remove()
        }, 3000);

        function deleteUser(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                const formData = new FormData();
                formData.append('deleteUser', true);
                formData.append('userId', id);

                fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    }).then(response => response.text())
                    .then(data => {
                        console.log(data);

                        // window.location.reload();
                    }).catch(error => console.error('Error:', error));
            }
        }

        function editUser(id, name, role, gender, address, email, password, work, phone_number, capital_amount) {
            document.querySelector('input[name="userId"]').value = id;
            document.querySelector('input[name="name"]').value = name;
            document.querySelector('select[name="role"]').value = role;
            document.querySelector('select[name="gander"]').value = gender;
            document.querySelector('input[name="phone_number"]').value = phone_number;
            document.querySelector('input[name="work"]').value = work;
            document.querySelector('textarea[name="address"]').value = address;
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="password"]').value = password;
            document.querySelector('input[name="capital_amount"]').value = capital_amount;

            // Change form button and action for editing
            document.querySelector('.conatiner-button button[type="submit"]').innerText = "Update";
            document.querySelector('.conatiner-button button[type="submit"]').name = "editData";

            document.querySelector('.modal').style.display = 'block';
        }
    </script>
    <script src="/Assets/Javascript/responsiveAdmin.js"></script>
</body>

</html>