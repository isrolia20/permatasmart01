<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <!-- <img src="<?= base_url('assets/user/img/icons/logo-01.png') ?>" alt="IMG-LOGO"> -->
                    <div style="font-size: 40px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; color: #FFA500;">Permatasmart</div>
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li>
                            <a href="<?= base_url('Pembeli') ?>">Home</a>
                        </li>

                        <!-- <li>
                            <a href="product.html">Shop</a>
                        </li> -->

                        <!-- <li>
                            <a href="about.html">About</a>
                        </li>
                        <li>
                            <a href="contact.html">Contact</a>
                        </li> -->

                        <li>
                            <a href="<?= base_url('Pembeli/checkout/') ?>">Checkout</a>
                        </li>
                        <li>
                            <a href="<?= base_url('Pembeli/my_profile/') ?>">My Profile</a>
                        </li>
                        <li>
                            <a href="<?= base_url('Auth/logout') ?>">Logout <i class="fa fa-sign-out"></i></a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <?php
                    $keranjang = $this->cart->total_items();
                    ?>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= $keranjang; ?>">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="<?= base_url('Pembeli') ?>"><img src="<?= base_url('assets/user/img/icons/logo-01.png') ?>" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <?php
            $keranjang = $this->cart->total_items();
            ?>
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= $keranjang; ?>">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="<?= base_url('Pembeli') ?>">Home</a>
            </li>

            <!-- <li>
                <a href="product.html">Shop</a>
            </li> -->

            <!-- <li>
                <a href="shoping-cart.html">Features</a>
            </li> -->

            <!-- <li>
                <a href="blog.html">Blog</a>
            </li> -->

            <!-- <li>
                <a href="about.html">About</a>
            </li>
            <li>
                <a href="contact.html">Contact</a>
            </li> -->

            <li>
                <a href="<?= base_url('Pembeli/my_profile/') ?>">My Profile</a>
            </li>
            <li>
                <a href="<?= base_url('Pembeli/checkout/') ?>">Checkout</a>
            </li>
            <li>
                <a href="<?= base_url('Auth/logout') ?>">Logout <i class="fa fa-sign-out"></i></a>
            </li>
        </ul>
    </div>
</header>

<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart <?= $user['name']; ?>
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <?php if ($this->session->userdata('email')) : ?>
                <?php if ($this->cart->contents() == TRUE) : ?>
                    <?php foreach ($this->cart->contents() as $items) : ?>
                        <ul class="header-cart-wrapitem w-full">
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-img">
                                    <img src="<?= base_url('assets/admin/img/barang/') . $items['image']; ?>" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt p-t-8">
                                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                        <?= $items['name']; ?>
                                    </a>

                                    <span class="header-cart-item-info">
                                        <?= $items['qty'] ?> x <?= 'Rp' . number_format($items['price'], 2, ',', '.') ?>
                                    </span>

                                    <span class="header-cart-item-info">
                                        <form action="<?= base_url('Pembeli/delete_cart'); ?>" method="post" style="display: inline-block;">
                                            <input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
                                            <input type="hidden" name="id" value="<?= $items['id'] ?>">
                                            <input type="hidden" name="name" value="<?= $items['name'] ?>">
                                            <input type="hidden" name="qty" value="<?= $items['qty'] ?>">
                                            <button type="submit" class="badge badge-danger">Hapus</button>
                                        </form>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    <?php endforeach; ?>

                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Total: Rp. <?= number_format($this->cart->total(), 2, ',', '.') ?>
                        </div>

                        <div class="header-cart-buttons flex-w w-full">
                            <a href="<?= base_url('Pembeli/detail_cart') ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                View Cart
                            </a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Total: 0
                        </div>

                        <div class="header-cart-buttons flex-w w-full">
                            <a href="#" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                Tidak ada pesanan
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>