<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            background: hsla(186, 33%, 94%, 1);

            background: linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);

            background: -moz-linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);

            background: -webkit-linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);

            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#ebf4f5", endColorstr="#b5c6e0", GradientType=1);
        }

        table {
            background-color: #333;
            color: white;
            border-collapse: collapse;
            width: 90%;
            box-shadow: 0px 1px 10px 5px aqua;
        }

        th,
        td {
            width: 15%;
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #222;
        }

        tr:hover {
            background-color: #444;
        }

        .navbar-nav .nav-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            margin: 0 5px;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        .navbar-nav .nav-link:hover {
            transform: scale(1.2);
        }


        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: aqua;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" style="text-indent: 10px;">INVENTORY MANAGEMENT SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('home') ?>" onclick="showLoading(event, '<?php echo base_url('home') ?>')">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('product') ?>" onclick="showLoading(event, '<?php echo site_url('product') ?>')">
                        <i class="fas fa-box"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('addnew') ?>" onclick="showLoading(event, '<?php echo site_url('addnew') ?>')">
                        <i class="fas fa-cart-plus"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('profile') ?>" onclick="showLoading(event, '<?php echo site_url('profile') ?>')">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <h1>Products</h1>
    <br>
    <center>
        <div id="inventory">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Photo</th>
                        <th>Quantity</th>
                        <th>Price (₱)</th>
                        <th>Date Produce</th>
                        <th>Expiration Date</th>
                        <th>Reg_Date</th>
                    </tr>
                </thead>
                <tbody id="inventoryList">
                    <?php if (!empty($inventory)) : ?>
                        <?php foreach ($inventory as $item) : ?>
                            <tr>
                            <td><?= $item['products'] ?></td>
                            <td>
                                <?php if (!empty($item['Photo']) && file_exists(FCPATH . $item['Photo'])) : ?>
                                    <img src="<?= base_url($item['Photo']); ?>" alt="Product Photo" style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else : ?>
                                    <span>No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $item['quantity'] ?></td>
                            <td>₱<?= $item['price'] ?></td>
                            <td><?= $item['DateProduce'] ?></td>
                            <td><?= $item['expirationDate'] ?></td>
                            <td><?= $item['Reg_Date'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No products found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </center>

    <div class="spinner-overlay" id="spinnerOverlay">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script>
        function showLoading(event, url) {
            event.preventDefault();
            document.getElementById('spinnerOverlay').style.display = 'flex';


            setTimeout(function() {
                window.location.href = url;
            }, 400);
        }
    </script>
</body>

</html>