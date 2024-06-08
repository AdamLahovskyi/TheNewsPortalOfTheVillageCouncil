<?php
$this->Title = 'Edit Profile';
$user = \models\Users::GetLoggedInUser();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="/users/updateprofile" method="POST">
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Login:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="login" value="<?php echo htmlspecialchars($user['login']); ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Firstname:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>">
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-4 col-form-label">Lastname:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
