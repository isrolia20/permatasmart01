<!-- Testimonial -->
<section class="sec-blog bg0 p-t-60 p-b-90">
    <div class="container">
        <div class="p-b-66">
            <h3 class="ltext-105 cl5 txt-center respon1">
                Testimonial
            </h3>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 p-b-40">
                <div class="blog-item">
                    <div class="hov-img0">
                        <a href="blog-detail.html">
                            <img src="<?= base_url('assets/user/img/testimoni/blog-01.jpg') ?>" alt="IMG-BLOG">
                        </a>
                    </div>

                    <div class="p-t-15">


                        <h4 class="p-b-12">
                            <a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
                                Nina
                            </a>
                        </h4>

                        <p class="stext-108 cl6">
                            Duis ut velit gravida nibh bibendum commodo. Suspendisse pellentesque mattis augue id euismod. Interdum et male-suada fames
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 p-b-40">
                <div class="blog-item">
                    <div class="hov-img0">
                        <a href="blog-detail.html">
                            <img src="<?= base_url('assets/user/img/testimoni/blog-02.jpg') ?>" alt="IMG-BLOG">
                        </a>
                    </div>

                    <div class="p-t-15">


                        <h4 class="p-b-12">
                            <a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
                                Ikemen
                            </a>
                        </h4>

                        <p class="stext-108 cl6">
                            Nullam scelerisque, lacus sed consequat laoreet, dui enim iaculis leo, eu viverra ex nulla in tellus. Nullam nec ornare tellus, ac fringilla lacus. Ut sit ame
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 p-b-40">
                <div class="blog-item">
                    <div class="hov-img0">
                        <a href="blog-detail.html">
                            <img src="<?= base_url('assets/user/img/testimoni/blog-03.jpg') ?>" alt="IMG-BLOG">
                        </a>
                    </div>

                    <div class="p-t-15">


                        <h4 class="p-b-12">
                            <a href="blog-detail.html" class="mtext-101 cl2 hov-cl1 trans-04">
                                Uhtra
                            </a>
                        </h4>

                        <p class="stext-108 cl6">
                            Proin nec vehicula lorem, a efficitur ex. Nam vehicula nulla vel erat tincidunt, sed hendrerit ligula porttitor. Fusce sit amet maximus nunc
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="p-t-40">
            <p class="stext-107 cl6 txt-center">
                Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved
            </p>
        </div>
    </div>
</footer>


<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/jquery-3.2.1.min.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/animsition.min.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/popper.js'); ?>"></script>
<script src="<?= base_url('assets/user/js/bootstrap.min.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/select2.min.js') ?>"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/user/js/daterangepicker.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/slick.min.js'); ?>"></script>
<script src="<?= base_url('assets/user/js/slick-custom.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/parallax100.js'); ?>"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/jquery.magnific-popup.min.js'); ?>"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/isotope.pkgd.min.js'); ?>"></script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/sweetalert.min.js'); ?>"></script>
<script>
    $('.js-addwish-b2').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to cart !", "success");
        });
    });
</script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/perfect-scrollbar.min.js'); ?>"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="<?= base_url('assets/user/js/main.js'); ?>"></script>
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

    $(document).ready(function() {
        var url = window.location;
        $('ul.main-menu a[href="' + url + '"]').parent().addClass('active-menu');
        $('ul.main-menu a').filter(function() {
            return this.href == url;
        }).parent().addClass('active-menu');
    });

    // $(document).ready(function() {
    //     var url = window.location;
    //     $('ul.main-menu a[href="' + url + '"]').parent().addClass('color-filter9');
    //     $('ul.main-menu a').filter(function() {
    //         return this.href == url;
    //     }).parent().addClass('color-filter9');
    // });
</script>
</body>

</html>