<?= $this->include('admin/layout/header') ?>
<?= $this->include('admin/layout/sidebar') ?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?= $this->include('admin/layout/topbar') ?>
        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Admin List</h1>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="/create-DataAdmin" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Add Admin</a>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admins as $admin): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $admin['username'] ?></td>
                                        <td><?= $admin['full_name'] ?></td>
                                        <td><?= $admin['email'] ?></td>
                                        <td><?= $admin['phone_number'] ?></td>
                                        <td><?= $admin['department'] ?></td>
                                        <td>
                                            <a href="/admin/edit-DataAdmin/<?= $admin['id_admin'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="/admin/delete-DataAdmin/<?= $admin['id_admin'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->include('admin/layout/footer') ?>