                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>
                 
                    <!-- alert data kosong -->
                    <?= form_error(
                        'role',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        ', '</div>') ?>

                    <!-- Jika Tambah data role berhasil -->
                    <?= $this->session->flashdata('message') ?>

                    <!-- Jika Tambah role Gagal di Controller -->
                    <?= $this->session->flashdata('error') ?>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahroleModal">Tambah Role</button>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($role as $r) : ?>    
                                        <tr>
                                            <td><?= $i;?></td>
                                            <td><?= $r['role'] ?></td>
                                            <td>
                                                <a href="<?= base_url('admin/roleAccess/') . $r['id'];?>" class="btn btn-info mx-2">Access</a>
                                                <button type="button" class="btn btn-warning mx-2" data-toggle="modal" data-target="#editroleModal<?= $r['id'] ?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusroleModal<?= $r['id'] ?>">Hapus</button>
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
            <div id="tambahroleModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Role Baru</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/role') ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="menu">Nama Role</label>
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Masukkan Nama Role...">
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
<?php foreach($role as $r) : ?>
            <div id="editroleModal<?= $r['id'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Menu</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/editRole/' . $r['id'])?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?= $r['id'] ?>">
                                    <label for="role">Nama Menu</label>
                                    <input type="text" class="form-control" id="role" name="role" placeholder="Masukkan Nama Role..." value="<?= $r['role'] ?>">
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
<?php foreach($role as $r) : ?>
            <div id="hapusroleModal<?= $r['id'] ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Menu</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="<?= base_url('admin/hapusRole/' . $r['id'])?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?= $r['id'] ?>">
                                    <input type="hidden" class="form-control" name="role" value="<?= $r['role'] ?>">
                                    <h6 class="text-center">Anda yakin mau hapus role ini?</h6>
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