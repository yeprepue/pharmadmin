  <!-- Main Sidebar Container -->
  <div class="container">
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <!-- Brand Logo -->
          <a href="index3.html" class="brand-link">
              <img src="<?php echo base_url(); ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">PharmAdmin</span>
          </a>

          <!-- Sidebar -->
          <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                      <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                      <label id="datosUsuario" class="d-block text-white"><?php echo $this->session->userdata('sNombre') ?></label>
                  </div>
              </div>

              <!-- Sidebar Menu -->
              <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="modulo-item">

                  </ul>
              </nav>
          </div>
          <!-- /.sidebar -->
      </aside>
  </div>
  <div class="content-wrapper">