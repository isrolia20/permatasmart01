<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pendapatan
                                <?php foreach ($transaksi as $row) : ?>
                                    (<?= $row['bulan']; ?>)
                                <?php endforeach; ?>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($transaksi as $row) : ?>
                                    (<?= 'Rp' . number_format($row['pendapatan'], 2, ',', '.') ?>)
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Transaksi
                                <?php foreach ($countTrans as $data) : ?>
                                    <?= $data['bulan']; ?>
                                <?php endforeach; ?>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php foreach ($countTrans as $data) : ?>
                                    <?= $data['banyakTransaksi']; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row justify-content-center">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form action="<?= base_url('admin'); ?>" method="post">
                        <div class="form-row avoid-this">
                            <div class="form-group col-md-5">
                                <label for="from-date">Dari :</label>
                                <input type="date" name="start_date" class="form-control" value="<?= $from; ?>">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="to-date">Ke :</label>
                                <input type="date" name="end_date" class="form-control" value="<?= $to; ?>">
                            </div>
                            <div class="form-group col-md-2" style="margin-top: 31px;">
                                <button type="submit" name="filter" class="btn btn-info btn-round" data-toggle="tooltip" data-placement="top" title="Cari">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="chart-area">

                        <canvas id="chartAdmin"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->