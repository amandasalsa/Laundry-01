<?php
session_start();
if (!isset($_SESSION["user"])){
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form User</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="background">
    <div class="container">
        <div class="card col-lg-6 mx-auto">
            <div class="card-header bg-dark">
                <h2 class="login text-center text-warning">D'Laundry</h2>
                <h4 class="text-center text-white">- Form User -</h4>
            </div>

            <div class="card-body">
            <?php
                if (isset($_GET["id_user"])) {
                    include("connection.php");
                    $id_user = $_GET["id_user"];
                    $sql = "select * from user where id_user='$id_user'";

                    //eksekusi perintah sql
                    $ubah = mysqli_query($connect, $sql);

                    // konversi hasil query ke bentuk array
                    $user = mysqli_fetch_array($ubah);
                ?>

                    <form action="process_user.php" method="post"
                    onsubmit="return confirm('Edit this people?')">
                    
                        ID user
                        <input type="text" name="id_user"
                        class="form-control mb-2" required
                        value="<?=$user["id_user"];?>" readonly>

                        Nama user
                        <input type="text" name="nama_user"
                        class="form-control mb-2" required
                        value="<?=$user["nama_user"];?>">

                        Username
                        <input type="text" name="username"
                        class="form-control mb-2" required
                        value="<?=$user["username"];?>">

                        Password
                        <input type="password" name="password"
                        class="form-control mb-2"
                        value="<?=$user["password"];?>">

                        Role 
                        <select name="role" class="form-control mb-2">
                            <option value="<?=$user["role"];?>" selected><?=$user["role"];?></option>
                            <option value="Admin">Admin</option>
                            <option value="Cashier">Cashier</option>
                        </select>

                        <button type="submit" class="btn btn-success btn-block"
                        name="edit_user">
                            Save
                        </button>
                    </form>
                <?php
                }else{
                    //jika false, menggunakan ini untuk insert
                ?>
                    <form action="process_user.php" method="post">

                        Nama
                        <input type="text" name="nama_user"
                        class="form-control mb-2" required>

                        Username
                        <input type="text" name="username"
                        class="form-control mb-2" required>
                        
                        Password
                        <input type="password" name="password"
                        class="form-control mb-2" required>

                        Role 
                        <select name="role" class="form-control mb-2">
                            <option value="Admin">Admin</option>
                            <option value="Cashier">Cashier</option>
                        </select>

                        <button type="submit" class="btn btn-success btn-block"
                        name="simpan_user">
                            Save
                        </button>
                    </form>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>