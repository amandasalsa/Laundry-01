<?php
include("connection.php");

if (isset($_POST["simpan_member"])) {
    // tampung data input pelanggan dari user
    
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $tlp = $_POST["tlp"];

    //membuat perintah sql untuk insert data ke table pelanggan
    $sql = "insert into member values
    ('','$nama','$alamat','$jenis_kelamin','$tlp')";

    //eksekusi perintah sql
    $tambah = mysqli_query($connect, $sql);

    //direct ke halaman list-pelanggan
    if ($tambah) {
        header('Location:list_member.php');
    } else {
        printf('Gagal'.mysqli_error($connect));
        exit();
    }

# untuk update

}else if(isset($_POST["edit_member"])){
        # menampung dulu data yang akan di update
        $id_member = $_POST["id_member"];
        $nama = $_POST["nama"];
        $alamat = $_POST["alamat"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $tlp = $_POST["tlp"];

        $sql = "update member set nama='$nama', alamat='$alamat',
        jenis_kelamin ='$jenis_kelamin', tlp='$tlp' where id_member='$id_member'";
        
        $edit = mysqli_query($connect, $sql);
        
        if ($edit) {
            header('Location:list_member.php');
        } else {
            printf('Gagal'.mysqli_error($connect));
            exit();
        }
        
}
?>