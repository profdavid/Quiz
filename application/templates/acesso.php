<!DOCTYPE html>
<html lang="br">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-164147805-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-164147805-1');
    </script> -->

    <title>Quiz</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="" />

    <!-- Favicon icon -->
    <link rel="icon" href="<?=base_url('assets/img/ico.png') ?>" type="image/x-icon">
    
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="<?=base_url('assets/fonts/fontawesome/css/fontawesome-all.min.css') ?>">
    
    <!-- animation css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/animation/css/animate.min.css') ?>">
    
    <!-- prism css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/prism/css/prism.min.css') ?>">

    <!-- data tables css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/data-tables/css/datatables.min.css') ?>">

    <!-- jquery ui -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- notification css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/notification/css/notification.min.css') ?>">
    
    <!-- File Uploader -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileuploader/jquery.fileuploader.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileuploader/jquery.fileuploader-theme-thumbnails.css') ?>">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/css/select2.min.css') ?>">

    <!-- ekko-lightbox css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ekko-lightbox/css/ekko-lightbox.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/lightbox2-master/css/lightbox.min.css') ?>">
    
    <!-- vendor css -->
    <link rel="stylesheet" href="<?=base_url('assets/css/style.css') ?>">

    <style>
        .tox .tox-editor-header {
            z-index: 0 !important;
        }

        .b-title {
            font-size: 20px !important;
        }

        .pcoded-navbar.theme-horizontal ~ .pcoded-header {
            height: 70px !important;
        }
        
        .pcoded-navbar.theme-horizontal ~ .pcoded-main-container {
            margin-top: 0;
            margin-left: 0;
        }

        .pcoded-navbar a {
            color: #a9d9a3;
        }

        .nav-link {
            transition: background-color 100ms;
        }

        .nav-link:hover {
            background-color: #254120;
        }

        .tabledit-delete-button{
            margin: 0; 
            padding: 0; 
            border:0;
        }

        .event-card, .anim-item { opacity: 0 }

        .items {
            width: 200px;
            height: 200px;
            position: relative;
        }

        .anim {
            position: absolute;
            scale: 1;
            top: 42%;
            left: 0;
            transform-origin: 100px;
        }

        .anim img { width: 28px }

        .anim1 {transform: rotate(calc(360deg / 6 * 1))}
        .anim2 {transform: rotate(calc(360deg / 6 * 2))}
        .anim3 {transform: rotate(calc(360deg / 6 * 3))}
        .anim4 {transform: rotate(calc(360deg / 6 * 4))}
        .anim5 {transform: rotate(calc(360deg / 6 * 5))}
        .anim6 {transform: rotate(calc(360deg / 6 * 6))}

        .overflow {
            overflow: hidden;
            position: relative;
            padding: 60px 0px;
        }

        .word {
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 225px;
            height: 100px;
            font-size: 15px;
            color: #4caf50;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .event-card a:hover .card {
            transform: scale(1.05);
            transition: transform 0.3s cubic-bezier(0.25, 0.1, 0.25, 1);
        }
    </style>
    <style media="screen">
        .sidenav-horizontal:before,
        .sidenav-horizontal:after {
            content: "";
            background: #242e3e;
            width: 100%;
            position: absolute;
            top: 0;
            height: 100%;
            z-index: 5;
        }
        .sidenav-horizontal:before{
            left: 100%;
        }
        .sidenav-horizontal:after {
            right: 100%;
        }
        @media only screen and (max-width: 991px){
            .sidenav-horizontal:before,
            .sidenav-horizontal:after {
                display: none;
            }
        }
        @media only screen and (max-width: 991px){       
            .overflow { padding: 35px 0px 40px 0px}
        }
    </style>

</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar theme-horizontal d-none">
        <div class="navbar-wrapper container">
            <div class="navbar-brand header-logo">
                <a href="<?=site_url('dinamica/Jogo')?>" class="b-brand">
                   <div class="b-bg">
                        <span>Quiz</span>
                    </div>
                   <span class="b-title">
                        IFES
                   </span>
                </a>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
        <div class="container">
            <div class="px-lg-0 px-4 py-lg-0 py-3">
                <a href="<?=site_url('acesso/Gerenciador')?>" class="b-brand">
                    <div>
                        <img width="30px" src="<?=base_url('assets/img/logo_cor_brand.png')?>">
                    </div>
                    <span class="b-title"><h4 class="text-success mb-0">Quiz</h4></span>
                </a>
            </div>
            <div style="margin-left: 30px;"></div>
            <a class="mobile-menu" id="mobile-header" href="#!">
                <i class="feather icon-more-horizontal"></i>
            </a>
            <div class="collapse navbar-collapse">
                <a href="#!" class="mob-toggler"></a>
                <ul class="navbar-nav mr-auto">
                    <li>
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Collapse Menu</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Page Layouts</a></li>
                                            <li class="breadcrumb-item"><a href="#!">Vertical</a></li>
                                            <li class="breadcrumb-item"><a href="#!">Collapse Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->

    {CONTEUDO}

    <!-- Required Js -->
    <script src="<?=base_url('assets/js/vendor-all.min.js') ?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/pcoded.min.js') ?>"></script>

    <!-- GSAP -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    
    <!-- prism Js -->
    <script src="<?=base_url('assets/plugins/prism/js/prism.min.js') ?>"></script>

    <!-- datatable Js -->
    <script src="<?=base_url('assets/plugins/data-tables/js/datatables.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/pages/data-basic-custom.js') ?>"></script>

    <!-- notification Js -->
    <script src="<?=base_url('assets/plugins/notification/js/bootstrap-growl.min.js')?>"></script>
    <!-- <script src="<?=base_url('assets/js/pages/ac-notification.js')?>"></script> -->

    <!-- File Uploader -->
    <script src="<?php echo base_url('assets/plugins/fileuploader/jquery.fileuploader.js') ?>"></script>

    <script src="<?php echo base_url('assets/plugins/jquery-ui/js/jquery-ui.js') ?>"></script>

    <!-- Mask -->
    <script src="<?php echo base_url('assets/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.min.js') ?>"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>

    <!-- ekko-lightbox Js -->
    <script src="<?php echo base_url('assets/plugins/ekko-lightbox/js/ekko-lightbox.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/lightbox2-master/js/lightbox.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/pages/ac-lightbox.js') ?>"></script>

    <script src="<?=base_url('assets/js/horizontal-menu.js') ?>"></script>

    <script src="<?=base_url('assets/js/funcoes.js') ?>"></script>
    
    <script type="text/javascript">
        (function() {
            if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
                return;
            }
            try {
                window.layoutHelpers.setCollapsed(
                    localStorage.getItem('layoutCollapsed') === 'true',
                    false
                );
            } catch (e) {}
        })();
        $(function() {
            // Initialize sidenav
            $('#layout-sidenav').each(function() {
                new SideNav(this, {
                    orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
                });
            });
            // Initialize sidenav togglers
            $('body').on('click', '.layout-sidenav-toggle', function(e) {
                e.preventDefault();
                window.layoutHelpers.toggleCollapsed();
                if (!window.layoutHelpers.isSmallScreen()) {
                    try {
                        localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed()));
                    } catch (e) {}
                }
            });
        });
        $(document).ready(function() {
            $("#pcoded").pcodedmenu({
                MenuTrigger: 'hover',
                SubMenuTrigger: 'hover',
            });
        });
    </script>

</body>
</html>