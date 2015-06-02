<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>assets/admin/css/base.css" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>assets/admin/css/jquery-ui.css" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>assets/admin/css/grid.css" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>assets/admin/css/visualize.css" />
        <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>assets/admin/css/jquery-ui-1.8.4.custom.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url()?>assets/admin/css/table_jui.css" />

        <title>Toko Roti Bu Basuki - Administrator</title>
        <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/excanvas.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/visualize.js"></script>
        <script type="text/javascript" src="<?php echo base_url()?>assets/admin/js/functions.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/admin/js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/admin/js/jquery.dataTables.js"></script>
    </head>
    <body style="cursor: auto;">
        <!-- Start Header -->
        <div id="header">
            <div class="header-top tr">
                <p>Hello <strong><?php echo $this->session->userdata('fullname');?></strong> | <a href="<?php echo site_url('admin/logout')?>">Keluar</a></p>
            </div>
            
            
        </div>
        <!-- End Header -->

        <div id="page-wrapper">
            <div class="page">
                <!-- Start Sidebar -->
                <div id="sidebar">
                  
                    <!-- Start Content Nav  -->
                    <span class="ul-header"><a id="toggle-contentsnav" href="#" class="toggle visible">Produk</a></span>
                    <ul id="contentsnav">
                        <li><a href="<?php echo site_url('admin/produk')?>">Daftar Produk</a></li>
                    </ul>

                    <!-- End Gallery Nav  -->
                    <!-- Start consult Nav  -->
                    <span class="ul-header"><a id="toggle-consultsnav" href="#" class="toggle visible">Order Masuk</a></span>
                    <ul style="display: block;" id="consultsnav">
                        <li><a href="<?php echo site_url('admin/invoice_order')?>">Order Masuk</a></li>
                    </ul>
                   
                    <!-- Start Laporan Nav  -->
                    <span class="ul-header"><a id="toggle-messengersnav" href="#" class="toggle visible">Laporan</a></span>
                    <ul style="display: block;" id="messengersnav">
                         <li><a href="<?php echo site_url('admin/transaksi_bulanan')?>">Laporan Bulanan</a></li>
                        <li><a href="<?php echo site_url('admin/transaksi_tahunan')?>">Laporan Tahunan</a></li>
                    </ul>
                    <span class="ul-header"><a id="toggle-guestbooksnav" href="#" class="toggle visible">Bank</a></span>
                    <ul style="display: block;" id="guestbooksnav">
                         <li><a href="<?php echo site_url('admin/bank')?>">Bank</a></li>
                    </ul>
                    <span class="ul-header"><a id="toggle-consultsnav" href="#" class="toggle visible">User</a></span>
                    <ul style="display: block;" id="consultsnav">
                        <li><a href="<?php echo site_url('admin/contact')?>">Ubah Password</a></li>
                    </ul>
                                                          
                </div>
                <!-- End Sidebar  -->

                <!-- Star Page Content  -->
                <div id="page-content">
                    <!-- Start Page Header -->
                    <div id="page-header">
                        <h1></h1>
                    </div>
                    <!-- End Page Header -->

                    <!-- Start Content -->
                    <div class="container_12">
                        <?php $this->load->view('admin/'.$content);?>
                        <br class="cl" />
                    </div>
                    <!-- End Content -->
                </div>
                <!-- End Page Content  -->
            </div>
        </div>
        <!-- Start Footer -->
        <div class="footer"> Copyright ©2013 </div>
        <!-- End Footer -->
        <!--<ul style="z-index: 1; top: 0px; left: 0px; display: none;" aria-activedescendant="ui-active-menuitem" role="listbox" class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all"></ul>
    --></body>
</html>
