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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?=base_url('assets/fonts/fontawesome/css/fontawesome-all.min.css') ?>">
    
    <!-- animation css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/animation/css/animate.min.css') ?>">
    
    <!-- prism css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/prism/css/prism.min.css') ?>">

    <!-- data tables css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/data-tables/css/datatables.min.css') ?>">

    <!-- jquery ui -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="<?=base_url('assets/plugins/jquery/js/jquery.min.js') ?>"></script>

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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        .tox .tox-editor-header {
            z-index: 0 !important;
        }

        .pcoded-navbar.theme-horizontal ~ .pcoded-header {
            height: 70px !important;
        }

        .b-title {
            font-size: 20px !important;
        }

        .tox-promotion {
            display: none !important;
        }

        .pcoded-navbar a {
            color: #a9d9a3;
        }

        .pcoded-navbar.theme-horizontal ~ .pcoded-main-container {
            margin-top: 0;
            margin-left: 0;
        }

        code {
            color: black;
        }

        .nav-link {
            transition: background-color 100ms;
        }

        .nav-link:hover {
            background-color: #254120;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .tabledit-delete-button{
            margin: 0; 
            padding: 0; 
            border:0;
        }
        
        b, strong {
            font-weight: bolder;
        }

        .resposta-ordem {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            transition: none;
            width: 28px;
            font-size: 18px;
        }

        .badge-small {
            font-size: 14px;
            margin: 3px;
        }

        .badge-large {
            font-size: 20px;
            margin: 3px;
        }

        .badge-custom {
            font-size: 16px;
            margin: 3px;
            opacity: 75%;
        }

        #countdown-element {
            margin: 10px 0px;
        }

        .card-countdown {
            transition: all 0.5s;
            border-radius: 50%;
            position: relative;
        }

        .card-countdown, .myBar {
            width: 180px !important;
            height: 180px !important;
        }

        .icon-countdown {
            position: absolute; 
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 180px;
            color: white;
            opacity: 0.1;
        }

        .count {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 22px;
        }

        .card-resposta-correta {
            color: #28A745;
            background: rgb(255,255,255);
            background: linear-gradient(111deg, #F5F7F7 0%, #F5F7F7 20%, rgba(76,175,80,1) 100%);
        }

        .card-resposta-invalida {
            color: #FF9800;
            background: rgb(255,255,255);
            background: linear-gradient(111deg, #F5F7F7 0%, #F5F7F7 20%, rgba(255,132,0,1) 100%);
        }

        .card-resposta-errada {
            color: #F44336;
            background: rgb(255,255,255);
            background: linear-gradient(111deg, #F5F7F7 0%, #F5F7F7 20%, rgba(244,67,54,1) 100%);
        }

        .card-resposta {
            background-color: #F5F7F7;
        }

        .card-resposta label {
            cursor: pointer;
        }

        .card-resposta.selected {
            background-color: #007bff;
        }

        .card-resposta.selected .resposta-texto {
            color: white;
        }

        .card-resposta.selected .resposta-ordem {
            background-color: white;
        }

        .card-resposta.selected .resposta-ordem span {
            color: #007bff;
            font-weight: 900;
        } 

        .bg-finish {
            overflow: hidden;
            height: 80vh;
            border-radius: 18px;
            background-image: url("<?=base_url('assets/img/finish2.png') ?>");
            background-size: cover;
            background-position: top center;
            background-repeat: no-repeat;
        }

        .text-finish {
            color: white;
            font-size: 26px;
            font-weight: 700;
            background: rgb(255,255,255);
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, #32c23e 45%, #32c23e 55%, rgba(255,255,255,0) 100%);
            backdrop-filter: blur(10px);
            padding: 25px 5px;
        }

        .widget-primary-card.table-card {
            background-color: #2998f0;
        }

        .ldBar.label-center > .ldBar-label {
            opacity: 0;
        }

        .text-journey {
            fill: #fff;
            stroke: #fff;
            font-size: 22px;
            text-anchor: middle;
            dominant-baseline: middle;
        }

        .journey-container {
            background-image: url("<?=base_url('assets/img/journey.jpg') ?>");
            background-size: cover;
            background-position: bottom;
            width: 100%;
            height: 260px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .cls-liberada {
            fill: #4CAF50;
        }

        .cls-naoliberada {
            fill: #6C757D;
        }

        .cls-3 {
            cursor: pointer;
            stroke: #fff;
        }

        .cls-3, .cls-6 {
            fill: transparent;
        }

        .cls-selected {
            stroke: #359830;
            stroke-width: 10;
        }

        .cls-unselected {
            stroke: #fff;
            stroke-width: 5;
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

        @media (min-width: 992px) {
            .equipe-info {
                overflow-y: auto;
                max-height: 360px;
            }
        }

        @media (min-width: 1200px) {
            .card-header-sticky, .card-countdown-sticky {
                position: sticky !important;
                top: 68px !important;
                z-index: 2;
            }
        }

        @media (max-width: 1200px) {
            .card-countdown, .myBar {
                width: 120px !important;
                height: 120px !important;
            }
            
            .icon-countdown {
                font-size: 120px;
            }

            .count {
                font-size: 16px;
            }
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
            <div class="px-lg-0 px-4 py-lg-0 py-2">
                <a href="<?=site_url('dinamica/Jogo')?>" class="b-brand">
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
                
                <ul class="navbar-nav ml-auto">
                    <li>
                        <p class="text-primary"><?=$this->session->userdata('equipe_equnome')?></p>
                    </li>

                    <!-- Menu Superior Config -->
                    <li>
                        <div class="dropdown drp-user">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon feather icon-settings"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-notification">
                                <div class="pro-head">
                                    <img class="img-fluid rounded-pill" src="<?=base_url($this->session->userdata('equipe_equlogo'))?>">
                                    <span><?=$this->session->userdata('equipe_equnome')?></span>
                                    <a href="<?=site_url('acesso/Gerenciador/logout')?>" class="dud-logout" title="Sair">
                                        <i class="feather icon-log-out"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->

    {CONTEUDO}

    <!-- Required Js -->
    <script src="<?=base_url('assets/js/vendor-all.min.js') ?>"></script>
    <script src="<?=base_url('assets/plugins/jquery-ui/js/jquery-ui.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/pcoded.min.js') ?>"></script>
    
    <!-- prism Js -->
    <script src="<?=base_url('assets/plugins/prism/js/prism.min.js') ?>"></script>

    <!-- datatable Js -->
    <script src="<?=base_url('assets/plugins/data-tables/js/datatables.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/pages/data-basic-custom.js') ?>"></script>

    <!-- loading -->
    <script src="<?=base_url('assets/js/loading-bar.js') ?>"></script>

    <!-- notification Js -->
    <script src="<?=base_url('assets/plugins/notification/js/bootstrap-growl.min.js')?>"></script>
    <!-- <script src="<?=base_url('assets/js/pages/ac-notification.js')?>"></script> -->

    <!-- File Uploader -->
    <script src="<?php echo base_url('assets/plugins/fileuploader/jquery.fileuploader.js') ?>"></script>

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