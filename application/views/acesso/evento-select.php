<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header">
                    <div class="page-block">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="page-header-title">
                                    <h5>Home</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body container">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="card card-rounded">
                            <div class="card-header p-0 mx-5 my-3 border-0">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 order-2 order-md-1 d-flex flex-column justify-content-between">
                                        <div class="d-none d-md-block">
                                            <img class="img-fluid img-logo-header" src="<?=base_url('assets/img/logo_cor.png')?>" alt="logo_ifes">
                                        </div>
                                        
                                        <div>
                                            <h1 class="acesso-title mt-5 mt-md-0">Quiz IFES</h1>
                                            <p class="acesso-subtitle mb-0">
                                                <i class="fa-solid fa-location-arrow mr-2"></i>
                                                Selecione um dos eventos abaixo para participar.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 order-1 order-md-2">
                                        <div class="d-flex justify-content-center">
                                            <img class="img-fluid w-75 img-header" src="<?=base_url('assets/img/image-home.png') ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body mx-0 mx-md-4 event-list">
                                <div class="row">
                                    {EVENTOS}
                                    <div class="col-md-6 col-lg-4 event-card mt-3">
                                        <a href="{URL_ACESSAR}" class="btn-access">
                                            <div class="card event-card-rounded">
                                                <div class="row no-gutters">
                                                    <div class="col-md-12">
                                                        <div class="card-header p-0"
                                                            style="
                                                                height: 50px; 
                                                                background-image: url('<?=base_url("{eveimg}") ?>'); 
                                                                background-size: cover; 
                                                                background-position: center;
                                                                background-repeat: no-repeat;"
                                                        >
                                                        </div>
                                                        <div class="card-body">
                                                            <h6 class="card-title">{evenome}</h6>
                                                            <div class="d-flex justify-content-between">
                                                                <small class="text-muted">Criado em {criado_em}</small>
                                                                <div class="d-flex align-items-center">
                                                                    <small class="{COR_SITUACAO}">{evesituacao}</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    {/EVENTOS}
                                </div>
                            </div>

                            <div class="card-footer d-block d-md-none">
                                <div class="d-flex justify-content-center justify-content-md-end">
                                    <img width="120px" src="<?=base_url('assets/img/logo_cor.png')?>" alt="logo_ifes">
                                </div>
                            </div>
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<script>
    window.onload = function(){
        {RES_OK}


        gsap.to(".card-rounded", {
            opacity: 1,
            duration: 0.5,
            ease: 'power4.Out'
        });

        gsap.fromTo(".img-logo-header", {
            opacity: 0,
            x: 100
        }, {
            opacity: 1,
            x: 0,
            duration: 1.5,
            ease: 'power4.Out',
            delay: 0.5
        });

        gsap.fromTo(".acesso-title", {
            opacity: 0,
            x: -200 
        }, {
            opacity: 1,
            x: 0,
            duration: 1,
            ease: 'power4.Out',
            delay: 0.5
        });

        gsap.fromTo(".acesso-subtitle", {
            opacity: 0,
            y: -20 
        }, {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power4.Out',
            delay: 2
        });

        gsap.fromTo(".img-header", {
            opacity: 0,
            x: 100 
        }, {
            opacity: 1,
            x: 0,
            duration: 1.5,
            ease: 'power4.Out',
        });

        gsap.fromTo(".event-list", {
            opacity: 0,
            y: -20
        }, {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power4.Out',
            delay: 1,
        });
    }
</script>