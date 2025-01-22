        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $name; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo base_url('assets/sb-admin/img/') . $image; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Siap untuk Keluar ?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Pilih "Keluar" di bawah jika Anda siap mengakhiri sesi saat ini.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <!-- nggon var_dump -->

                    <!-- alert data kosong -->
                    <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= validation_errors() ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif ?>

                    <!-- Jika Tambah data berhasil -->
                    <?= $this->session->flashdata('message') ?>

                    <!-- Jika Tambah data Gagal di Controller -->
                    <?= $this->session->flashdata('error') ?>

                    <!--  -->
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                                data-target="#tambahsubmenuModal">Tambah Submenu</button>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">SubMenu</th>
                                        <th scope="col">Url</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                        
                                    <?php foreach ($subMmenu as $m) : ?>
                                    <tr>
                                        <td><?= $i;?></td>
                                        <td><?= $m['menu'] ?></td>
                                        <td><?= $m['title'] ?></td>
                                        <td><?= $m['url'] ?></td>
                                        <td><?= $m['icon'] ?></td>
                                        <td><?= $m['is_active'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editsubmenuModal<?= $m['id_sub_menu'] ?>">Edit</button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletesubmenuModal<?= $m['id_sub_menu'] ?>">Hapus</button>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal Tambah -->
            <div id="tambahsubmenuModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Sub Menu Baru</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/submenu') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title">Nama Sub Menu</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Sub Menu Title...">
                                </div>
                                <div class="form-group">
                                    <label for="menu">Pilih Tujuan Menu</label>
                                    <select name="menu_id" id="menu_id" class="form-control"
                                        aria-label="Default select example">
                                        <?php foreach($data_menu as $menu) : ?>
                                        <option value="<?= $menu['id']?>"><?= $menu['menu']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="url">Sub Menu Url - Link</label>
                                    <input type="text" class="form-control" id="url" name="url"
                                        placeholder="Sub Menu Url...">
                                </div>
                                <div class="form-group">
                                    <label for="icon">Pilih Sub Menu Icon</label>
                                    <div class="row mb-2">
                                        <!-- kolom kiri -->
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-tachometer-alt" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-tachometer-alt"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-user-edit" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-user-edit"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-folder" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-folder"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-file" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-file"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-shopping-bag" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-shopping-bag"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- kolom kanan -->
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-user-alt" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-user-alt"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-folder-open" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-folder-open"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-user-tie" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-user-tie"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fa fa-fw fa-pen" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fa fa-fw fa-pen"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fa fa-fw fa-bookmark" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fa fa-fw fa-bookmark"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Note! Pilih satu Icon</label>       
                                    <!-- <input type="text" class="form-control" id="icon" name="icon"
                                        placeholder="Sub Menu Icon..."> -->
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_active"
                                            id="is_active" checked>
                                        <label class="form-check-label" for="is_active">
                                            Set Sub Menu Aktif ?
                                        </label>
                                    </div>
                                </div>
                                <label>Note! Ceklist submenu jika dibuat aktif</label>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <?php foreach($subMmenu as $m) : ?>
                <div id="editsubmenuModal<?= $m['id_sub_menu'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Sub Menu</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/UpdatesubMenu/' . $m['id_sub_menu']) ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                <input type="hidden" class="form-control" id="id_sub_menu" name="id_sub_menu" value="<?= $m['id_sub_menu'] ?>"
                                placeholder="Sub Menu Title...">                          
                                    <label for="title">Nama Sub Menu</label>
                                    <input type="text" class="form-control" id="title" name="title" value="<?= $m['title'] ?>"
                                        placeholder="Sub Menu Title...">
                                </div>
                                <div class="form-group">
                                    <label for="menu">Pilih Tujuan Menu</label>
                                    <select name="menu_id" id="menu_id" class="form-control"
                                        aria-label="Default select example">
                                        <?php foreach($data_menu as $menu) : ?>
                                        <option value="<?= $menu['id']?>"><?= $menu['menu']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="url">Sub Menu Url - Link</label>
                                    <input type="text" class="form-control" id="url" name="url" value="<?= $m['url'] ?>"
                                        placeholder="Sub Menu Url...">
                                </div>
                                <div class="form-group">
                                    <label for="icon">Pilih Sub Menu Icon</label>
                                    <div class="row mb-2">
                                        <!-- kolom kiri -->
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-tachometer-alt" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-tachometer-alt"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-user-edit" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-user-edit"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-folder" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-folder"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-file" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-file"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-shopping-bag" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-shopping-bag"></i>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- kolom kanan -->
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-user-alt" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-user-alt"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-folder-open" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-folder-open"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fas fa-fw fa-user-tie" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fas fa-fw fa-user-tie"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fa fa-fw fa-pen" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fa fa-fw fa-pen"></i>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    value="fa fa-fw fa-bookmark" name="icon" id="icon">
                                                <label class="form-check-label" for="icon">
                                                    <i class="fa fa-fw fa-bookmark"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <label>Note! Pilih satu Icon</label>       
                                    <!-- <input type="text" class="form-control" id="icon" name="icon"
                                        placeholder="Sub Menu Icon..."> -->
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1" name="is_active"
                                            id="is_active" checked>
                                        <label class="form-check-label" for="is_active">
                                            Set Sub Menu Aktif ?
                                        </label>
                                    </div>
                                </div>
                                <label>Note! Ceklist submenu jika dibuat aktif</label>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach ?>


            <!-- Modal Hapus Submenu -->
            <?php foreach($subMmenu as $m) : ?>
            <div id="deletesubmenuModal<?= $m['id_sub_menu'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Menu</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/HapussubMenu/' . $m['id_sub_menu'])?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?= $m['id_sub_menu'] ?>">
                                    <input type="hidden" class="form-control" name="menu" value="<?= $m['menu'] ?>">
                                    <h6 class="text-center">Anda yakin mau hapus menu ini?</h6>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
 <?php endforeach ?>