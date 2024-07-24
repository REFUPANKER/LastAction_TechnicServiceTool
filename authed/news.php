<?php
if (!isset($_SESSION["user"])) {
    header("location:../auth.php");
}
?>
<style>
    .news {
        background-color: #343a40;
        color: white;
        font-family: Arial, sans-serif;
        margin: 1vw;
    }

    .news .news-container {
        min-height: 60vh;
        max-height: 80vh;
        overflow-y: auto;
        padding: 0 3vw;
    }

    .news .news-title {
        text-align: center;

    }

    .news .news-item {
        margin-bottom: 10px;
    }
</style>


<div class="news d-flex flex-column w-auto ">
    <h2 class="news-title">News</h2>
    <div class="news-container">
        <div class="accordion p-1" id="newsAccordion">
            <?php
            $gnews = GetNews();
            for ($i = 0; $i < count($gnews); $i++) {
            ?>
                <div class="accordion-item news-item">
                    <h2 class="accordion-header" id="heading<?= $i ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>">
                            <?= $gnews[$i]["title"] ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i ?>" data-bs-parent="#newsAccordion">
                        <div class="accordion-body text-break">
                            <?= $gnews[$i]["content"] ?>
                            <hr class="mt-1 mb-1">
                            <h6><?= $gnews[$i]["date"] ?></h6>
                        </div>
                    </div>
                </div>
            <?php
            }
            if (count($gnews) < 1) {
            ?>
            <div class="alert alert-warning">
                No news found
            </div>
            <?php }
            unset($gnews);
            ?>
        </div>
    </div>
</div>