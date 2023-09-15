<?php include('db_connect.php') ?>
<!-- Info boxes -->


<?php if (isset($_SESSION['login_Surveyor_ID'])): ?>


  <div class="row">
    <!-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Subscribers</span>
                <span class="info-box-number">
                  <?php echo $conn->query("SELECT * FROM rx_survey_data where surveyor_id = '$_SESSION[login_Surveyor_ID]'")->num_rows; ?>
                </span>
              </div>
            </div>
          </div> -->
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-6">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Surveyor ID</span>
          <span class="info-box-number">
            <?php
            $surveyor_id = $_SESSION['login_Surveyor_ID'];
            echo $surveyor_id;
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-6">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-poll-h"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Total Survey</span>
          <span class="info-box-number">
            <?php
            $surveyor_id = $_SESSION['login_Surveyor_ID'];
            $query = "SELECT COUNT(*) as total_surveys FROM rx_survey_data WHERE surveyor_id = '$surveyor_id'";
            $result = $conn->query($query);
            if ($result && $result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo $row['total_surveys'];
            } else {
              echo "0";
            }
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>



    <!-- /.col -->
  </div>

<?php else: ?>
  <!-- // redirect to loin  -->

  <script>
    window.location.href = 'login.php';
  </script>
<?php endif; ?>

<!--  include survey_list page -->
<?php include('survey_list.php') ?>