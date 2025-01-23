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
                                    src="<?php echo base_url('assets/img/profile/') . $image; ?>">
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
                    <!-- Flashdata session-->
                    <?= $this->session->flashdata('message') ?>
                    <div class="row">
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Change your Password Account</div>
                                <div class="card-body">
                                    <?= form_open_multipart('user/changepassword') ?>
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="current_password">Current Password</label>
                                        <input class="form-control" id="current_password" name="current_password"
                                            type="password">
                                            <?= form_error('current_password', '<label class="small mb-1 text-danger">', '</label>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="new_password1">New Password</label>
                                        <input class="form-control" id="new_password1" name="new_password1"
                                            type="password" placeholder="Enter your new password">
                                        <!-- error data password -->
                                        <?= form_error('new_password1', '<label class="small mb-1 text-danger">', '</label>') ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="new_password2">Retype Password</label>
                                        <input class="form-control" id="new_password2" name="new_password2"
                                            type="password" placeholder="Retype your New password">
                                        <!-- error data password -->
                                        <?= form_error('new_password2', '<label class="small mb-1 text-danger">', '</label>') ?>
                                    </div>
                                    <!-- Save changes button-->
                                    <button class="btn btn-primary" type="submit" value="upload">Simpan</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->