<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="">
    <a href="javascript:void(0)" class="brand-link ">
      <span
        class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500"
        style="width: 38px;height:50px">
        <?php echo strtoupper(substr($_SESSION['login_First_Name'], 0, 1) . substr($_SESSION['login_Last_Name'], 0, 1)) ?>
      </span>
      <span class="brand-text font-weight-light">
        <?php echo ucwords($_SESSION['login_First_Name'] . ' ' . $_SESSION['login_Last_Name']) ?>
      </span>

    </a>
   
  </div>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
        data-accordion="false">
        <li class="nav-item dropdown">
          <a href="./" class="nav-link nav-home">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>

        </li>
        <?php if (isset($_SESSION['login_Surveyor_ID'])): ?>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li> -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-is-tree nav-edit_survey nav-view_survey">
              <i class="nav-icon fa fa-poll-h"></i>
              <p>
                Survey
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_survey" class="nav-link nav-new_survey tree-item">
                  <i class="fas fa-pen nav-icon"></i> <!-- Changed to a pen icon -->
                  <p>New Survey</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=survey_list" class="nav-link nav-survey_list tree-item">
                  <i class="fas fa-list-ul nav-icon"></i> <!-- Changed to a list icon -->
                  <p>Surveys List</p>
                </a>
              </li>
            </ul>

          </li>


          <li class="nav-item">
            <a href="ajax.php?action=logout" class="nav-link nav-survey_report">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        <?php else: ?>
          <!-- redirect to login page -->

          <script>
            window.location.href = 'login.php';
          </script>

        <?php endif; ?>
      </ul>
    </nav>
  </div>
</aside>
<script>
  $(document).ready(function () {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active')
      console.log($('.nav-link.nav-' + page).hasClass('tree-item'))
      if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
      }
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open')
      }

    }
    $('.manage_account').click(function () {
      uni_modal('Manage Account', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
  })
</script>