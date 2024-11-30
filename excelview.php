<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</head>

<style>
    body {
        background: linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh;
        margin: 0;
    }

    .vh-75 {
        height: 75vh;
    }

    .mask {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        border-radius: 15px;
        border: none;
        background-color: #2f2f2f; /* Light black background for the card */
        color: white; /* White text for contrast */
    }

    .card-body {
        padding: 2rem;
        width: 100%;
    }

    .form-control {
        background-color: #444; /* Slightly lighter black for the form fields */
        color: white;
        border: 1px solid #666; /* Lighter border for the fields */
    }

    .form-label {
        color: #bbb; /* Lighter label color */
    }

    .btn-success {
        background-color: #28a745; /* Green button */
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838; /* Darker green on hover */
    }

    .btn-back {
        background-color: #6c757d; /* Gray color for the back button */
        border-color: #6c757d;
    }

    .btn-back:hover {
        background-color: #5a6268; /* Darker gray on hover */
    }
</style>

<body>
    <section class="vh-75 bg-image">
        <div class="mask d-flex align-items-center h-100">
            <div class="container h-100 d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-9 col-lg-7 col-xl-5">
                    <div class="card" id="cards">
                        <div class="card-body">
                            <h2 class="text-uppercase text-center mb-4">Upload Excel File</h2>
                            <?php if ($this->session->flashdata('status')): ?>
                                <p class="warning text-warning"><?= $this->session->flashdata('status'); ?></p>
                            <?php endif; ?>
                            <form action="<?= base_url('Excelupload') ?>" enctype="multipart/form-data" method="post">
                                <div class="form-outline mb-3">
                                    <input type="file" class="form-control" id="ExcelImport" name="ExcelImport">
                                    <label class="form-label" for="ExcelImport">Choose Excel File</label>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4">Upload</button>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <a href="<?= base_url('addnew') ?>" class="btn btn-back btn-block btn-lg">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
