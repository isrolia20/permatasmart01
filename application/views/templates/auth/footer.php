<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/admin/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/admin/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/admin/js/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/admin/js/sb-admin-2.min.js') ?>"></script>

<script type="text/javascript">
    $(document).on("keydown", "#no_telp", function(e) {
        let keycode = e.keyCode || e.which;
        let teks = $(this).val();
        if (teks.length < 1) {
            if (keycode == 48) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    });
</script>

</body>

</html>