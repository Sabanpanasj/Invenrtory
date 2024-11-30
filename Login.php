<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <style>
        h1 {
            font-weight: bolder;
            text-shadow: 0px  5px 10px aqua;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(180deg, #ebf4f5 12%, #b5c6e0 62%);
        }

        .navbar {
            width: 50%;
        }

        .container-custom {
            box-shadow: 0px 1px 10px 5px aqua;
            width: 40%;
        }
        .form{
            background-color: transparent !important;
        }

        .bg-light {
            background-color: transparent !important;
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
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: aqua;
        }

        .password-toggle {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-center">
            <span class="navbar-brand mb-0 h1">
                <h1>INVENTORY MANAGEMENT SYSTEM</h1>
            </span>
        </div>
    </nav>

    <div class="spinner-overlay" id="spinnerOverlay">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-custom bg-light py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                    <div class=" p-4 p-md-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5 text-center">
                                    <h1>Log in</h1>
                                </div>
                            </div>
                        </div>

                        <form id="loginForm" action="<?php echo base_url('LoginController/fetchdata'); ?>" method="POST">
                            <div class="row gy-3 gy-md-4 overflow-hidden">
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" value="<?php echo (!empty($email)) ? $email : ''; ?>">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="col-12">
                                    <span class="password-toggle" onclick="showPASS()">
                                        <i id="togglePassword" class="fas fa-eye"></i>
                                    </span>
                                    <div class="d-grid">
                                        <button class="btn btn-lg btn-primary" type="submit" name="save">Log in</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <script>
                            alertify.set('notifier', 'position', 'top-right');

                            function showPASS() {
                                var pass = document.getElementById('password');
                                var toggleIcon = document.getElementById('togglePassword');
                                if (pass.type === "password") {
                                    pass.type = "text";
                                    toggleIcon.classList.remove('fa-eye');
                                    toggleIcon.classList.add('fa-eye-slash');
                                } else {
                                    pass.type = "password";
                                    toggleIcon.classList.remove('fa-eye-slash');
                                    toggleIcon.classList.add('fa-eye');
                                }
                            }

                            document.getElementById('loginForm').addEventListener('submit', function(event) {
                                var email = document.getElementById('email').value.trim();
                                var password = document.getElementById('password').value.trim();
                                var errors = [];

                                document.getElementById('spinnerOverlay').style.display = 'flex';

                                if (email === '') {
                                    errors.push('Email is required!');
                                }

                                if (password === '') {
                                    errors.push('Password is required!');
                                }

                                if (errors.length > 0) {
                                    errors.forEach(function(error) {
                                        alertify.error('<i class="fas fa-exclamation-circle"></i> ' + error);
                                    });

                                    document.getElementById('spinnerOverlay').style.display = 'none';
                                    event.preventDefault();
                                } else {
                                    alertify.success('Logging in, please wait...');
                                    setTimeout(function() {
                                        document.getElementById('loginForm').submit();
                                    }, 1000);
                                    event.preventDefault();
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
