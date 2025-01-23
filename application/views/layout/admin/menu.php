                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>                 

                    <!-- alert data kosong -->
                    <?= form_error(
                        'menu',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        ', '</div>') ?>

                    <!-- Jika Tambah data berhasil -->
                    <?= $this->session->flashdata('message') ?>

                    <!-- Jika Tambah data Gagal di Controller -->
                    <?= $this->session->flashdata('error') ?>

                    <!--  -->
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahModal">Tambah</button>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Data Menu</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($data_menu as $m) : ?>    
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?= $m['menu'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning mx-2" data-toggle="modal" data-target="#editModal<?= $m['id'] ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $m['id'] ?>">Hapus</button>
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
            <div id="tambahModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Menu Baru</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/menu') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="menu">Nama Menu</label>
                                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Masukkan Nama Menu...">
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


            <!-- Modal Edit -->
<?php foreach($data_menu as $m) : ?>
            <div id="editModal<?= $m['id'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Menu</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/editMenu/' . $m['id'])?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?= $m['id'] ?>">
                                    <label for="menu">Nama Menu</label>
                                    <input type="text" class="form-control" id="menu" name="menu" placeholder="Masukkan Nama Menu..." value="<?= $m['menu'] ?>">
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


            <!-- Modal Hapus -->
<?php foreach($data_menu as $m) : ?>
            <div id="hapusModal<?= $m['id'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Menu</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/hapusMenu/' . $m['id'])?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?= $m['id'] ?>">
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