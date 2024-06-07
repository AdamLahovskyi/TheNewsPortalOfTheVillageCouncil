<?php
$this->Title = 'Main Page';
use core\DB;

$core = core\Core::get();

$today = date("Y-m-d");
$newsItems = $core->db->select('news', '*', ['date' => $today], 'date DESC');
$categories = $core->db->select('categories', '*');

$newsByCategory = [];
if ($newsItems) {
    foreach ($newsItems as $newsItem) {
        $categoryName = $newsItem['category_name'];
        if (!isset($newsByCategory[$categoryName])) {
            $newsByCategory[$categoryName] = [];
        }
        $newsByCategory[$categoryName][] = $newsItem;
    }
}
?>
<div class="container">
    <div class="col-md-100%">
        <h1>Today's News</h1>
        <?php if ($newsByCategory): ?>
            <?php foreach ($newsByCategory as $categoryName => $newsItems): ?>
                <h2 class="text-center"><?php echo htmlspecialchars($categoryName); ?></h2>
                <?php foreach ($newsItems as $newsItem): ?>
                    <div class="card mb-3" style="width: 100%;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($newsItem['short_text']); ?></p>
                            <p class="card-text"><small class="text-muted">Date: <?php echo htmlspecialchars($newsItem['date']);  ?></small></p>
                            <a href="#" class="btn btn-primary">Read more</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No news items found for today.</p>
        <?php endif; ?>
    </div>
</div>
