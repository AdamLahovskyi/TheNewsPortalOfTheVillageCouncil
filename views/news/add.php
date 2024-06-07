<?php
/** @var string $error_message Error Message*/
$this->Title = 'Add News';
?>
<form method="post" action="">
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Description</label>
        <input type="text" class="form-control" id="text" name="text">
    </div>
    <div class="mb-3">
        <label for="short_text" class="form-label">Short Description</label>
        <input type="text" class="form-control" id="short_text" name="short_text">
    </div>
    <div class="mb-3">
        <label for="isFeatured" class="form-label">Featured</label>
        <select class="form-control" id="isFeatured" name="isFeatured">
            <option value="false">No</option>
            <option value="true">Yes</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

