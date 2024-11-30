<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <style>
        body {
            background: hsla(186, 33%, 94%, 1);
            background: linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);
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
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #222;
        }

        tr:hover {
            background-color: #444;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
        }

        .add-form {
            width: 60%;
            background-color: #333;
            color: white;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0px 1px 10px 2px aqua;
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

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
        <a class="navbar-brand" href="#">INVENTORY MANAGEMENT SYSTEM</a>
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
    <h1>Add New Product</h1>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <center>
                    <form id="addItemForm" method="POST" action="<?= base_url() ?>savedata" class="add-form" enctype="multipart/form-data">

                        <input type="hidden" name="add" value="1">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="products" name="products" placeholder="Product Name">
                        </div>
                        <div class="mb-3">
                            <p>Photo</p>
                            <input type="file" class="form-control" id="Photo" name="Photo" placeholder="Photo">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" min="1">
                        </div>
                        <div class="mb-3">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" min="0.01" step="0.01">
                        </div>
                        <div class="mb-3">
                            <p>Date of Production</p>
                            <input type="date" class="form-control" id="DateProduce" name="DateProduce">
                        </div>
                        <div class="mb-3">
                            <p>Expiration Date</p>
                            <input type="date" class="form-control" id="expirationDate" name="expirationDate" placeholder="ExpirationDate">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success w-100">Add New</button>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="<?= site_url('Excel') ?>" class="btn btn-primary w-100">Add Excel</a>
                        </div>
                    </form>

                    </form>
                </center>
            </div>
        </div>
        <div>

            <table class="table table-dark table-hover mt-5">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Photo</th>
                        <th>Quantity</th>
                        <th>Price (₱)</th>
                        <th>Date Produce</th>
                        <th>Expiration Date</th>
                        <th>Reg_Date</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody id="inventoryList">
                    <?php if (!empty($inventory)) : ?>
                        <?php foreach ($inventory as $item) : ?>
                            <tr data-id="<?= $item['id'] ?>">
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
                                <td>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal"
                                        onclick="loadProductData(<?= $item['id'] ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <i class="fas fa-trash delete-btn" onclick="deleteItem(<?= $item['id'] ?>)"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">No products found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?php echo site_url('inventory/update'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="productId" name="product_id">

                            <!-- Update Product Name (optional) -->
                            <div class="mb-3">
                                <input type="text" class="form-control" id="updateProductName" name="products" placeholder="Product Name">
                            </div>

                            <!-- Update Photo -->
                            <div class="mb-3">
                                <p>Update Photo</p>
                                <input type="file" class="form-control" id="updatePhoto" name="Photo">
                            </div>

                            <!-- Update Quantity -->
                            <div class="mb-3">
                                <input type="number" class="form-control" id="updateQuantity" name="quantity" placeholder="Quantity" min="1">
                            </div>

                            <!-- Update Price -->
                            <div class="mb-3">
                                <input type="number" class="form-control" id="updatePrice" name="price" placeholder="Price" min="0.01" step="0.01">
                            </div>

                            <!-- Update Date Produce -->
                            <div class="mb-3">
                                <p>Date Produce</p>
                                <input type="date" class="form-control" id="updateDateProduce" name="DateProduce">
                            </div>

                            <!-- Update Expiration Date -->
                            <div class="mb-3">
                                <p>Expiration Date</p>
                                <input type="date" class="form-control" id="updateExpirationDate" name="expirationDate">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="spinner-overlay" id="spinnerOverlay">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <script>
            alertify.set('notifier', 'position', 'top-right');

            document.getElementById('addItemForm').addEventListener('submit', function(error) {
                const productName = document.getElementById('products').value.trim();
                const quantity = document.getElementById('quantity').value;
                const price = document.getElementById('price').value;
                const expirationDate = document.getElementById('expirationDate').value;

                if (!productName || quantity <= 0 || price <= 0 || !expirationDate) {
                    alertify.error('Please fill out all fields correctly.');
                    error.preventDefault();
                }
            });


            document.querySelector('form[action="<?php echo site_url('inventory/update'); ?>"]').addEventListener('submit', function(error) {
                const updateQuantity = document.getElementById('updateQuantity').value;
                const updatePrice = document.getElementById('updatePrice').value;
                const updateExpirationDate = document.getElementById('updateExpirationDate').value;


                if (updateQuantity <= 0 || updatePrice <= 0 || !updateExpirationDate) {
                    alertify.error('Please fill out all fields correctly.');
                    error.preventDefault();
                }
            });


            function showLoading(event, url) {
                document.getElementById('spinnerOverlay').style.display = 'flex';
            }

            function loadProductData(id) {
                const row = document.querySelector(`tr[data-id='${id}']`);

                // Populate modal fields with current product data
                document.getElementById('productId').value = id;
                document.getElementById('updateProductName').value = row.cells[0].innerText; // Product Name
                document.getElementById('updateQuantity').value = row.cells[2].innerText; // Quantity
                document.getElementById('updatePrice').value = row.cells[3].innerText.replace('₱', ''); // Price
                document.getElementById('updateDateProduce').value = row.cells[4].innerText; // Date Produce
                document.getElementById('updateExpirationDate').value = row.cells[5].innerText; // Expiration Date

                // Handle photo (if any)
                const photoCell = row.cells[1];
                const currentPhoto = photoCell.innerHTML.trim();
                if (currentPhoto) {
                    document.getElementById('updatePhoto').setAttribute('data-current-photo', currentPhoto);
                }
            }


            let deleteId = null;

            function deleteItem(id) {
                deleteId = id;
                const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                deleteModal.show();
            }

            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                if (deleteId !== null) {
                    window.location.href = `<?= base_url() ?>delete/${deleteId}`;
                }
            });

            <?php if ($this->session->flashdata('message')) { ?>
                <?php if ($this->session->flashdata('type') == 'success') { ?>
                    alertify.success('<?= $this->session->flashdata('message'); ?>');
                <?php } else { ?>
                    alertify.error('<?= $this->session->flashdata('message'); ?>');
                <?php } ?>
            <?php } ?>
        </script>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>