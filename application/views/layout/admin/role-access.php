                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <!-- Jika Tambah data berhasil -->
                    <?= $this->session->flashdata('message') ?>

                    <!-- Jika Tambah data Gagal di Controller -->
                    <?= $this->session->flashdata('error') ?>

                    <?php
                    if ($id && $role== []) {
                        redirect('admin/role');
                    }
                    ?>                   

                    <h5 class="p-2"><?=ucfirst($role['role'])?></h5>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Menu</th>
                                        <th scope="col">Access</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($data_menu as $m) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $m['menu'] ?></td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $m['id']) ?>
                                                    data-role="<?= $role['id']?>" data-menu="<?= $m['id']?>">
                                                </div>
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