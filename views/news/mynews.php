<?php
$this->Title = 'Latest News';
use models\Users;

$core = core\Core::get();

$newsItems = $core->db->select('news', '*', ['posted_by' => Users::GetLoggedInUser()['login']], 'id DESC');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->Title; ?></title>
    <link rel="stylesheet" href="/views/styles/isFeatured.css">
</head>
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
