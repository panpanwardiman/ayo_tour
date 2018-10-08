<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> -->
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php echo (isset($halaman) && $halaman == 'dashboard') ? '<li class="active">' : '<li>'?>
          <a href="<?php echo site_url('at-admin') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php echo (isset($halaman) && $halaman[0] == '') ? '<li class="active treeview">': '<li class="treeview">' ?>
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Packages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php echo (isset($halaman) && $halaman[1] == '') ? '<li class="active">' : '<li>' ?>
              <a href="<?php echo site_url('at-admin/package') ?>"><i class="fa fa-circle-o"></i> All Packages</a></li>
            <?php echo (isset($halaman) && $halaman[1] == '') ? '<li class="active">' : '<li>' ?>
              <a href="<?php echo site_url('at-admin/package/create') ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
          </ul>
        </li>
        <?php echo (isset($halaman) && $halaman == 'service') ? '<li class="active">': '<li>' ?>
          <a href="<?php echo site_url('at-admin/service') ?>">
            <i class="fa fa-tasks"></i> <span>Service</span>
          </a>
        </li>
        <?php echo (isset($halaman) && $halaman[0] == 'articles') ? '<li class="active treeview">': '<li class="treeview">' ?>
          <a href="#">
            <i class="fa fa-newspaper-o"></i> <span>Articles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php echo (isset($halaman) && $halaman[1] == 'all article') ? '<li class="active">' : '<li>' ?>
              <a href="<?php echo site_url('at-admin/article') ?>"><i class="fa fa fa-list"></i> All Articles</a></li>
            <?php echo (isset($halaman) && $halaman[1] == 'new article') ? '<li class="active">' : '<li>' ?>
              <a href="<?php echo site_url('at-admin/article/create') ?>"><i class="fa fa-thumb-tack"></i> Add New</a></li>
          </ul>
        </li>
        <?php echo (isset($halaman) && $halaman == 'category') ? '<li class="active">': '<li>' ?>
          <a href="<?php echo site_url('at-admin/category') ?>">
            <i class="fa fa-tag"></i> <span>Categories</span>
          </a>
        </li>
        <?php echo (isset($halaman) && $halaman == 'tag') ? '<li class="active">': '<li>' ?>
          <a href="<?php echo site_url('at-admin/tag') ?>">
            <i class="fa fa-tags"></i> <span>Tags</span>
          </a>
        </li>
        <?php echo (isset($halaman) && $halaman == 'slider') ? '<li class="active">': '<li>' ?>
          <a href="<?php echo site_url('at-admin/slider') ?>">
            <i class="fa fa-image"></i> <span>Slider</span>
          </a>
        </li>
        <?php echo (isset($halaman) && $halaman[0] == 'users') ? '<li class="active treeview">': '<li class="treeview">' ?>
          <a href="<?php echo site_url('at-admin/user') ?>">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php echo (isset($halaman) && $halaman[1] == 'all users') ? '<li class="active">' : '<li>' ?>
              <a href="<?php echo site_url('at-admin/user') ?>"><i class="fa fa fa-list"></i> All Users</a></li>
            <?php echo (isset($halaman) && $halaman[1] == 'new users') ? '<li class="active">' : '<li>' ?>
              <a href="<?php echo site_url('at-admin/user/create') ?>"><i class="fa fa-thumb-tack"></i> Add New</a></li>
          </ul>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
