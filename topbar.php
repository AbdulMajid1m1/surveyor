<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav ">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li>
      <a class="nav-link text-white top-bar-text" href="./" role="button">
        <large><b>Online Survey System</b></large>
      </a>
    </li>
  </ul>

  <!-- Avatar or Font Awesome Icon -->
  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a href="profile_completion.php?action=profile_information" style="text-decoration: none; color: inherit;">
        <div class="d-flex align-items-center avatar-div" style="background-color: white; border-radius: 50%;">
          <?php
          // Check if user profile image exists in the session
          if (isset($_SESSION['login_Link_to_Photo'])) {
            $profileImage = $_SESSION['login_Link_to_Photo'];
            echo '<img src="' . $profileImage . '" alt="User Avatar" class="rounded-circle img-responsive nav-avatar" style="width: 40px; height: 40px; vertical-align: middle;">';
          } else {
            // Display a Font Awesome icon as a fallback with CSS styles
            echo '<i class="fas fa-user-circle fa-2x text-white" style="vertical-align: middle;"></i>';
          }
          ?>
        </div>
      </a>
    </li>

    </div>
    </li>
  </ul>
</nav>
<!-- /.navbar -->


<style>
  @media (max-width: 350px) {

    /* Adjust the padding for screens with a width of 350px or smaller */
    .top-bar-text {
      padding-right: .4rem !important;
      padding-left: .4rem !important;

    }


    .nav-avatar {
      width: 35px !important;
      height: 35px !important;
    }

    .avatar-div {
      margin-top: 2px;
    }
  }
</style>