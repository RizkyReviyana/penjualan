<?php
foreach ($data as $data) {
    $nama[] = $data->namaBarang;
    $qty[] = (float) $data->qty;
}
?>
<section id="content">
    <div class="container">
        <div id="card-stats">
            <div class="row">
                <!-- Card for Total Transactions -->
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content green white-text">
                            <p class="card-stats-title"><i class="mdi-action-shopping-cart"></i> Total Transaksi</p>
                            <h4 class="card-stats-number"><?php echo $penjualan->jumTransaksi; ?></h4>
                        </div>
                        <div class="card-content green darken-2">
                            <a href="<?php echo base_url(); ?>penjualan/dataPenjualan" class="white-text"> >>> Cek Data Penjualan</a>
                        </div>
                    </div>
                </div>

                <!-- Card for Total Revenue -->
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content purple white-text">
                            <p class="card-stats-title"><i class="mdi-editor-attach-money"></i> Total Pendapatan</p>
                            <h4 class="card-stats-number"><?php echo "Rp " . number_format($penjualan->jumPendapatan, 0, ',', '.'); ?></h4>
                        </div>
                        <div class="card-content purple darken-2">
                            <a href="<?php echo base_url(); ?>penjualan/dataPenjualan" class="white-text"> >>> Cek Data Pendapatan</a>
                        </div>
                    </div>
                </div>

                <!-- Card for Number of Items -->
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content blue-grey white-text">
                            <p class="card-stats-title"><i class="mdi-action-list"></i> Jumlah Barang</p>
                            <h4 class="card-stats-number"><?php echo $barang->jumBarang; ?></h4>
                        </div>
                        <div class="card-content blue-grey darken-2">
                            <a href="<?php echo base_url(); ?>barang/dataBarang" class="white-text"> >>> Cek Data Barang</a>
                        </div>
                    </div>
                </div>

                <!-- Card for Stock Quantity -->
                <div class="col s12 m6 l3">
                    <div class="card">
                        <div class="card-content deep-purple white-text">
                            <p class="card-stats-title"><i class="mdi-action-list"></i> Jumlah Stok</p>
                            <h4 class="card-stats-number"><?php echo $barang->jumStok; ?></h4>
                        </div>
                        <div class="card-content deep-purple darken-2">
                            <a href="<?php echo base_url(); ?>barang/dataBarang" class="white-text"> >>> Cek Data Stok</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Statistic Title -->
        <h4 class="center">STATISTIK PENJUALAN</h4>
        <hr>

        <!-- Chart Canvas -->
        <canvas id="canvas" width="1000px" height="280px" margin="auto"></canvas>

        <!-- Load Chart.js -->
        <script type="text/javascript" src="<?php echo base_url() . 'assets/chartJS/chart.min.js'; ?>"></script>
        <script>
            var lineChartData = {
                labels: <?php echo json_encode($nama); ?>,
                datasets: [
                    {
                        fillColor: "rgba(60,141,188,0.9)",
                        strokeColor: "rgba(60,141,188,0.8)",
                        pointColor: "#3b8bba",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(152,235,239,1)",
                        data: <?php echo json_encode($qty); ?>
                    }
                ]
            };

            var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);
        </script>
    </div>
</section>
