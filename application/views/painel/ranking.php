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
                                    <h5 class="m-b-10">Ranking</h5>
                                </div>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#!">Geral</a></li>
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
                                {RES_ERRO}
                                <div class="card">
                                    <div class="card-body container">
                                        
                                    <?php if (!empty($EQUIPES)): ?>
                                        <div class="row">
                                            <div class="col-md-6 align-content-center">
                                                <div class="row mb-4">
                                                    <div class="col-12 d-flex justify-content-center flex-column align-items-center px-4 py-1">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <i style="font-size: 36px; transform: scale(0.5); opacity: 0; color: #FFBF00"
                                                                class="fa fa-trophy mt-3 mb-1">
                                                            </i>
                                                            <img
                                                                style="border: 5px solid #FFBF00" 
                                                                width="130" class="rounded-circle m-2"
                                                                src="<?= base_url($EQUIPES[0]['equlogo']) ?>" alt="logo"
                                                            >
                                                        </div>
                                                        <div class="align-self-center">
                                                            <div class="d-flex justify-content-center">
                                                                <div>
                                                                    <strong style="font-size: 18px" class="badge badge-warning mr-2">1°</strong>
                                                                </div>
                                                                <h4 style="font-size: 26px"><?= $EQUIPES[0]['equnome'] ?></h4>
                                                            </div>
                                                            <div class="d-flex flex-column badge text-warning py-2">
                                                                <div>
                                                                    <i class="fa-solid fa-star"></i>
                                                                    <?= $EQUIPES[0]['pontos'] ?> pontos
                                                                </div>
                                                                <div class="mt-2">
                                                                    <i class="fa-solid fa-clock"></i>
                                                                    <?= $EQUIPES[0]['tempo'] ?> segundos
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <?php for ($i = 1; $i < 3; $i++): ?>
                                                        <div class="col-6 d-flex flex-column text-center align-items-center px-4 py-1">
                                                            <img
                                                                style="border: 3px solid #5bc0de" 
                                                                width="75" class="rounded-circle m-2"
                                                                src="<?= base_url($EQUIPES[$i]['equlogo']) ?>" alt="logo"
                                                            >
                                                            <div class="align-self-center">
                                                                <div class="d-flex justify-content-center">
                                                                    <div>
                                                                        <strong style="font-size: 16px" class="badge badge-info mr-2"><?= $EQUIPES[$i]['ranking'] ?>°</strong>
                                                                    </div>
                                                                    <h4><?= $EQUIPES[$i]['equnome'] ?></h4>
                                                                </div>
                                                                <div class="d-flex flex-column badge text-info py-2">
                                                                    <div>
                                                                        <i class="fa-solid fa-star"></i>
                                                                        <?= $EQUIPES[$i]['pontos'] ?> pontos
                                                                    </div>
                                                                    <div class="mt-2">
                                                                        <i class="fa-solid fa-clock"></i>
                                                                        <?= $EQUIPES[$i]['tempo'] ?> segundos
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endfor; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 bg-ranking text-center align-content-center"></div>
                                            
                                            <div class="col-md-12 align-content-center">
                                                <?php for ($i = 3; $i < count($EQUIPES); $i++): ?>
                                                    <div class="d-flex px-4 py-1 my-1 bg-gray">
                                                        <img
                                                            class="rounded-circle m-2"
                                                            width="35"
                                                            src="<?= base_url($EQUIPES[$i]['equlogo']) ?>" alt="logo"
                                                        >
                                                        <div class="d-flex align-self-center align-items-center">
                                                            <strong>
                                                                <?= $EQUIPES[$i]['ranking'] ?>° <?= $EQUIPES[$i]['equnome'] ?>
                                                            </strong>
                                                            <div class="ml-2">
                                                                <div class="d-flex flex-column badge py-1 px-3">
                                                                    <div>
                                                                        <i class="fa-solid fa-star"></i>
                                                                        <?= $EQUIPES[$i]['pontos'] ?> pontos
                                                                    </div>
                                                                    <div class="mt-2">
                                                                        <i class="fa-solid fa-clock"></i>
                                                                        <?= $EQUIPES[$i]['tempo'] ?> segundos
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <span>Nenhum dado encontrado.</span>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        confetti({
            particleCount: 200,
            spread: 200,
            origin: { y: 0.6 },
        });
    };

    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.to(".fa-trophy", {
            opacity: 1,
            rotateX: 360,
            rotate: 360,
            scale: 1.3,
            duration: 3,
            ease: "elastic.out",
            repeat: -1,
            yoyo: true
        });

        gsap.to(".bg-ranking", {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "power4.inOut"
        });
    });
</script>