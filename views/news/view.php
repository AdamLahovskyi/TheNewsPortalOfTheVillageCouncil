<?php
use models\Users;

$core = core\Core::get();
$id = core\Core::get()->id;
$newsItem = $core->db->selectById('news', $id, '*');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if ($newsItem): ?>
                <div class="post-preview">
                    <h2 class="post-title">
                        <?php echo htmlspecialchars($newsItem['title']); ?>
                    </h2>
                    <div class="image-container d-flex justify-content-center">
                        <img src="/files/newstemplateimage.jpg" class="img-thumbnail" alt="News Image" style="width: 50%">
                    </div>
                    <div class="divider"></div>
                    <p class="post-subtitle">
                        <?php echo htmlspecialchars($newsItem['text']); ?>
                    </p>
                    <p class="post-meta">
                        Posted on: <b><?php echo htmlspecialchars($newsItem['date']); ?></b>
                        by: <b><?php echo htmlspecialchars($newsItem['posted_by']); ?></b>
                    </p>
                </div>
                <hr>
            <?php else: ?>
                <div class="alert alert-danger mt-5" role="alert">
                    News item not found.
                </div>
            <?php endif; ?>
            <a href="/" class="btn btn-primary mt-3">Back to News</a>
            <?php
            if(Users::IsUserAdmin()):?>
                <a href="/news/editnews/<?php echo $id; ?>" class="btn btn-primary mt-3">Edit</a>
            <?php endif; ?>

        </div>
    </div>
</div>
