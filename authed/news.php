<style>
    .faq {
        background-color: #343a40;
        color: white;
        font-family: Arial, sans-serif;
        margin: 1vw;
    }

    .faq .faq-container {
        min-height: 60vh;
        max-height: 80vh;
        overflow-y: auto;
        padding:0 3vw;
    }

    .faq .faq-title {
        text-align: center;
        
    }

    .faq .faq-item {
        margin-bottom: 10px;
    }

    .faq .form-container {
        
        background-color: #495057;
        border-radius: 10px;
        min-width: 50%;
        margin-left: auto;
        margin-right: auto;
    }
</style>


<div class="faq d-flex flex-column w-auto h-100 ">
    <h2 class="faq-title">News</h2>
    <div class="faq-container">
        <div class="accordion" id="faqAccordion">
            <?php
            for ($i = 0; $i < 10; $i++) {
            ?>
                <div class="accordion-item faq-item">
                    <h2 class="accordion-header" id="heading<?= $i ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>">
                            Title <?= $i ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Description.MD <?= $i ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>