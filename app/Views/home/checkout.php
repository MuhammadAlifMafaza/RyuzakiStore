<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        header {
            background-color: #fff;
            padding: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .brand img {
            width: 40px;
            height: 40px;
        }
        .navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 15px;
        }
        .navbar-left {
            display: flex;
            gap: 15px;
        }
        .navbar-right {
            display: flex;
            gap: 15px;
        }
        .navbar ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            gap: 30px;
        }
        .product-image img {
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .product-details {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .category, .tag {
            background-color: #ff4757;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .tag.casual {
            background-color: #1e90ff;
        }
        .tag.pakaian-wanita {
            background-color: #8e44ad;
        }
        .size {
            font-weight: bold;
            color: #28a745;
        }
        .price {
            font-size: 1.5em;
            color: #e74c3c;
        }
        .purchase select, .purchase button {
            margin-top: 10px;
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: none;
        }
        .purchase button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        .purchase button:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            box-shadow: 0px -4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="brand">
                <img src="<?= base_url("assets\img\Logo_RZ-nobg.png")?>" alt="Brand Logo">
                <span>Fashion Store</span>
            </div>
            <ul class="navbar-left">
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">🛒 Keranjang <span class="cart-count">0</span></a></li>
            </ul>
            <ul class="navbar-right">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="product-image">
            <img src="<?= base_url("assets\img\Celana-Panjang-Regular-Fit.jpg")?>" alt="Peplum Silky Gold">
        </div>
        <div class="product-details">
            <h1>Peplum Silky Gold</h1>
            <p><strong>Kategori:</strong> <span class="category">Atasan Wanita</span></p>
            <p><strong>Tags:</strong> <span class="tag casual">Casual</span> <span class="tag pakaian-wanita">Pakaian Wanita</span></p>
            <p><strong>Ukuran:</strong> <span class="size">L</span></p>
            <p class="price">Rp 200.000</p>
            <p class="description">Pakaian ini dibuat dengan material Brokat dan Organza</p>
            <p><strong>Stok tersisa:</strong> 100</p>
            <div class="purchase">
                <select>
                    <option>Pilih Ukuran</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                </select>
                <button class="add-to-cart">Tambah ke Keranjang 🛒</button>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Fashion Store. All rights reserved.</p>
    </footer>
</body>
</html>
