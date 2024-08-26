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
                                    <h5 class="m-b-10">Acesso</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#!">Eventos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="card">
                            <div class="card-body">
                                <div class="mt-2 mb-4">
                                    <h3 class="f-w-500">Bem vindo ao Quiz IFES!</h3>
                                    <p>Escolha um evento para entrar</p>
                                </div>

                                <div class="row">
                                    {EVENTOS}
                                    <div class="col-md-6 col-lg-4 event-card">
                                        <div class="card">
                                            <div class="row no-gutters">
                                                <div class="col-md-12">
                                                    <div class="card-body">
                                                        <div class="d-flex justify-content-between">
                                                            <h5 class="card-title">{evenome}</h5>
                                                            <span class="card-text">
                                                                <small class="{COR_SITUACAO}">{evesituacao}</small>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <span class="card-text">
                                                                <small class="text-muted">Criado em {criado_em}</small>
                                                            </span>
                                                        </div>
                                                        <div class="mt-2 {BTN_DISABLED}">
                                                            <a href="{URL_ACESSAR}" class="btn w-100 btn-sm btn-primary m-0">
                                                                Acessar
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/EVENTOS}
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
    window.onload = function(){ {RES_OK} }

    document.addEventListener("DOMContentLoaded", (event) => {
        const eventCards = document.querySelectorAll('.event-card');

        function animateCard(card, delay) {
            gsap.fromTo(card, {
                opacity: 0,
                y: 30, 
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power4.Out',
                delay: delay,
            });
        }

        eventCards.forEach((card, index) => { animateCard(card, index * 0.2) });
    });
</script>