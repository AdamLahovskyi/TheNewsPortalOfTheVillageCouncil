<?php

use models\Users;

$this->Title = 'Profile';
$user = Users::GetLoggedInUser();
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">My Profile</h3>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Login:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                                   value="<?php echo htmlspecialchars($user['login']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Firstname:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                                   value="<?php echo htmlspecialchars($user['firstname']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label">Lastname:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                                   value="<?php echo htmlspecialchars($user['lastname']); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <a href="/users/logout" class="btn btn-primary">Log Out</a>
                        <a href="/users/editprofile" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
