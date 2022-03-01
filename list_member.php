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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>List Member</title>

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

    <body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">
                <h2 class="text-dark text-center"><b>D'Laundry Member</b></h2>
                <a href="form_member.php">
                    <button class="btn btn-danger mb-2 form-control">
                        Add Member
                    </button>
                </a>
            </div>

            <div class="card-body">
                <form action="list_member.php" method="get">
                    <input type="text" name="search" class="form-control mb-2"
                    placeholder="Search">
                </form>
                
                <ul class="list-group">
                <?php
                include("connection.php");
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];

                    $sql = "select * from member where id_member like '%$search%'
                    or nama like '%$search%'
                    or alamat like '%$search%'
                    or jenis_kelamin like '%$search%'
                    or tlp like '%$search%'";
                }else {
                    $sql = "select * from member";
                }

                $query = mysqli_query($connect, $sql);
                while ($member = mysqli_fetch_array($query)) {
                    ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-9 col-md-10">
                                <h4><b><?php echo $member["nama"];?></b></h4>
                                <h6>Address : <?php echo $member["alamat"];?></h6>
                                <h6>Gender : <?php echo $member["jenis_kelamin"];?></h6>
                                <h6>Phone Number : <?php echo $member["tlp"];?></h6>
                            </div>

                            <div class="col-lg-3 col-md-2">
                                <a href="form_member.php?id_user=<?php echo $member["id_member"];?>"
                                    onclick="return confirm('Edit this Member?')">
                                    <button class="btn btn-block btn-warning text-white">
                                        Edit
                                    </button>
                                </a>
                                
                                <a href="delete_member.php?id_member=<?=$member["id_member"];?>"
                                    onclick="return confirm('Delete this Member?')">
                                    <button class="btn btn-block btn-danger">
                                        Delete
                                    </button>
                                </a>
                        </div>
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