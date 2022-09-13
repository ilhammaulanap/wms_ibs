  <?php
    $name = $this->session->userdata('wh_name');
    $name = $name == null ? 'No User' : $name;
    ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="d-flex flex-row p-3" style="height:64px">
          <div class="hidden-collapse text-white w-100" style="white-space:nowrap;position:absolute">
              <p class="mb-1"><a class="text-white" href="#"><strong class="widget-user-username">Warehouse System</strong></a></p>
              <p class="mb-0 small"><i class="fas fa-user mr-1"></i> <?= $name; ?></p>
          </div>
          <div class="mx-auto" style="position:absolute;width:100%;right:0">
              <a class="nav-link flex-center ignore" href="<?= site_url() ?>" style="margin-left:auto;width:74px;background:#2e3b48;padding:0 0 1rem 0">
                  <div class="profile-user-img img-fluid img-circle p-0 " style="width: 35px; height: 35px; border-color: rgb(255, 255, 255); background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(#);" alt="Profile picture"></div>
              </a>
          </div>
      </div>
      <!-- Brand Logo -->
      <!-- <a class="navbar-brand" href="<?= site_url() ?>">
          WAREHOUSE
          <span class="sub">MANAGEMENT SYSTEM</span>
      </a> -->

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?= base_url('assets/') ?>dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <p class="text-white"><?= $this->session->userdata('wh_name'); ?></p>
              </div>
          </div> -->

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class-->
                  <?php
                    $level = $this->session->userdata('wh_level');
                    $this->load->view('layout/sidebar-' . $level);
                    ?>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>