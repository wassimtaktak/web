<link rel="stylesheet" href="../css/bootstrap.css">
    <!-- font awesome style -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="../stylelog.css">
    <!-- responsive style -->
    <link href="../css/responsive.css" rel="stylesheet" />
<div class="hero_area">
    <div class="bg-box">
      <img src="images//3ejja2.jpg" alt="">
    </div>
        <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <div class="logo">
            <a class="d-block" href="#">
              <img loading="lazy" src="./images/logo2.png" width=160px height=100px alt="Constra">
            </a>
        </div><!-- logo end -->

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
                             <!-- dropdown button.// -->
                             <li class="nav-item dropdown custom-dropdown">
                              <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">starter</a>
                               <ul class="dropdown-menu">
                                <div class="mega-menu d-flex">
                                  <div class="lista">
                                    <ul class="list-unstyled">
                                      <li><a href="menu.php?id=Salad">Salad </a></li>
                                      <li><a href="menu.php?id=Bruschetta">Bruschetta  </a></li>
                                      <li><a href="menu.php?id=Soup">Soup </a></li>
                                      <li><a href="menu.php?id=Nachos">Nachos </a></li>
                                    </ul>
                                  </div>
                               </ul>
                           </li>
              <!-- dropdown button.// -->
              <li class="nav-item dropdown custom-dropdown">
                <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">main course</a>
                 <ul class="dropdown-menu">
                  <div class="mega-menu d-flex">
                    <div class="lista">
                      <ul class="list-unstyled">
                        <li><a href="menu.php?id=Hamburger">Hamburger </a></li>
                        <li><a href="menu.php?id=Pizza">Pizza</a></li>
                        <li><a href="menu.php?id=Pasta">Pasta </a></li>
                      </ul>
                    </div>
                 </ul>
             </li>
                            <!-- dropdown button.// -->
                            <li class="nav-item dropdown custom-dropdown">
                              <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">dessert</a>
                               <ul class="dropdown-menu">
                                <div class="mega-menu d-flex">
                                  <div class="lista">
                                    <ul class="list-unstyled">
                                      <li><a href="menu.php?id=cheesecake">cheesecake</a></li>
                                      <li><a href="menu.php?id=tiramisu">tiramisu</a></li>
                                      <li><a href="menu.php?id=Cake">Cake</a></li>
                                      <li><a href="menu.php?id=fruit salad">fruit salad</a></li>
                                    </ul>
                                  </div>
                               </ul>
                           </li>
              <li class="nav-item">
                <a class="nav-link" href="#about">about</a>
              </li>
            </ul>
            <!--iconet-->
            <div class="user_option">

            <?php
                if (isset($_SESSION['username']))
                {
                 print' <a href="logout.php" class="user_link">
                    <i class="fa fa-sign-out" aria-hidden="true" style="font-size:22px"></i>
                  </a>
                  <a href="panier.php" class="cart_link">
                  <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:22px"></i>
                  </a>;
                  <a href="profile.php" class="user_link">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  </a>';

                }
                else {
                  print' <a href="login.php" class="user_link">
                  <i class="fa fa-user" aria-hidden="true"></i>
                </a>';
                 }
                
            ?>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>