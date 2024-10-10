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
                                    <li class="breadcrumb-item"><a href="<?=site_url('acesso/Gerenciador') ?>">Eventos</a></li>
                                    <li class="breadcrumb-item"><a href="#!">Escolha de equipes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ breadcrumb ] end -->

                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                            {RES_MSG}

                            <div class="card">
                                <form role="form" id="frmacao" enctype="multipart/form-data" name="frmacao" method="post" action="{URL_ACESSAR}">
                                    <input type="hidden" id="id" name="id" value="{id}" />
                                    <input type="hidden" id="evenome" name="evenome" value="{evenome}" />

                                    <div class="card-body container">
                                        <div class="row">
                                            <!-- animacao start -->
                                            <div class="col-lg-6 col-md-12 d-flex overflow justify-content-center">
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
                                            <!-- animacao end -->
                                            
                                            <div class="col-lg-6 col-md-12 d-flex flex-column justify-content-center">
                                                <h3 class="mb-4">{evenome}</h3>
                                                <div class="mb-4">
                                                    <label for="equipe">Escolha a sua equipe:</label>
                                                    <select class="form-control" name="equipe" id="equipe">
                                                        {EQUIPES}
                                                            <option value="{idequipe}">{equnome}</option>
                                                        {/EQUIPES}
                                                    </select>
                                                </div>
                                                <div class="text-right mb-lg-0 mb-5">
                                                    <button type="submit" class="btn btn-success m-0">
                                                        ENTRAR
                                                    </button> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

        const palavras = document.querySelectorAll('.word');
        const tl2 = gsap.timeline({ repeat: -1 });
        
        tl2.to(palavras[0], { opacity: 1, duration: 1.5 })
            .to(palavras[0], { opacity: 0, duration: 0.3 })
            .to(palavras[1], { opacity: 1, duration: 1.5 })
            .to(palavras[1], { opacity: 0, duration: 0.3 })
            .to(palavras[2], { opacity: 1, duration: 1.5 })
            .to(palavras[2], { opacity: 0, duration: 0.3 })
    });
</script>