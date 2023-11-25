<?php
    require("../../base.php");
    require("../../database.php");
    session_start();
    if (!isset($_SESSION['manager'])) {
        header("Location: ../index.php");
        exit();
    }
    
    if (isset($_POST['submit'])) {
        $orders = getSpecDateOrderDetail('order', 'user', 1, $_POST['start'], $_POST['end']);
    } else {
        $orders = getSpecOrderDetail('order', 'user', 1);
    }
    $total = 0;
    $sum = 0;
    $labelChart = [];
    $valueChart = [];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
        <title>Manager - Belum</title>
    </head>
    <body>
        <?php require '../../../assets/inc/navbar.inc'; ?>
        <div class="content">
            <h1>TRANSAKSI SUDAH DIBAYAR</h1>
            <?php if (count($orders) > 0) { ?>
                <form action="sudah_bayar.php" method="post">
                    <label>Mulai dari : </label>
                    <input type="datetime-local" name="start" value="<?php if (isset($_POST['submit'])) { echo $_POST['start']; } ?>">
                    <label>Sampai : </label>
                    <input type="datetime-local" name="end" value="<?php if (isset($_POST['submit'])) { echo $_POST['end']; } ?>">
                    <input type="submit" name="submit" value="Filter">
                </form>
                <div class="chart" style="position: relative; height:40vh; width:80vw">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="tabel">
                    <table>
                        <tr>
                            <td>Tanggal Order</td>
                            <td>Nama Pelanggan</td>
                            <td>Total</td>
                            <td>Status</td>
                        </tr>
                        <?php foreach ($orders as $order) : ?>
                            <?php
                                array_push($labelChart, $order['ORDER_TIME']);
                                array_push($valueChart, $order['TOTAL']);
                                if ($order['PAYMENT_STATUS']) {
                                    $stat = 'Sudah Bayar';
                                }
                            ?>
                            <tr>
                                <td><?= $order['ORDER_TIME'] ?></td>
                                <td><?= $order['USER_NAME'] ?></td>
                                <td><?= "Rp " . number_format($order["TOTAL"], 0, ',', '.'); ?></td>
                                <td><?= $stat?></td>
                            </tr>
                            <?php
                                $total += 1;
                                $sum += $order['TOTAL'];
                            ?>
                        <?php endforeach; ?>
                    </table>
                    <table>
                        <tr>
                            <td>TOTAL PESANAN</td>
                            <td>TOTAL PENDAPATAN</td>
                        </tr>
                        <tr>
                            <td><?= $total ?></td>
                            <td><?= "Rp " . number_format($sum, 0, ',', '.'); ?></td>
                        </tr>
                    </table>
                </div>
            <?php } else {
                echo "<h2>Belum ada transaksi yang ditambahkan</h1>";
            } ?>
        </div>
        <script src="chartjs/dist/chart.umd.js"></script>
        <script>
            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labelChart); ?>,
                    datasets: [{
                        label: 'Daftar Pesanan',
                        data: <?= json_encode($valueChart); ?>,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <?php require '../../../assets/inc/footer.inc'; ?>
    </body>
</html>