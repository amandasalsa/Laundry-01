<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>List Paket</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<a href="#" class="img logo rounded-circle mb-5" style="background-image: url(images/logo1.jpg);"></a>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
            
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="list_user.php">List User</a>
                </li>
                <li>
                    <a href="list_member.php">List Member</a>
                </li>
                <li>
                    <a href="list_paket.php">List Package</a>
                </li>
                </ul>
                <li>
                <a href="list_transaksi.php">Transaction</a>
	              </li>
	          </li>
	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Form</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="form_user.php">Form User</a>
                </li>
                <li>
                    <a href="form_member.php">Form Member</a>
                </li>
                <li>
                    <a href="form_paket.php">Form Package</a>
                </li>
                <li>
                    <a href="form_transaksi.php">Form Transaction</a>
                </li>
              </ul>
	          </li>

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Amanda Salsabilla <i class="icon-heart" aria-hidden="true"></i><a href="https://colorlib.com" target="_blank">Colorlib.com</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="login text-center">List Transaction</h4>
                    <a href="form_transaksi.php" class="text-center text-white">
                        <button class="btn btn-outline-danger form-control">
                            Add Transaction
                        </button>
                    </a>
            </div>

            <div class="card-body">
                <ul class="list-group">
                    <?php
                        include("connection.php");
                        $sql ="select transaksi.*, member.*, user.*, pembayaran.id_pembayaran, pembayaran.tgl_bayar
                        from transaksi inner join member
                        on member.id_member=transaksi.id_member
                        inner join user
                        on transaksi.id_user=user.id_user
                        left outer join pembayaran
                        on transaksi.id_transaksi=pembayaran.id_transaksi
                        order by transaksi.id_transaksi desc";

                        $hasil = mysqli_query($connect, $sql);
                        while ($transaksi = mysqli_fetch_array($hasil)) {
                    ?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">ID</small>
                                    <h5><?=($transaksi["id_transaksi"])?></h5>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Member</small>
                                    <h5><?=($transaksi["nama"])?></h5>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">User</small>
                                    <h5><?=($transaksi["nama_user"])?></h5>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Transaction Date</small>
                                    <h5><?=($transaksi["tgl_laundry"])?></h5>  
                                </div>
                                <div class="row col-lg-2 col-md-2">
                                    <div class="col-lg-6 col-md-6 mt-2">
                                        <a href="form_transaksi.php?id_transaksi=<?php echo $transaksi["id_transaksi"];?>">
                                            <button class="btn btn-outline-danger form-control btn-block">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </a> 
                                </div>
                                <div class="col-lg-6 col-md-6 mt-2">
                                        <a href="detail_transaksi.php?id_transaksi=<?php echo $transaksi["id_transaksi"];?>">
                                            <button class="btn btn-outline-danger  form-control btn-block">
                                                <i class="fa fa-info"></i>
                                            </button>
                                        </a> 
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-6">
                                    <small class="text-danger">List Laundry</small>
                                        <ul>
                                        <?php
                                        $id_transaksi = $transaksi["id_transaksi"];
                                        $sql = "select * from detil_transaksi 
                                        inner join paket
                                        on detil_transaksi.id_paket = paket.id_paket
                                        where id_transaksi = '$id_transaksi'";

                                        //eksekusi
                                        $hasil_paket = mysqli_query($connect, $sql);
                            
                                        //dijadikan array
                                        while ($paket = mysqli_fetch_array($hasil_paket)) {
                                        ?>
                                            <li>
                                                <h6>
                                                    <?=($paket["jenis"])?>
                                                    <i class="text-secondary">
                                                        <br><small>(With Price Rp<?=($paket["harga"])?>)</small>
                                                        <br><small>(Transaction duration  <?=($transaksi["batas_waktu"])?> hari)</small>
                                                    </i>
                                                </h6>
                                            </li>
                                        
                                        </ul>
                                </div>

                                <div class="col-lg-2 col-md-6">
                                    <small class="text-danger">Total</small></br>
                                            <h5><?=($paket["qty"])?></h5>
                                </div>
                                <?php
                                        }
                                        ?>

                                <?php if ($transaksi["id_pembayaran"] ==  null){?>
                                <div class="col-lg-6 col-md-6">
                                    <small class="text-danger">Status</small></br>
                                    <div class="badge badge-pill badge-dark">
                                        <?=($transaksi["status"])?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <small class="text-danger">Payment</small></br>
                                    <div class="badge badge-pill badge-danger">
                                        <?=($transaksi["pembayaran"])?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="process_pembayaran.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Has the package been completed and paid for?')">
                                        <button class="btn btn-danger btn-block">
                                            <b>Pay Rp<?=($transaksi["total"])?></b>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="delete_process.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Delete this Transaction?')">
                                        <button class="btn btn-dark btn-block">
                                            Delete
                                        </button>
                                    </a>
                                </div>
                            </div>


                                <?php } else if($transaksi["id_pembayaran" > 0]) {?>
                                <div class="col-lg-2 col-md-2">
                                    <small class="text-danger">Status</small></br>
                                        <div class="badge badge-pill badge-dark">
                                            <?=($transaksi["status"])?>
                                        </div>
                                </div>
                                <div class="col-lg-2 col-md-2">
                                    <?php
                                    $id_transaksi = $transaksi["id_transaksi"];
                                    $sql = "update transaksi set pembayaran = 'Terbayar'
                                        where id_transaksi='$id_transaksi'";
                                    $edit = mysqli_query($connect, $sql);

                                    if ($edit) {
                                        $sql2 = "select * from transaksi where id_transaksi='$id_transaksi'";

                                        //eksekusi
                                        $trans = mysqli_query($connect, $sql2);
                                        while($transaksi = mysqli_fetch_array($trans)){
                                    ?>
                                            <small class="text-danger">Payment</small></br>
                                            <div class="badge badge-pill badge-success">
                                                <?=($transaksi["pembayaran"])?>
                                            </div>
                                </div>
                                      
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="process_pembayaran.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Has the package been completed and paid for?')">
                                        <button class="btn btn-danger btn-block" disabled>
                                            <b>Paid  Rp<?=$transaksi["total"]?></b>
                                        </button>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-md-6 mt-2">
                                    <a href="delete_process.php?id_transaksi=<?=($transaksi["id_transaksi"])?>" 
                                        onclick="return confirm('Delete this Transaction?')">
                                        <button class="btn btn-dark btn-block">
                                            Delete
                                        </button>
                                    </a>
                                </div>
                                        <?php } ?>
                                    <?php } ?>
                            </div>
                            <?php }?>    
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>