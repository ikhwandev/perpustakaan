                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2 img-thumbnail" src="<?php echo base_url('assets/img/profile/') . $image ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <?= form_open_multipart('admin/edit') ?>
                                    <!-- Form Group (username)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="email">Email</label>
                                        <input class="form-control" id="email" name="email" type="text" value="<?= $email; ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="name">Full name (nama akan tampil di
                                            layar)</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name" value="<?= $name; ?>">
                                        <!-- alert data nama kosong -->
                                        <?= form_error('name', '<label class="small mb-1 text-danger">', '</label>') ?>
                                    </div>

                                    <label class="small mb-1">Pilih gambar yang di upload</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="image" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
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