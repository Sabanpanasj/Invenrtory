<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
       
        body {
            background: linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);
            background: -moz-linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);
            background: -webkit-linear-gradient(180deg, hsla(186, 33%, 94%, 1) 12%, hsla(216, 41%, 79%, 1) 62%);
            filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#ebf4f5", endColorstr="#b5c6e0", GradientType=1);
        }
        

        .chart-container {
            width: 70%;
            margin: auto;
            background-color: #333;
            border: 5px solid aqua;
            border-radius: 20px;
            padding: 5px;
            box-shadow: 0px 1px 10px 5px aqua;
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

        
        @media (max-width: 768px) {
            .chart-container {
                width: 90%;
            }
            .navbar-nav .nav-link {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand"style="text-indent: 10px;">INVENTORY MANAGEMENT SYSTEM</a>
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
                    <a class="nav-link" href="<?php echo site_url('profile') ?>" onclick="showLoading(event, '<?php echo site_url('profile') ?>')">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <br>
    <h1>Home</h1>

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

    <div class="chart-container">
        <canvas id="inventoryChart"></canvas>
    </div>

    <script>
        const labels = [
            <?php foreach ($inventoryData as $item) {
                echo "'" . $item['products'] . "',";
            } ?>
        ];
        const quantities = [
            <?php foreach ($inventoryData as $item) {
                echo $item['quantity'] . ",";
            } ?>
        ];
        const prices = [
            <?php foreach ($inventoryData as $item) {
                echo $item['price'] . ",";
            } ?>
        ];
        const expirationDates = [
            <?php foreach ($inventoryData as $item) {
                echo "'" . $item['expirationDate'] . "',";
            } ?>
        ];

        const ctx = document.getElementById('inventoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Quantity',
                        data: quantities,
                        backgroundColor: 'rgba(0, 255, 255, 0.5)',
                        borderColor: 'aqua',
                        borderWidth: 3,
                        fill: true,
                    },
                    {
                        label: 'Price',
                        data: prices,
                        backgroundColor: 'rgba(165, 42, 42, 0.5)',
                        borderColor: 'brown',
                        borderWidth: 3,
                        fill: true,
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        ticks: {
                            color: 'white'
                        },
                        grid: {
                            color: 'white'
                        }
                    },
                    y: {
                        ticks: {
                            color: 'white'
                        },
                        beginAtZero: true,
                        grid: {
                            color: 'white'
                        }
                    },
                    y1: {
                        position: 'right',
                        ticks: {
                            color: 'white'
                        },
                        grid: {
                            color: 'white'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        callbacks: {
                            afterLabel: function(tooltipItem) {
                                return 'Expiration: ' + expirationDates[tooltipItem.dataIndex];
                            }
                        }
                    }
                },
                elements: {
                    line: {
                        borderColor: 'white'
                    }
                }
            }
        });
    </script>

</body>

</html>
