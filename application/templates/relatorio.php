<!DOCTYPE html>
<html lang="br">

<head>
    <title>Quiz - Relatório</title>
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

        .tabledit-delete-button{
            margin: 0; 
            padding: 0; 
            border:0;
        }

        .font-poppins {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .badge-small {
            font-size: 14px;
            margin: 3px;
        }

        .card-resposta-correta {
            border: 1px solid #28A745;
            background-color: #28A74515;
            z-index: 1; 
        }

        .card-resposta-correta code,
        .card-resposta-correta span,
        .card-resposta-correta p {
            color: #28A745;
        }

        @media print {
          .navbar {
              display: block;
              border-width:0 !important;
          }
          .navbar-toggle {
              display:none;
          }
          .print-break {page-break-after: always;}
        }
    </style>
</head>

<body style="background-color: #eff3f6; padding: 50px;">

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
    
</body>
</html>