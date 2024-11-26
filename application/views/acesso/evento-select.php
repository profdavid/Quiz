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
                            <div class="card-body mx-0 mx-md-2">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-between">    
                                        <div class="mb-4">
                                            <div>
                                                <h1 class="acesso-title mt-4 mt-md-0">Quiz IFES</h1>
                                                <p class="acesso-subtitle mb-4">
                                                    Selecione um evento abaixo para participar:
                                                </p>
                                            </div>
                                      

                                            <div class="row">
                                                {EVENTOS}
                                                <div class="col-md-12 col-lg-6 mb-4">
                                                    <a href="{URL_ACESSAR}" class="card-event d-flex flex-column border">
                                                        <div style="
                                                            height: 65px;
                                                            background-image: url('<?=base_url("{eveimg}") ?>'); 
                                                            background-size: cover; 
                                                            background-position: center;
                                                            background-repeat: no-repeat;"
                                                        ></div>
                                                        <span class="p-2">{evenome}</span>
                                                    </a>
                                                </div>
                                                {/EVENTOS}
                                            </div>
                                        </div>

                                        <div class="d-none d-md-block">
                                            <img class="img-fluid img-logo-header" src="<?=base_url('assets/img/logo_cor.png')?>" alt="logo_ifes">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-lg-6 align-self-center">
                                        <div class="bg-events"></div>
                                    </div>
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
            ease: 'power4.in'
        });

        gsap.fromTo(".img-logo-header", {
            opacity: 0,
            x: 100
        }, {
            opacity: 1,
            x: 0,
            duration: 1.5,
            ease: 'power4.Out'
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
            delay: 1.5
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