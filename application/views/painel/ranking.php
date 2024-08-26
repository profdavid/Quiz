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
                                    <li class="breadcrumb-item"><a href="#!">Pontuação</a></li>
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
                                                            <span style="font-size: 18px" class="badge badge-warning mr-2">1°</span>
                                                            <span style="font-size: 26px"><?= $EQUIPES[0]['equnome'] ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <?php for ($i = 1; $i < 3; $i++): ?>
                                                        <div class="col-6 d-flex flex-column align-items-center px-4 py-1">
                                                            <img
                                                                style="border: 3px solid #5bc0de" 
                                                                width="75" class="rounded-circle m-2"
                                                                src="<?= base_url($EQUIPES[$i]['equlogo']) ?>" alt="logo"
                                                            >
                                                            <div class="align-self-center">
                                                                <span style="font-size: 18px" class="badge badge-info mr-2"><?= $EQUIPES[$i]['posicao'] ?>°</span>
                                                                <span><?= $EQUIPES[$i]['equnome'] ?></span>
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
                                                            class="border border-secondary rounded-circle m-2"
                                                            width="35"
                                                            src="<?= base_url($EQUIPES[$i]['equlogo']) ?>" alt="logo"
                                                        >
                                                        <div class="align-self-center">
                                                            <strong><?= $EQUIPES[$i]['posicao'] ?>°</strong> <?= $EQUIPES[$i]['equnome'] ?>
                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
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
        const duration = 10 * 1000,
        animationEnd = Date.now() + duration,
        defaults = { startVelocity: 40, spread: 360, ticks: 60, zIndex: 0, scalar: 1.2 };

        function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
        }

        const interval = setInterval(function() {
            const timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
                return clearInterval(interval);
            }

            const particleCount = 30 * (timeLeft / duration);

            confetti(
                Object.assign({}, defaults, {
                    particleCount,
                    origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
                })
            );
            confetti(
                Object.assign({}, defaults, {
                    particleCount,
                    origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
                })
            );
        }, 250);
    };

    document.addEventListener("DOMContentLoaded", (event) => {
        gsap.to(".fa-trophy", {
            opacity: 1,
            rotateX: 360,
            rotate: 360,
            scale: 1.2,
            duration: 5,
            ease: "elastic.out"
        });

        gsap.to(".bg-ranking", {
            y: 0,
            opacity: 1,
            duration: 1,
            ease: "power4.inOut"
        });
    });
</script>