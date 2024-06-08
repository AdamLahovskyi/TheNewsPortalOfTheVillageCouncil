<?php
$this->Title = 'Latest News';

use core\DB;

$core = core\Core::get();

$today = date("Y-m-d");
$newsItems = $core->db->select('news', '*', ['date' => $today], 'id DESC');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->Title; ?></title>
    <link rel="stylesheet" href="views/styles/isFeatured">
</head>
<style>
    .badge-featured {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        background-color: gold;
        color: black;
        font-weight: bold;
        border-radius: 3px;
        z-index: 1000;
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }
</style>
<body>
<div class="container">
    <div class="col-md-100%">
        <h1>Latest News</h1>
        <?php if ($newsItems): ?>
            <?php foreach ($newsItems as $newsItem): ?>
                <div class="card mb-3" style="width: 100%; position: relative;">
                    <?php if ($newsItem['isFeatured']): ?>
                        <span class="badge-featured">Featured</span>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($newsItem['short_text']); ?></p>
                        <p class="card-text"><small class="text-muted">Date: <?php echo htmlspecialchars($newsItem['date']); ?></small></p>
                        <a href="/news/view/<?= $newsItem['id'] ?>" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                No News For Today((
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
