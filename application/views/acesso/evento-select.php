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
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center mb-4">
                                    <div class="d-flex overflow justify-content-center w-100">
                                        <div class="items">
                                            <div class="anim anim1">
                                                <img src="<?=base_url('assets/img/conversacao.png') ?>" class="anim-item"></img>
                                            </div>
                                            <div class="anim anim2">
                                                <img src="<?=base_url('assets/img/help.png') ?>" class="anim-item"></img>
                                            </div>
                                            <div class="anim anim3">
                                                <img src="<?=base_url('assets/img/prazo-final.png') ?>" class="anim-item"></img>
                                            </div>
                                            <div class="anim anim4">
                                                <img src="<?=base_url('assets/img/trofeu.png') ?>" class="anim-item"></img>
                                            </div>
                                            <div class="anim anim5">
                                                <img src="<?=base_url('assets/img/soquinho.png') ?>" class="anim-item"></img>
                                            </div>
                                            <div class="anim anim6">
                                                <img src="<?=base_url('assets/img/questao.png') ?>" class="anim-item"></img>
                                            </div>
                                        </div>
                                        <div class="word"><span>MOTIVAÇÃO</span></div>
                                        <div class="word"><span>JOGO</span></div>
                                        <div class="word"><span>INTERAÇÃO</span></div>
                                    </div>
                                    <h3 class="text-center">Bem vindo ao Quiz IFES</h3>
                                    <span>Selecione um evento:</span>
                                </div>
                                <div class="row">
                                    {EVENTOS}
                                    <div class="col-md-6 col-lg-4 event-card mt-3">
                                        <a href="{URL_ACESSAR}" class="btn-access">
                                            <div class="card">
                                                <div class="row no-gutters">
                                                    <div class="col-md-12">
                                                        <div class="card-header p-0"
                                                            style="
                                                                height: 60px; 
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
                                                                <small class="{COR_SITUACAO}">{evesituacao}</small>
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
        // Animacao dos icones
        const tl = gsap.timeline({ repeat: -1 });

        tl.to(".anim-item", {
            rotation: -120,
            rotationX: 180,
            opacity: 1,
            scale: 1.6,
            duration: 3,
            ease: "elastic.out"
        }).to(".anim-item", {
            rotation: -60,
            rotationX: 360,
            scale: 1.2,
            duration: 4,
            ease: "elastic.inOut"
        }).to(".anim-item", {
            rotation: -90,
            scale: 1.4,
            duration: 3,
            ease: "elastic.out"
        }).to(".anim-item", {
            rotation: -90,
            scale: 0.5,
            rotationY: 180,
            duration: 3,
            opacity: 0,
            ease: "elastic.in"
        })

        gsap.to(".items", {
            rotation: 360,
            repeat: -1,
            duration: 18,
            ease: "linear"
        })


        //Animação das palavras
        const palavras = document.querySelectorAll('.word');
        const tl2 = gsap.timeline({ repeat: -1 });

        tl2.to(palavras[0], { opacity: 1, duration: 1.5 })
            .to(palavras[0], { opacity: 0, duration: 0.3 })
            .to(palavras[1], { opacity: 1, duration: 1.5 })
            .to(palavras[1], { opacity: 0, duration: 0.3 })
            .to(palavras[2], { opacity: 1, duration: 1.5 })
            .to(palavras[2], { opacity: 0, duration: 0.3 })

        
        // Animação dos cards
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