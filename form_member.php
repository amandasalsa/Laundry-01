<?php
session_start();
# jika saat load halaman ini, pastikan telah login sebagai petugas
if (!isset($_SESSION["user"])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member - D'Laundry</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="background">
    <div class="container">
        <div class="card col-lg-6 mx-auto">
            <div class="card-header bg-white text-center">
                <h1 class="login">D'Laundry</h1>
                <h3 class="login text-warning">- Form Member -</h3>
            </div>

            <div class="card-body">
                <?php
                if (isset($_GET["id_member"])) {
                    //memeriksa ketika load file ini, apakah membawa
                    //data GET dgn nama "id_member"
                    //jika true, form member digunakan untuk edit

                    # mengakses data member dari id_member yang dikirim
                    include("connection.php");
                    $id_member = $_GET["id_member"];
                    $sql = "select * from member where id_member='$id_member'";

                    //eksekusi perintah sql
                    $ubah = mysqli_query($connect, $sql);

                    // konversi hasil query ke bentuk array
                    $member = mysqli_fetch_array($ubah);
                ?>

                    <form action="process_member.php" method="post"
                    onsubmit="return confirm('Edit this Member?')">
                    
                        ID Member
                        <input type="text" name="id_member"
                        class="form-control mb-2" required
                        value="<?=$member["id_member"];?>" readonly>

                        Nama
                        <input type="text" name="nama"
                        class="form-control mb-2" required
                        value="<?=$member["nama"];?>">

                        Alamat
                        <input type="text" name="alamat"
                        class="form-control mb-2" required
                        value="<?=$member["alamat"];?>">

                        Jenis Kelamin
                        <select name="jenis_kelamin" class="form-control mb-2">
                            <option value="<?=$member["jenis_kelamin"];?>" selected><?=$member["jenis_kelamin"];?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        

                        Nomor Telepon
                        <input type="number" name="tlp"
                        class="form-control mb-2" required
                        value="<?=$member["tlp"];?>">

                        <button type="submit" class="btn btn-success btn-block"
                        name="edit_member">
                            Save
                        </button>
                    </form>
                <?php
                }else{
                    //jika false, menggunakan ini untuk insert
                ?>
                    <form action="process_member.php" method="post">
    
                        Nama
                        <input type="text" name="nama"
                        class="form-control mb-2" required>

                        Alamat
                        <input type="text" name="alamat"
                        class="form-control mb-2" required>

                        Jenis Kelamin
                        <select name="jenis_kelamin" class="form-control mb-2">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        
                        Nomor Telepon
                        <input type="text" name="tlp"
                        class="form-control mb-2" required>

                        <button type="submit" class="btn btn-danger btn-block"
                        name="simpan_member">
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