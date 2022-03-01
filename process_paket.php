<?php
include ("connection.php");
#mengecek apakah data yang sama dgn yg ditampung
if (isset($_POST["simpan_paket"])) {
    # menampung data yg dikirim ke dalam variable
    $id_paket = $_POST["id_paket"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

        # proses insert data ke tabel paket
        $sql = "insert into paket values
        ('','$harga','$jenis')";

        # eksekusi perintah SQL
        $tambah = mysqli_query($connect, $sql);

         //direct ke halaman list_paket
    if ($tambah) {
        header('Location:list_paket.php');
    } else {
        printf('Gagal'.mysqli_error($connect));
        exit();
    }

# utk edit
}else if (isset($_POST["edit_paket"])) {
    # menampung data yg dikirim ke dalam variable
    $id_paket = $_POST["id_paket"];
    $jenis = $_POST["jenis"];
    $harga = $_POST["harga"];

            $sql = "update paket set
            harga='$harga',jenis='$jenis' where id_paket='$id_paket'";
            
            $edit = mysqli_query($connect,$sql);

            if ($edit) {
                # jika update berhasil
                header('Location:list_paket.php');
            } else {
                # jika update gagal
                printf('Gagal'.mysqli_error($connect));
                exit();
            }
            
    }
    

?>