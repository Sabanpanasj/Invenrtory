<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <style>
        body {
            display: flex;
            flex-direction: column;
            background: hsla(186, 33%, 94%, 1);

            background: linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);

            background: -moz-linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);

            background: -webkit-linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);

            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#ebf4f5", endColorstr="#b5c6e0", GradientType=1);
        }

        .profile-container,
        .update-form {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            color: white;

            border: 0px solid;
            padding: 10px;
            box-shadow: 0px 1px 10px 5px aqua;
        }

        .profile-container {
            text-align: center;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
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

        .btn-aqua {
            background-color: aqua;
            color: black;
            border: none;
            transition: background-color 0.3s, transform 0.2s;
            color: black;
        }

        .btn-aqua:hover {
            background-color: #00cccc;
            transform: scale(1.1);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" style="text-indent: 10px;">INVENTORY MANAGEMENT SYSTEM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
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
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <h1>Profile</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 profile-container">
                <img src="<?php echo base_url('image/picture.jpg'); ?>" alt="Profile Picture"
                    class="profile-picture">

                <p><?php echo $user->email ?></p>
                <p>Password:<?php echo $user->password ?></p>
                <button class="btn btn-aqua" data-bs-toggle="modal" data-bs-target="#updateModal">Update Profile</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('profile/update'); ?>" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" value="<?php echo $user->password; ?>">
                        </div>
                        <button type="submit" class="btn btn-aqua">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="<?php echo site_url('logout'); ?>" class="btn btn-aqua">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="spinner-overlay">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        function showLoading(event, url) {
            event.preventDefault();
            document.querySelector('.spinner-overlay').style.display = 'flex';
            setTimeout(function() {
                window.location.href = url;
            }, 1000);
        }
    </script>

    <?php if ($this->session->flashdata('message')) { ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            <?php if ($this->session->flashdata('type') == 'success') { ?>
                alertify.success('<?= $this->session->flashdata('message'); ?>');
            <?php } elseif ($this->session->flashdata('type') == 'error') { ?>
                alertify.error('<?= $this->session->flashdata('message'); ?>');
            <?php } ?>
        </script>
    <?php } ?>
</body>

</html>
