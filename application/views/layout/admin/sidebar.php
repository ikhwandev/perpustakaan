        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Query Menu -->

            <?php 
            $role_user = $role_id; 
                 $queryMenu = "SELECT `user_menu`.`id`, `menu`
                               FROM user_menu
                               JOIN user_access_menu ON `user_menu`.`id` = `user_access_menu` . `menu_id`
                               WHERE `user_access_menu`.`role_id` = $role_user
                               ORDER BY `user_access_menu`.`menu_id` ASC";

                $menu = $this->db->query($queryMenu)->result_array(); 
                  
            ?>;

            <!-- Looping Menu -->
            <?php foreach ($menu as $m) : ?>
            <!-- sidebar heading -->
            <div class="sidebar-heading">
                <?= $m['menu']?>
            </div>
            <!-- Siapkan Sub-Menu sesuai Menu -->
            <?php 
                    $querySubMenu = "SELECT *
                               FROM user_sub_menu
                               JOIN user_menu ON `user_sub_menu`.`menu_id` = `user_menu` . `id`
                               WHERE `user_sub_menu`.`menu_id` = {$m['id']}
                               AND `user_sub_menu`.`is_active`= 1";
                    $subMenu = $this->db->query($querySubMenu)->result_array();
                    
                ?>
            <?php foreach($subMenu as $sm) :?>

            <!-- Nav Item - Dashboard -->
            <?php if ($title == $sm['title']) : ?>
            <li class="nav-item active">
                <?php else : ?>
            <li class="nav-item">
                <?php endif; ?>
                    <a class="nav-link pb-0" href="<?= $sm['url']?>">
                        <i class="<?= $sm['icon']?>"></i>
                        <span><?= $sm['title']?></span></a>
            </li>
            <?php endforeach ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

            <?php endforeach ?>


            <!-- Nav Item - Logout -->
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url('auth/login');?>">
                    <i class="fas fa-fw fa-user-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->