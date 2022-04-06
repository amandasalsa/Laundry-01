<?php 
session_start();
# jika saat load halaman ini, pastikan telah login sebagai user
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
    <title>Transaksi - D'Laundry</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="background">
    <div class="container">
        <div class="card col-lg-6 mx-auto">
            <div class="card-header bg-white">
                <h2 class="login text-center mt-2 text-warning">
                    Transaction
                </h2>
            </div>

            <div class="card-body">
            <?php
            if (isset($_GET["id_transaksi"])) {
                include("connection.php");
                $id_transaksi = $_GET["id_transaksi"];
                $sql = "select * from transaksi where id_transaksi='$id_transaksi'";

                // eksekusi perintah sql
                $ubah = mysqli_query($connect, $sql);

                // konversi hasil query ke array
                $transaksi = mysqli_fetch_array($ubah);
                ?>
                <form action="process_transaksi.php" method="post"
                onsubmit="return confirm('Edit this Transaction?')">
                
                ID Transaction
                <input type="text" name="id_transaksi" class="form-control mb-2"
                value="<?=$transaksi["id_transaksi"];?>" readonly>

                Laundry Date
                <input type="text" name="tgl_laundry" class="form-control mb-2"
                value="<?=$transaksi["tgl_laundry"];?>" readonly>

                Member Name
                <?php
                include("connection.php");
                $sql = "select * from member
                inner join transaksi
                on member.id_member = transaksi.id_member
                where id_transaksi = '$id_transaksi'";
                $hasil = mysqli_query($connect, $sql);
                while($member = mysqli_fetch_array($hasil)){
                    ?>
                    <input type="text" name="id_member" class="form-control mb-2"
                    value="<?=$member["nama"];?>" readonly>
                    <?php
                }
                ?>

                User Name
                <?php
                include("connection.php");
                $sql = "select * from user
                inner join transaksi
                on user.id_user = transaksi.id_user
                where id_transaksi = '$id_transaksi'";
                $hasil = mysqli_query($connect, $sql);
                while($user = mysqli_fetch_array($hasil)){
                    ?>
                    <input type="text" name="id_user" class="form-control mb-2"
                    value="<?=$user["nama_user"];?>" readonly>
                    <?php
                }
                ?>

                Laundry Packages
                <?php
                include("connection.php");
                $id_transaksi = $transaksi["id_transaksi"];
                    $sql = "select * from detil_transaksi 
                    inner join paket
                    on detil_transaksi.id_paket = paket.id_paket
                    where id_transaksi = '$id_transaksi'";
                $hasil = mysqli_query($connect, $sql);
                while($paket = mysqli_fetch_array($hasil)){
                    ?>
                    <input type="text" name="id_paket[]" class="form-control mb-2"
                    value="<?=$paket["jenis"];?>" readonly>
                    
                    Total
                    <input type="number" name="qty" class="form-control" required
                    value="<?=$detil_transaksi["qty"];?>" readonly>
                <?php
                }
                ?>

                Duration
                <input type="text" name="batas_waktu" class="form-control mb-2"
                value="<?=$transaksi["batas_waktu"];?>" readonly>

                Category
                <select name="kategori" class="form-control mb-2" readonly>
                    <option value="<?=$transaksi["kategori"];?>" selected><?=$transaksi["kategori"];?></option>
                </select>

                Status
                <select name="status" class="form-control mb-2">
                    <option value="<?=$transaksi["status"];?>" selected><?=$transaksi["status"];?></option>
                    <option value="Baru">New</option>
                    <option value="Proses">Process</option>
                    <option value="Selesai">Finished</option>
                    <option value="Diambil">Taken</option>
                </select>

                Payment
                <select name="pembayaran" class="form-control mb-2">
                    <option value="<?=$transaksi["pembayaran"];?>" selected><?=$transaksi["pembayaran"];?></option>
                    <option value="Terbayar">Terbayar</option>
                    <option value="Belum Terbayar">Belum Terbayar</option>
                </select>

                Total Pay
                <input type="text" name="total" class="form-control mb-2"
                value="<?=$transaksi["total"];?>" readonly>

                <button type="submit" class="btn btn-block btn-dark mt-2" name="edit_transaksi">
                    Save Transaction
                </button>
                </form>
                <?php
            }else{
                ?>
                <form action="process_transaksi.php" method="post">
                ID Transaction
                <input type="text" name="id_transaksi"
                class="form-control mb-2"
                readonly
                value="CL-<?=(time())?>"
                required>
                <!-- Tgl transaksi dibuat otomatis -->
                <?php
                date_default_timezone_set('Asia/Jakarta');
                ?>
                Laundry Date
                <input type="text" name="tgl_laundry"
                class="form-control mb-2"
                value="<?=(date("Y-m-d H:i:s"))?>">
                <!-- pilih member dengan nama -->
                Name
                <select name="id_member" class="form-control mb-2">
                <?php
                include("connection.php");
                $sql = "select * from member";
                $hasil = mysqli_query($connect, $sql);
                while($member = mysqli_fetch_array($hasil)){
                    ?>
                    <option value="<?=($member["id_member"])?>">
                        <?=($member["nama"])?>
                    </option>
                    <?php
                }
                ?>
                </select>
                
                
                <!-- user ambil dari data login -->
                <input type="hidden" name="id_user"
                value="<?=($_SESSION["user"]["id_user"])?>">

                User
                <input type="text" name="nama_user"
                class="form-control mb-2" readonly
                value="<?=($_SESSION["user"]["nama_user"])?>">

                <!-- tampilan pilihan paket yang akan disewa -->
                Choose the Package to be Laundered
                <select name="id_paket[]" class="form-control mb-2" required >
                    <?php
                    $sql = "select * from paket";
                    $hasil = mysqli_query($connect, $sql);
                    while ($paket = mysqli_fetch_array($hasil)) {
                        ?>
                        
                        <option value="<?=($paket["id_paket"])?>">
                            Package <?=($paket["id_paket"])?> : 
                            <?=($paket["jenis"].", Harga = Rp ".$paket["harga"])?>
                        </option>
                        <?php
                    }
                    ?>
                </select>

                Total
                <input type="number" name="qty" 
                class="form-control mb-2" required>
                
                Duration (day)
                <input type="number" name="batas_waktu"
                class="form-control mb-2">

                Category
                <select name="kategori" class="form-control mb-2">
                    <option value="Cuci">Cuci</option>
                    <option value="Cuci & Setrika">Cuci & Setrika</option>
                    <option value="Setrika">Setrika</option>
                </select>

                Status
                <select name="status" class="form-control mb-2">
                    <option value="Baru">New</option>
                    <option value="Proses">Process</option>
                    <option value="Selesai">Finished</option>
                    <option value="Diambil">Taken</option>
                </select>
                
                Payment
                <select name="pembayaran" class="form-control mb-2">
                    <option value="Belum Terbayar">Belum Terbayar</option>
                    <option value="Terbayar">Terbayar</option>
                </select>

                <button type="submit" class="btn btn-block btn-dark mt-2" name="simpan_transaksi">
                    Add Transaction
                </button>
                </form>
            </div>
            <?php
            }
            
            ?>
        </div>
    </div>
</body>
</html>