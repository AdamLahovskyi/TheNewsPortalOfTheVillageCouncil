<?php
/** @var string $error_message Error Message*/
$this->Title = 'Sign Up';
?>
<form method="post" action="">
    <?php if (!empty($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $error_message ?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="inputEmail1" class="form-label">Login / Email</label>
        <input value="<?= $this->controller->post->login ?>" name="login" type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="inputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="inputPassword1">
    </div>
    <div class="mb-3">
        <label for="inputPassword2" class="form-label">Repeat Password</label>
        <input name="password2" type="password" class="form-control" id="inputPassword2">
    </div>
    <div class="mb-3">
        <label for="inputFirstname" class="form-label">First Name</label>
        <input value="<?= $this->controller->post->firstname ?>" name="firstname" type="text" class="form-control" id="inputFirstname">
    </div>
    <div class="mb-3">
        <label for="inputLastname" class="form-label">Last Name</label>
        <input value="<?= $this->controller->post->lastname ?>" name="lastname" type="text" class="form-control" id="inputLastname">
    </div>
    <div class="mb-3">
        <label for="inputProfilePicture" class="form-label">Profile Picture</label>
        <input name="picture" type="file" class="form-control" id="inputProfilePicture" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Sign Up</button>
</form>
