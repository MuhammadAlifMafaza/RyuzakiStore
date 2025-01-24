<!-- app\Views\customer\home.php -->
<?= $this->include('customer/layout/header') ?>

<div class="container mt-5">
    <h1>Welcome to Ryugazaki Store!</h1>
    <p>Discover the latest trends and shop with ease.</p>

    <!-- Carousel Section -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= base_url('/public/img/slide1.gif') ?>" class="d-block w-100" alt="Slide 1">
                <div class="carousel-caption d-none d-md-block">
                    <h5>New Fashion Collection</h5>
                    <p>Discover our latest trends.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('/public/img/slide2.jpg') ?>" class="d-block w-100" alt="Slide 2">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Affordable Style</h5>
                    <p>Look great without breaking the bank.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= base_url('public/img/slide3.jpg') ?>" class="d-block w-100" alt="Slide 3">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Easy Shopping</h5>
                    <p>Fast and secure checkout.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<?= $this->include('customer/layout/footer') ?>