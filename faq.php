<?php require_once "./managers/dbm.php"; ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Last Action - FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #101010;
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
            background-color: #303030;
            border-radius: 10px;
            min-width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        .form-container button {
            border: 0.03rem solid #606060;
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
    <a href="<?= isset($_SESSION["user"]) ? "./authed/" : "./" ?>" class="home-link"><img src="https://cdn-icons-png.flaticon.com/512/1946/1946436.png" alt="Home"></a>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <div class="faq-container">
                    <div class="accordion" id="faqAccordion">
                        <?php
                        $gfaq = Getfaq();
                        for ($i = 0; $i < count($gfaq); $i++) {
                        ?>
                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header" id="heading<?= $i ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i ?>" aria-expanded="false" aria-controls="collapse<?= $i ?>">
                                        <?= $gfaq[$i]["question"] ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body text-break">
                                        <?= $gfaq[$i]["answer"] ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        if (count($gfaq) < 1) {
                        ?>
                            <div class="alert alert-warning">
                                No faq found
                            </div>
                        <?php }
                        unset($gfaq);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_POST["sendfaq"])) {
            if (str_contains($_POST["question"], "‎")) { ?>
                <div class="alert alert-danger">Question must not containing empty char</div>
            <?php
                unset($_POST["question"]);
            } else {
                $_SESSION["faqsent"] = time();
                AddFAQ($_POST["email"], $_POST["question"]);
                header("refresh:3;");?>
                <div class="alert alert-success">Question Sent</div>
            <?php }}

        $faq_reSendMin = 10;
        $faq_timeCalc = isset($_SESSION["faqsent"]) ? (time() - $_SESSION["faqsent"]) : $faq_reSendMin * 60;
        if ($faq_timeCalc < $faq_reSendMin * 60) {
            $remainingTime = ($faq_reSendMin * 60) - $faq_timeCalc;
            $remainingMinutes = floor($remainingTime / 60);
            $remainingSeconds = $remainingTime % 60;
            ?>
            <div class="alert alert-warning">
                Message already received from this device
                (you can ask new question in <?= $remainingMinutes ?> minutes and <?= $remainingSeconds ?> seconds)
            </div>
        <?php } else { ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-container">
                        <h3 class="text-center mb-4">Ask a Question</h3>
                        <form id="questionForm" method="post">
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input <?= isset($_POST["email"]) ? "value=" . $_POST["email"] : "" ?> name="email" minlength="1" maxlength="64" type="email" class="form-control" id="inputEmail" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputQuestion" class="form-label">Question</label>
                                <textarea <?= isset($_POST["question"]) ? "value=" . $_POST["question"] : "" ?> minlength="6" name="question" maxlength="512" class="form-control" id="inputQuestion" rows="3" placeholder="Enter your question" required></textarea>
                            </div>
                            <button name="sendfaq" type="submit" class="w-100 btn btn-dark btn-block">Send</button>
                            <i class="d-block w-100 text-center alert alert-warning p-1 mt-2">Please be nice while asking question</i>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="text-center w-100 mt-2"><i>you can only ask questions in every <?= $faq_reSendMin ?> minutes</i></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>