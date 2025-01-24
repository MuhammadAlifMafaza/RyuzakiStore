<?= $this->include('layout/header') ?>

<div class="container mt-5">
    <h1>Your Profile</h1>
    <table class="table">
        <tr>
            <th>Name:</th>
            <td><?= esc($customer['name']) ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?= esc($customer['email']) ?></td>
        </tr>
        <tr>
            <th>Phone:</th>
            <td><?= esc($customer['phone']) ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td><?= esc($customer['address']) ?></td>
        </tr>
    </table>
    <a href="/customer/edit" class="btn btn-warning">Edit Profile</a>
    <a href="/customer/logout" class="btn btn-danger">Logout</a>
</div>

<?= $this->include('layout/footer') ?>
