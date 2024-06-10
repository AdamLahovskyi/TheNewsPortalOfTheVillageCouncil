<?php

use core\DB;

$core = core\Core::get();
$this->Title='News Archive';
var_dump($_GET);
$page = isset($_GET['page']) ? $_GET['page'] : 1;

?>
<div class="container">
    <div class="col-md-100%">
        <h1>News</h1>
        <div class="content">
        </div>
    </div>

</div>