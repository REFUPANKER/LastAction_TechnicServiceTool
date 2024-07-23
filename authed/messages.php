<h1 class="text-center m-0">Messages</h1>

<style>
    .message-card {
        background-color: #1f1f1f;
        border: none;
    }

    .message-header {
        background-color: #292929;
        border-bottom: 1px solid #444;
    }

    .message-body {
        background-color: #1f1f1f;
    }

    .container {
        max-height: 80vh;
    }
</style>
<div class="container overflow-auto gap-1 d-flex flex-column">
    <?php
    if (isset($_GET["rmsg"])) {
        RemoveMessage($_GET["rmsg"]); ?>
        <div class="alert alert-success">Message removed (refreshing in 3 sec...)</div>
    <?php header("refresh:3;?p=messages");
    }
    $getmessages = GetMessages();
    foreach ($getmessages as $key => $value) { ?>
        <div class="card message-card">
            <div class="card-header message-header rounded rounded-3" id="heading<?= $key ?>">
                <h5 class="m-0 p-0 d-flex align-items-center">
                    <button class="btn text-white w-100 text-start" data-bs-toggle="collapse" data-bs-target="#collapse<?= $key ?>" aria-expanded="true" aria-controls="collapse<?= $key ?>">
                        <?= htmlspecialchars($value["subject"]) ?>
                    </button>
                    <a href="?p=messages&rmsg=<?= $value["id"] ?>" title="delete"><i class="fas fa-trash text-danger"></i></a>
                </h5>
            </div>
            <div id="collapse<?= $key ?>" class="collapse" aria-labelledby="heading<?= $key ?>" data-bs-parent=".container">
                <div class="card-body message-body rounded rounded-3">
                    <p class="card-text"><?= htmlspecialchars($value["message"]) ?></p>
                    <hr>
                    <p class="p-0 m-0">
                        From <a target="_blank" href="mailto:<?= htmlspecialchars($value["sender"]) ?>" title="Contact"><strong><?= htmlspecialchars($value["sender"]) ?></strong></a>
                        at <strong><?= $value["datetime"] ?></strong>
                    </p>
                </div>
            </div>
        </div>
    <?php }
    if (count($getmessages) <= 0) { ?>
        <div class="alert alert-warning">
            No messages existing
        </div>
    <?php } ?>
</div>