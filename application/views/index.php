<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Toko Roti Bu Basuki</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Toko Roti Bu Basuki Theme>
              <meta name="author" content="Bu Basuki">

              <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
              <![endif]-->

              <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/docs.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/front.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/js/google-code-prettify/prettify.css" rel="stylesheet">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.4.js"></script>
        
      <!-- jQuery files -->


        <script type="text/javascript" src="<?php echo base_url() ?>assets/gmap/jquery/jquery-1.4.4.min.js"></script>        

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/gmap/gmap3.min.js"></script> 

        <style>
            .gmap3{
                margin: 20px auto;
                border: 1px dashed #C0C0C0;
                width: 500px;
                height: 250px;
            }
        </style>
        <script type="text/javascript">
            
            $(document).ready( function()
            {
                $('#lofslidecontent45').lofJSidernews( { interval:4000,
                    easing:'easeInOutQuad',
                    duration:1000,
                    auto:true } );
                 $("#test").gmap3({
                    marker:{
                        latLng: [-7.686963, 110.621850],
                        options:{
                            draggable:true
                        },
                        events:{
                            dragend: function(marker){
                                $(this).gmap3({
                                    getaddress:{
                                        latLng:marker.getPosition(),
                                        callback:function(results){
                                            var map = $(this).gmap3("get"),
                                            infowindow = $(this).gmap3({get:"infowindow"}),
                                            content = results && results[1] ? results && results[1].formatted_address : "no address";
                                            if (infowindow){
                                                infowindow.open(map, marker);
                                                infowindow.setContent(content);
                                            } else {
                                                $(this).gmap3({
                                                    infowindow:{
                                                        anchor:marker, 
                                                        options:{content: content}
                                                    }
                                                });
                                            }
                                        }
                                    }
                                });
                            }
                        }
                    },
                    map:{
                        options:{
                            zoom: 100
                        }
                    }
                });
        
               
            }
        
        );
            
            function slidePordukBaru()
            {
                akhir = $('ul#produkbaru li:last').hide().remove();
                $('ul#produkbaru').prepend(akhir);
                $('ul#produkbaru li:first').slideDown("slow");
            }
            function slidePordukLaris()
            {
                akhir = $('ul#produklaris li:last').hide().remove();
                $('ul#produklaris').prepend(akhir);
                $('ul#produklaris li:first').slideDown("slow");
            }
            setInterval(slidePordukBaru, 5000);
            setInterval(slidePordukLaris, 7000);


        </script>
    </head>

    <body>


        <!-- Navbar
          ================================================== -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner" style="padding-left:20px;">
                <a class="brand" href="#" style="float:left;";>Bu Basuki Bakery</a>
                <div class="nav-collapse" id="main-menu">
                    <ul class="nav" id="main-menu-left">
                        <li><a href="<?php echo base_url() ?>home/index">Beranda</a></li>
                        <li><a href="<?php echo base_url() ?>home/cara_beli">Cara Pembelian</a></li>
                        <li><a href="<?php echo base_url() ?>">Kontak</a></li>

                    </ul>
                </div>
                <ul class="nav" style="float:right;">
                    <?php if (($this->user_library->is_logged() == true)): ?>
                        <li><div id="topnav" class="topnav"> Shopping Cart (<?php echo $this->cart->total_items(); ?>) | </li>
                        <li><div id="topnav" class="topnav">&nbsp; Total : Rp. <?php echo number_format($this->cart->total(), 2, ',', '.'); ?> | </li>
                        <?php if ($this->cart->total_items() > 0): ?>
                            <li><div id="topnav" class="topnav"> <a href="<?php echo site_url('checkout/index') ?>"> Checkout </a> | </li>
                        <?php endif; ?>
                        <li><div id="topnav" class="topnav">Selamat Datang <?php echo $this->session->userdata('fullname'); ?> | <a href="<?php echo site_url('member_auth/logout') ?>">Keluar</a></div>
                        <?php else: ?>
                        <li><div id="topnav" class="topnav"> Shopping Cart (0) | </li>
                        <li><div id="topnav" class="topnav">&nbsp; Total : Rp. 0,00 | </li>

                        <li><div id="topnav" class="topnav">&nbsp; Member Area |<a href="<?php echo site_url('member/daftar_member') ?>">Register</a>|<a href="login" class="signin"><span>Sign in</span></a> </div>
                            <fieldset id="signin_menu">
                                <form method="post" id="signin" action="<?php echo site_url('member_auth/login') ?>">
                                    <label for="username">Username</label>
                                    <input id="username" name="username" value="" title="username" tabindex="4" type="text">
                                    </p>
                                    <p>
                                        <label for="password">Password</label>
                                        <input id="password" name="password" value="" title="password" tabindex="5" type="password">
                                    </p>
                                    <p class="remember">
                                        <input id="signin_submit" value="Sign in" tabindex="6" type="submit">                                  
                                    </p>

                                </form>
                            </fieldset>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="span3">

                    <div style="clear:both"></div>
                    <div id="content_left" style="margin-left:-10px;">

                        <div class="thumbnail" style="width:210px;margin-bottom:-20px">
                            <div class="caption" style="background-color:white">
                                <center><h3>Terlaris</h3></center>
                            </div>
                        </div>

                        <div id="sub-content-privat">
                            <ul id="produklaris" class="thumbnails">
                                <?php if ($laris->num_rows() > 0):
                                    foreach ($laris->result() as $rows): ?>
                                        <li class="span3">

                                            <div class="thumbnail" style="height:320px;">

                                                <h5><center><?php echo $rows->Produk; ?></center></h5>
                                                <div class="border" style="height:170px;" valign="middle">
                                                    <img title="<?php echo $rows->Produk; ?>" width="200px" src="<?php echo base_url() . $rows->image; ?>" alt="Product Image" />

                                                </div>
                                                <div align="center" style="margin-top:5px;">
                                                    <?php $harga = number_format($rows->harga_per_item, 0, ",", "."); ?>
                                                    <span>Rp. </span><?php echo $harga; ?></span>

                                                </div>
                                                <?php if ($rows->stok > 0): ?>
                                                    <div align="center" style="margin-top:5px;">
                                                        <form method="post" action="<?php echo site_url('pesanan/tambah_barang') ?>">
                                                            <input type="hidden" name="kd_produk" value="<?php echo $rows->KdProduk; ?>">
                                                            <input type="hidden" name="jumlah_item" value="2">
                                                            <input type="hidden" name="harga" value="<?php echo $rows->harga_per_item ?>">
                                                            <input type="hidden" name="produk" value="<?php echo $rows->Produk ?>">
                                                            <input type="submit" name="submit" value="Pesan"class="btn btn-primary">
                                                        </form>
                                                    </div>
                                                <?php else: ?>
                                                    <div align="center" style="margin-top:5px;">
                                                        Stok Habis
                                                    </div>
                                                <?php endif; ?>



                                            </div>

                                        </li>
                                    <?php endforeach;
                                else: ?>
                                    <li class="span3">

                                        <div class="thumbnail" style="height:320px;">
                                            <p>Belum Ada Yang Terjual</p>
                                        </div>
                                    </li>
                                <?php endif; ?>


                            </ul>
                        </div>
                    </div>


                    <div id="content_left" style="margin-left:-10px;">


                        <div id="sub-content-privat">
                            <ul class="thumbnails">
                                <?php foreach ($bank->result() as $rows): ?>
                                    <li class="span3">

                                        <div class="thumbnail" style="height:320px;">
                                            <h5><center>Info Bank</center></h5>
                                            <div class="border" style="height:170px;" valign="middle">
                                                <img title="<?php echo $rows->Bank_Logo; ?>" width="200px" src="<?php echo base_url() . $rows->Bank_Logo; ?>" alt=" Bank" />                                               
                                            </div>
                                            <div align="center" style="margin-top:5px;">
                                                <span><b>No. Rekening</b></span>
                                                <p><span><b><?php echo $rows->no_rekening ?></b></span></p>
                                                <p>
                                                    <span> <b>a/n <?php echo $rows->nama_pemilik ?></b></span>
                                                </p>
                                            </div>



                                        </div>


                                    </li>
                                <?php endforeach; ?>



                            </ul>
                        </div>
                    </div>

                </div>


                <div class="span10" >
                    <div class="border">
                        <div id="myCarousel" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="<?php echo base_url(); ?>assets/img/slider1.jpg" alt="">

                                    <div class="carousel-caption">
                                        <h4>First Thumbnail label</h4>
                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="<?php echo base_url(); ?>assets/img/slider2.jpg" alt="">
                                    <div class="carousel-caption">

                                        <h4>Second Thumbnail label</h4>
                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="<?php echo base_url(); ?>assets/img/slider3.jpg" alt="">
                                    <div class="carousel-caption">
                                        <h4>Third Thumbnail label</h4>

                                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
                        </div>
                    </div>

                    <hr style="margin-top:-10px">
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert alert-error">
                            <p>
                                <?php echo $this->session->flashdata('message'); ?>
                            </p>
                        </div>
                    <?php endif; ?>
                    <section id="thumbnails">
                        <div class="row-fluid">

                            <?php $this->load->view('content/' . $content); ?>
                        </div>
                    </section>
                </div>
            </div>


            <!-- Masthead
            ================================================== -->

            <div style="width:114%;margin-left:-70px">
                <hr>
                <footer>
                    <p style="color:#FFFFFF;"><h5>&copy; Toko Roti Bu Basuki</h5></p>
                </footer>
            </div>
        </div><!-- /container -->



        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-transition.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-alert.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-scrollspy.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-tab.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-tooltip.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-popover.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-button.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-collapse.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-carousel.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-typeahead.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-affix.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/holder/holder.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/google-code-prettify/prettify.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/application.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $(".signin").click(function(e) {
                    e.preventDefault();
                    $("fieldset#signin_menu").toggle();
                    $(".signin").toggleClass("menu-open");
                });

                $("fieldset#signin_menu").mouseup(function() {
                    return false
                });
                $(document).mouseup(function(e) {
                    if($(e.target).parent("a.signin").length==0) {
                        $(".signin").removeClass("menu-open");
                        $("fieldset#signin_menu").hide();
                    }
                });

            });
        </script>

    </body>
</html>
