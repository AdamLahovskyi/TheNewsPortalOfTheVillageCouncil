<?php

use core\Core;

$this->Title = 'Edit News';
$core = Core::get();
$id = Core::get()->id;
try {
    $newsItem = $core->db->selectById('news', $id, '*');
} catch (Exception $e) {
}
?>
<form method="post" action="news/updatenews">
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title"
               value="<?php echo htmlspecialchars($newsItem['title']); ?>">
    </div>
    <div class="mb-4">
        <label for="text" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
        <textarea class="form-control w-full h-80 px-4 py-2 border rounded-lg resize-y" rows="10" id="text"
                  name="text"><?php echo $newsItem['text']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="short_text" class="form-label">Short Description</label>
        <input type="text" value="<?php echo htmlspecialchars($newsItem['short_text']); ?>" class="form-control"
               id="short_text" name="short_text">
    </div>
    <div class="mb-3">
        <label for="isFeatured" class="form-label">Featured</label>
        <select class="form-control" id="isFeatured" name="isFeatured">
            <option value="0" <?php if ($newsItem['isFeatured'] == 0) echo "selected"; ?>>No</option>
            <option value="1" <?php if ($newsItem['isFeatured'] == 1) echo "selected"; ?>>Yes</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
</form>

