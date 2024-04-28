<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="/security-efficom-seminaire/src/assets/img/logo_vulnerable_app.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/security-efficom-seminaire/src/css/fontawesome.all.min.css?v=<?php echo time() ;?>">

    <!-- Import CSS -->
    <link rel="stylesheet" href="/security-efficom-seminaire/src/css/navbar.css?v=<?php echo time(); ?>">

    <title>Navbar</title>
</head>
<body>

    <div id="navbar" style="z-index:1000;">
      <nav style="position: relative; z-index: 999;">
        <a href="#"><img class="logoNav" src="/security-efficom-seminaire/src/assets/img/logo_vulnerable_app.png" alt="Home"></a>
        <div class="nav-right">
          <div class="dropdown">
            <a class="" href="/security-efficom-seminaire/src/php/home.php"><button class="dropbtn accountData">Home
            </button></a>
          </div>
		  <div class="dropdown">
            <a class="" href="/security-efficom-seminaire/src/php/upload_image.php"><button class="dropbtn accountData">Ajouter une image
            </button></a>
          </div>
		  <div class="dropdown">
            <a class="" href="/security-efficom-seminaire/src/php/profile.php"><button class="dropbtn accountData">Profile
            </button></a>
          </div>
          <div class="dropdown">
            <a class="" href="/security-efficom-seminaire/src/php/deconnexion.php"><button class="dropbtn accountData">Deconnexion
            </button></a>
          </div>
        </div>
      </nav>
    </div>
</body>
</html>