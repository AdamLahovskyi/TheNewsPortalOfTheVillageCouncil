<?php
$this->Title = 'Latest News';

use core\DB;

$core = core\Core::get();

$today = date("Y-m-d");
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 10;
$offset = ($page - 1) * $perPage;

$newsItems = $core->db->select('news', '*', ['isFeatured' => 1], 'id DESC', $perPage, $offset);

$totalNewsItems = $core->db->select('news', 'COUNT(*)', ['isFeatured' => 1])[0]['COUNT(*)'];

$pagination = core\Pagination::paginate($totalNewsItems, $page, $perPage);
$totalPages = $pagination['total_pages']
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $this->Title; ?></title>
    <link rel="stylesheet" href="/views/styles/isFeatured.css">
    <link rel="stylesheet" href="/views/styles/pagination.css">
</head>
<body>
<div class="container">
    <div class="col-md-100%">
        <h1>Featured News</h1>
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
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" <?php if ($i === $page) echo 'class="current"'; ?>><?php echo $i; ?></a>
                <?php endfor; ?>
                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                No News For Today((
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
