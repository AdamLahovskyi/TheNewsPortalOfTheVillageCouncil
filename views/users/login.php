<?php
/** @var string $error_message Error Message*/
$this->Title = 'Sign In'
?>
<form method="post" action="">
    <?php if(!empty($error_message)) :?>
        <div class="alert alert-danger" role="alert">
            <?=$error_message?>
        </div>
    <?php endif; ?>
    <div class="mb-3">
        <label for="inputEmail1" class="form-label">Login / Email</label>
        <input name="login" type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="inputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="inputPassword1">
    </div>
    <button type="submit" class="btn btn-primary">LogIn</button>
</form>