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

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- notification css -->
    <link rel="stylesheet" href="<?=base_url('assets/plugins/notification/css/notification.min.css') ?>">
    
    <!-- File Uploader -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileuploader/jquery.fileuploader.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileuploader/jquery.fileuploader-theme-thumbnails.css') ?>">

    <!-- loading -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pages/loading-bar.css') ?>">

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

        .ui-sortable-helper {
            cursor: grabbing !important;
            opacity: 0.3;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
        }

        .table-questao tbody tr:hover {
            cursor: grab;
            background-color: #00ACC120;
        }

        .table-questao-texto, .table-questao-discursiva {
            white-space: wrap;
        }

        input[type="file"] {
            color: transparent;
        }
        
        input[type="file"]::file-selector-button {
            cursor: pointer;
        }
        
        b, strong {
            font-weight: bolder;
        }

        .btn, a {
            transition: all 0.15s ease-in-out;
        }

        .btn-add-resposta {
            padding: 12px 0px;
            border: 1px dashed #3aab2c;
        }

        .btn-add-resposta:hover {
            background-color: #3aab2c15;
        }

        .card-countdown {
            position: relative;
        }

        .count {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .qrimg {
            max-width: 200px;
        }

        .resposta-ordem {
            width: 35px;
            font-size: 24px;
        }

        .card-resposta {
            border: 3px solid #f1f1f1;
            background-color: #f1f1f1; 
        }

        .card-resposta-correta {
            border: 1px solid #28A745;
            background-color: #28A74515; 
        }

        .card-resposta-correta code,
        .card-resposta-correta span,
        .card-resposta-correta p {
            color: #28A745;
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
            font-size: 14px;
            margin: 3px;
            opacity: 60%;
            padding: 6px 9px;
        }

        .badge-selected {
            font-size: 14px;
            margin: 3px;
            padding: 6px 9px;
            border: 2px solid green;
        }

        .bg-gray {
            background-color: #f1f1f1; 
        }

        .bg-success-50 {
            background-color: #4CAF5050 !important; 
        }

        .bg-warning-50 {
            background-color: #FF980050 !important; 
        }

        .bg-danger-50 {
            background-color: #F4433650 !important; 
        }

        .ldBar.label-center > .ldBar-label {
            opacity: 0;
        }

        .bg-ranking {
            background-image: url("<?=base_url('assets/img/ranking.png') ?>");
            background-size: cover;
            background-repeat: no-repeat;
            opacity: 0;
            transform: translateY(100px);
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
            .table-questao-texto, .table-questao-discursiva {
                white-space: nowrap;
            }
        }
        @media only screen and (max-width: 575px){
            .qrimg {
                max-width: 100%;
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
                <a href="<?=site_url('painel/Home')?>" class="b-brand">
                   <div class="b-bg">
                        <span>Quiz</span>
                    </div>
                   <span class="b-title">
                        IFES
                   </span>
                </a>
                <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            </div>
            <div class="navbar-content scroll-div">
                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item pcoded-menu-caption">
                        <label class="text-white f-14 text-uppercase">Cadastros</label>
                    </li>
                    
                    <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item <?php echo ($this->uri->segment(2) == 'Home') ? 'active' : null ?>">
                        <a href="<?=site_url('painel/Home')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Home</span></a>
                    </li>
                    
                    <li data-username="Usuario" class="nav-item <?php echo ($this->uri->segment(2) == 'Usuario') ? 'active' : null ?>"><a href="<?=site_url('painel/Usuario')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Usuários</span></a></li>

                    <li data-username="Evento" class="nav-item <?php echo ($this->uri->segment(2) == 'Evento') ? 'active' : null ?>"><a href="<?=site_url('painel/Evento')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-grid"></i></span><span class="pcoded-mtext">Eventos</span></a></li>

                    <li data-username="Equipe" class="nav-item <?php echo ($this->uri->segment(2) == 'Equipe') ? 'active' : null ?>"><a href="<?=site_url('painel/Equipe')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-shield"></i></span><span class="pcoded-mtext">Equipes</span></a></li>

                    <li data-username="Questao" class="nav-item <?php echo ($this->uri->segment(2) == 'Questao') ? 'active' : null ?>"><a href="<?=site_url('painel/Questao')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-align-left"></i></span><span class="pcoded-mtext">Questões</span></a></li>

                    <li class="nav-item pcoded-menu-caption">
                        <label class="text-white f-14 text-uppercase">Dinâmica</label>
                    </li>

                    <li data-username="Acompanhamento" class="nav-item <?php echo ($this->uri->segment(3) == 'questao') ? 'active' : null ?>"><a href="<?=site_url('painel/Acompanhamento')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-flag"></i></span><span class="pcoded-mtext">Acompanhamento</span></a></li>

                    <li data-username="Pontuacao" class="nav-item <?php echo ($this->uri->segment(3) == 'pontuacao') ? 'active' : null ?>"><a href="<?=site_url('painel/Acompanhamento/pontuacao')?>" class="nav-link"><span class="pcoded-micon"><i class="feather icon-star"></i></span><span class="pcoded-mtext">Pontuação</span></a></li>

                    <li data-username="Ranking" class="nav-item <?php echo ($this->uri->segment(3) == 'ranking') ? 'active' : null ?>"><a href="<?=site_url('painel/Acompanhamento/ranking')?>" class="nav-link"><span class="pcoded-micon"><i class="bi bi-trophy"></i></span><span class="pcoded-mtext">Ranking</span></a></li>
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

                <!-- Menu Envio de Email -->
                <li>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-mail"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notification">
                            <div class="noti-head">
                                <h6 class="d-inline-block m-b-0">Notificações</h6>
                            </div>
                            <ul class="noti-body d-flex flex-column justify-content-between px-4 py-3">
                                <div>
                                    <div class="mb-1">
                                        De: <span class="text-muted">ifesquiz@gmail.com</span>
                                    </div>
                                    <div>
                                        Para: <span class="text-muted"><?=$this->session->userdata('quiz_usuemail')?></span>
                                    </div>
                                    <hr>
                                </div>

                                <div class="text-muted text-center mb-2">
                                    <i style="color: #C7C7C7; font-size: 36px" class="fa-solid fa-paper-plane"></i>
                                    <p class="mt-2 mb-0">Você receberá um e-mail contendo todos os detalhes do evento atual ativo.
                                </div>

                                <div>
                                    <a class="w-100 btn btn-sm btn-success text-white mr-0" href="<?=site_url('painel/Notificacao/enviar')?>">Enviar</a>
                                    <a class="w-100 btn btn-sm btn-info text-white m-0 disabled" href="<?=site_url('painel/Notificacao/automatico')?>">Envio automático</a>
                                </div>
                            </ul>
                        </div>
                    </div>
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
                                <i class="bi bi-person-circle mr-2" style="font-size: 25px"></i>
                                <span><?=$this->session->userdata('quiz_usunome')?></span>
                                <a href="<?=site_url('painel/Login/logout')?>" class="dud-logout" title="Sair">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">
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
    <script src="<?=base_url('assets/plugins/jquery-ui/js/jquery-ui.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?=base_url('assets/js/pcoded.min.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>
    
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