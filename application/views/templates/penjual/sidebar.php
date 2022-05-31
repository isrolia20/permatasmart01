<!-- Sidebar -->
<ul class="navbar-nav bg-warning sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('Penjual') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Permata<sup>smart</sup></div>
    </a>

    <!-- QUERY MENU -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT user_menu.id, user_menu.menu
                                FROM user_menu JOIN user_access_menu
                                ON user_menu.id = user_access_menu.menu_id
                                WHERE user_access_menu.role_id = $role_id
                                ORDER BY user_access_menu.menu_id ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>
    <!-- END QUERY MENU -->

    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading"><?= $m['menu']; ?></div>

        <!-- PREPARE SUBMENU SESUAI MENU -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT * FROM user_sub_menu JOIN user_menu
                                        ON user_sub_menu.menu_id = user_menu.id
                                        WHERE user_sub_menu.menu_id = $menuId
                                        AND user_sub_menu.is_active = 1
                                        ORDER BY user_sub_menu.urutan ASC";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        // echo '<pre>';
        // print_r($subMenu);
        // echo '</pre>';
        // die;
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>

                <li class="nav-item active">
                    <a href="<?= base_url($sm['url']) ?>" class="nav-link">

                    <?php else : ?>
                <li class="nav-item">

                    <a href="<?= base_url($sm['url']) ?>" class="nav-link">

                    <?php endif; ?>

                    <i class="<?= $sm['icon']; ?>"></i>

                    <span>
                        <?= $sm['title']; ?>
                    </span>
                    </a>
                </li>
            <?php endforeach; ?>

        <?php endforeach; ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            Session
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="#exampleModal" data-toggle="modal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= base_url('Auth/logout') ?>" method="post">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin logout?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">