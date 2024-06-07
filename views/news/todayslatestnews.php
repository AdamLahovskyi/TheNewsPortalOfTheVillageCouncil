<?php
$this->Title = 'Main Page';

use core\DB;

$core = core\Core::get();

$today = date("Y-m-d");
$newsItems = $core->db->select('news', '*', ['date' => $today], null);
?>
<div class="container">
    <div class="col-md-100%">
        <h1>Today's News</h1>
        <?php foreach ($newsItems as $newsItem): ?>
            <div class="card mb-3" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($newsItem['short_text']); ?></p>
                    <p class="card-text"><small
                                class="text-muted">Date: <?php echo htmlspecialchars($newsItem['date']); ?></small></p>
                    <a href="/news/view?id=<?php echo htmlspecialchars($newsItem['id']); ?>" class="btn btn-primary">Read more</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
