<?php
$this->Title = 'Main Page';
use core\DB;

$core = core\Core::get();

$newsItems = $core->db->select('news', '*', null, 'date DESC', 10);
?>
<div class="container">
    <div class="col-md-9">
        <h1>Latest News</h1>
        <?php if ($newsItems): ?>
            <?php foreach ($newsItems as $newsItem): ?>
                <div class="card mb-3" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($newsItem['short_text']); ?></p>
                        <p class="card-text"><small class="text-muted">Category: <?php echo htmlspecialchars($newsItem['category_name']); ?></small>
                        <p class="card-text"><small class="text-muted">Date: <?php echo htmlspecialchars($newsItem['date']);  ?></small>
                        </p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No news items found.</p>
        <?php endif; ?>
    </div>
</div>
