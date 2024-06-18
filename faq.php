<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action - FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #343a40;
            color: white;
            font-family: Arial, sans-serif;
            margin: 3vw;
        }

        .faq-container {
            min-height: 60vh;
            max-height: 80vh;
            overflow-y: auto;
            padding: 20px;
        }

        .faq-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .faq-item {
            margin-bottom: 10px;
        }

        .form-container {
            margin-top: 20px;
            padding: 20px;
            background-color: #495057;
            border-radius: 10px;
            min-width: 50%;
            margin-left: auto;
            margin-right: auto;
        }

        textarea {
            resize: none;
        }

        .home-link {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
            text-decoration: none;
            filter: invert(1);
        }

        .home-link img {
            width: 32px;
            height: 32px;
        }
    </style>
</head>

<body>
    <a href="./" class="home-link"><img src="https://cdn-icons-png.flaticon.com/512/1946/1946436.png" alt="Home"></a>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <div class="faq-container">
                    <div class="accordion" id="faqAccordion">
                        <?php

                        for ($i = 0; $i < 10; $i++) {
                        ?>
                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header" id="heading<?= $i ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>">
                                        Question <?= $i ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Answer <?= $i ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <!-- <div class="accordion-item faq-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    Question 1
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Answer 1
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h3 class="text-center mb-4">Ask a Question</h3>
                    <form id="questionForm" method="post">
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="inputTitle" placeholder="Enter title" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputQuestion" class="form-label">Question</label>
                            <textarea class="form-control" id="inputQuestion" rows="3" placeholder="Enter your question" required></textarea>
                        </div>
                        <button type="submit" class="w-100 btn btn-dark btn-block">Send</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>