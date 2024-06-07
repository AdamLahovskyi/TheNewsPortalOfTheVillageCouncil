<?php

use core\DB;

$core = core\Core::get();
$this->Title='Latest News';
$newsItems = $core->db->select('news', '*', ['date' => date("Y-m-d")]);

?>
<div class="container">
    <div class="col-md-100%">
        <h1>News</h1>
        <?php if ($newsItems): ?>
            <?php foreach ($newsItems as $newsItem): ?>
                <div class="card mb-3" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($newsItem['title']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($newsItem['short_text']); ?></p>
                        <p class="card-text"><small class="text-muted">Category: <?php echo htmlspecialchars($newsItem['category_name']); ?></small>
                        <p class="card-text"><small class="text-muted">Date: <?php echo htmlspecialchars($newsItem['date']); ?></small></p>
                        <a href="#" class="btn btn-primary">Read more</a>
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