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