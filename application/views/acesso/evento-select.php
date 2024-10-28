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
                                    <div class="col-md-6 col-sm-12 d-flex flex-column justify-content-between">    
                                        <div class="mb-4">
                                            <div class="ml-2">
                                                <h1 class="acesso-title mt-5 mt-md-0">Quiz IFES</h1>
                                                <p class="acesso-subtitle mb-3">
                                                    <i class="fa-solid fa-location-arrow mr-2"></i>
                                                    Selecione um dos eventos abaixo para participar.
                                                </p>
                                            </div>
                                      

                                            <div class="mx-0 mx-md-2 event-list">
                                                <div class="row">
                                                    {EVENTOS}
                                                    <div class="col-lg-12 event-card mt-3">
                                                        <a href="{URL_ACESSAR}" class="btn-access">
                                                            <div class="card event-card-rounded mb-0">
                                                                <div class="row no-gutters">
                                                                    <div class="col-2">
                                                                        <div class="p-0 event-image"
                                                                            style="
                                                                                height: 100%;
                                                                                background-image: url('<?=base_url("{eveimg}") ?>'); 
                                                                                background-size: cover; 
                                                                                background-position: center;
                                                                                opacity: 0.6;
                                                                                background-repeat: no-repeat;"
                                                                        >
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-8">
                                                                        <div class="card-body">
                                                                            <p style="font-weight: bold" class="text-dark mb-0">{evenome}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-2">
                                                                        <small class="event-icon"><i class="fa-solid fa-location-arrow"></i></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    {/EVENTOS}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-none d-md-block">
                                            <img class="img-fluid img-logo-header" src="<?=base_url('assets/img/logo_cor.png')?>" alt="logo_ifes">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 align-self-center">
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