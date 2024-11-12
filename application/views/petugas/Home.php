<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center black-text">
            Selamat Bekerja <?= $petugas->nama ?>
        </h1>
    </div>
</div>

<div class="container">
    <div class="section">
        <div class="row">
            <!-- Nambah Stok -->
            <div class="col s12 m4">
                <div class="icon-block">
                    <a href="<?php echo base_url(); ?>barang/Stok">
                        <h2 class="center light-blue-text">
                            <i class="mdi-av-playlist-add" style="font-size: 200px;"></i>
                        </h2>
                        <h5 class="center">Nambah Stok</h5>
                    </a>
                </div>
            </div>

            <!-- Nambah Barang -->
            <div class="col s12 m4">
                <div class="icon-block">
                    <a href="<?php echo base_url(); ?>barang/tambah">
                        <h2 class="center light-blue-text">
                            <i class="mdi-content-add" style="font-size: 200px;"></i>
                        </h2>
                        <h5 class="center">Nambah Barang</h5>
                    </a>
                </div>
            </div>

            <!-- Penjualan -->
            <div class="col s12 m4">
                <div class="icon-block">
                    <a href="<?php echo base_url(); ?>penjualan/tambahPenjualan">
                        <h2 class="center light-blue-text">
                            <i class="mdi-action-shopping-cart" style="font-size: 200px;"></i>
                        </h2>
                        <h5 class="center">Penjualan</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
