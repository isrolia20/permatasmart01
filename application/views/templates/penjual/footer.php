<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" dibawah jika kamu yakin untuk mengakhiri session saat ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/admin/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/admin/js/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/admin/js/sb-admin-2.min.js') ?>"></script>

<!-- Datatables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/admin/js/Chart.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/admin/js/chart-area-demo.js') ?>"></script>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    })
</script>
<script type="text/javascript">
    //Button Export Data Tanaman Menu
    $(document).ready(function() {
        $('#barang-1').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [3, 5, 10, 25, 50, -1],
                [3, 5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    },
                    title: 'Barang'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    },
                    title: 'Barang'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });

    $(document).ready(function() {
        $('#barang').DataTable({
            dom: 'lfrtip',
            autoWidth: true,
            lengthMenu: [
                [1, 2, 3, 5, 10, 25, 50, -1],
                [1, 2, 3, 5, 10, 25, 50, "All"]
            ],
            buttons: [{
                    className: 'btn-danger btn-round btn-sm mr-2',
                    extend: 'pdfHtml5',
                    text: 'Cetak (PDF) <i class="fa fa-file-pdf-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    },
                    title: 'Barang'
                },
                {
                    className: 'btn-success btn-round btn-sm mr-2',
                    extend: 'excelHtml5',
                    text: 'Cetak (Excel) <i class="fa fa-file-excel-o"></i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    },
                    title: 'Barang'
                }
            ],
            select: {
                style: "multi"
            }
        });
    });
</script>
<script>
    //Edit Modal Data Tanaman

    // $(document).ready(function() {

    // Untuk sunting

    //     $('#edit-barang').on('show.bs.modal', function(event) {
    //         // Tombol dimana modal di tampilkan
    //         var div = $(event.relatedTarget);
    //         var modal = $(this);

    //         // Isi nilai pada field
    //         modal.find('#id').attr("value", div.data('id'));
    //         modal.find('#kode').attr("value", div.data('kode'));
    //         modal.find('#nama').attr("value", div.data('name'));
    //         modal.find('#image').attr("value", div.data('image'));
    //         modal.find('#njenis').attr("value", div.data('jenis'));
    //         modal.find('#stok').attr("value", div.data('stok'));
    //         modal.find('#harga').attr("value", div.data('harga'));
    //     });
    // });

    // Area Chart Example
    var ctx = document.getElementById("chartPenjual");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php
                if (count($grafik) > 0) {
                    foreach ($grafik as $data) {
                        echo "'" . $data->name . "',";
                    }
                }
                ?>
            ],
            datasets: [{
                label: 'Harga Barang',
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [
                    <?php
                    if (count($grafik) > 0) {
                        foreach ($grafik as $data) {
                            echo $data->total . ", ";
                        }
                    }
                    ?>
                ],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return 'Rp' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: "#000080",
                }
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });
</script>
</body>

</html>