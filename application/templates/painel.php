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
        .b-title {
            font-size: 20px !important;
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
    <nav class="pcoded-navbar menupos-fixed navbar-collapsed">
        <div class="navbar-wrapper">
            <div class="navbar-brand header-logo">
                <a href="<?=site_url()?>" class="b-brand">
                   <!-- <div>
                       <img src="<?=base_url('assets/img/ico2.png')?>">
                   </div> -->
                   <div class="b-bg">
                        <span>Quiz</span>
                    </div>
                   <span class="b-title">
                        IFES
                   </span>
                   <!-- <img width="125px" src="<?=base_url('assets/img/logo_branca.png')?>" alt=""> -->
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label class="text-white f-14 text-uppercase">Menu</label>
                    </li>
                    
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item <?php echo ($this->uri->segment(2) == 'Home') ? 'active' : null ?>">
                        <a href="<?=site_url() ?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Home</span></a>
                    </li>
                    
                    <li data-username="Usuario" class="nav-item <?php echo ($this->uri->segment(2) == 'Usuario') ? 'active' : null ?>"><a href="<?=site_url('painel/Usuario')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Usuários</span></a></li>

                    <li data-username="Evento" class="nav-item <?php echo ($this->uri->segment(2) == 'Evento') ? 'active' : null ?>"><a href="<?=site_url('painel/Evento')?>" class="nav-link"><span class="pcoded-micon"><i class="fas fa-dice-d6"></i></span><span class="pcoded-mtext">Eventos</span></a></li>

                    <li data-username="Equipe" class="nav-item <?php echo ($this->uri->segment(2) == 'Equipe') ? 'active' : null ?>"><a href="<?=site_url('painel/Equipe')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-target"></i></span><span class="pcoded-mtext">Equipes</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="<?=site_url()?>" class="b-brand">
                <div>
                    <img src="<?=base_url('assets/img/ico2.png')?>">
                </div>
                <span class="b-title"><span class="text-success">Quiz</span> <br> Ifes</span>
                <!-- <img class="img-fluid horizontal-dasktop" src="../assets/images/logo-dark.png" alt="Theme-Logo" />
                <img class="img-fluid horizontal-mobile" src="../assets/images/logo.png" alt="Theme-Logo" /> -->
            </a>
        </div>
        <div style="margin-left: 30px;">
            
        </div>
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
                    <p class="text-primary"><?=$this->session->userdata('quiz_evenome')?></p>
                </li>
                
                <!-- Menu Seleção de Eventos -->
                <?=listEventos()?>

                <!-- Menu Superior Config -->
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <!-- <img src="../assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image"> -->
                                <i class="feather feather feather icon-user" style="font-size: 25px;"></i>
                                <span><?=$this->session->userdata('quiz_usunome')?></span>
                                <a href="<?=site_url('painel/Login/logout')?>" class="dud-logout" title="Sair">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
                                <!-- <li><a href="<?=site_url('painel/MeusDados')?>" class="dropdown-item"><i class="feather feather icon-edit-1"></i> Meus Dados</a></li> -->

                                <li><a href="<?=site_url('painel/Log')?>" class="dropdown-item"><i class="feather icon-align-justify"></i> Log</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>
    <!-- [ Header ] end -->

    {CONTEUDO}

    <!-- Required Js -->
    <script src="<?=base_url('assets/js/vendor-all.min.js') ?>"></script>
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/pcoded.min.js') ?>"></script>
    
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
        // Collapse menu
        (function() {
            // if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
            if ($('#layout-sidenav').hasClass('sidenav-horizontal')) {
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
                themelayout: 'horizontal',
                MenuTrigger: 'hover',
                SubMenuTrigger: 'hover',
            });
        });
    </script>

</body>
</html>