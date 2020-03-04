<?php



require_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
$_SESSION['page'] = "create";
require_once ($_SERVER['DOCUMENT_ROOT'] . "/Classes/User.php");
$user = new User();

if (isset($_POST['btn-save'])) {
    
    $u_id = trim($_POST['u_id']);
    $u_login = trim($_POST['u_login']);
    $u_pass = trim($_POST['u_pass']);
    $u_first_name = trim($_POST['u_first_name']);
    $u_last_name = trim($_POST['u_last_name']);
    $u_status = trim($_POST['u_status']);
    $u_email = trim($_POST['u_email']);
    
    $userResult = $user->addUser($u_id, $u_login, $u_email, $u_pass, $u_first_name, $u_last_name, $u_status);
    
    if($userResult==1)
    {
?>
        <script type="text/javascript">
            
            swal({
                title: "Congratulation!",
                text: "User created Successfully!",
                type: "success"
            }).then(function () {
                swal({
                    title: 'Create another user?',
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                    cancelButtonText: 'No'
                }).then(function (result) {
                    if (result.value) {
                        window.location.href = 'crud_create.php';
                    }
                    else
                    {
                        window.location.href = 'crud_read.php';
                    }
                })
            });
            
        </script>
<?php
    }
    else
    {
?>
        <script type="text/javascript">        
            swal({
                title: "ERROR!",
                text: "Insertion encounter some error, check your log!",
                type: "error"
            }).then(function () {
                window.location.href = 'crud_create.php';
            });
        </script>
<?php
    }
}

?>
<div id="container_add_article">
    <div class="page-header">
        <h2 class="upper">Add new user</h2>            
    </div>
    <br>

    <form method="post" id="form1" enctype="multipart/form-data">
        <div class="form-group row" >
            <label for="u_id" class="col-sm-2 col-form-label">ID</label>
            <div class=" col-sm-8">
                <input type="text" class="form-control" name="u_id" id="u_id"  maxlength="20"   required>
            </div>
        </div>

        <div class="form-group row" >
            <label for="u_login" class="col-sm-2 col-form-label">Login</label>
            <div class=" col-sm-8">
                <input type="text" class="form-control" name="u_login" id="u_login"  maxlength="15"  >
            </div>
        </div>
        
        <div class="form-group row" >
            <label for="u_email" class="col-sm-2 col-form-label">email</label>
            <div class=" col-sm-8">
                <input type="text" class="form-control" name="u_email" id="u_email">
            </div>
        </div>

        <div class="form-group row" >
            <label for="u_pass" class="col-sm-2 col-form-label">Password</label>
            <div class=" col-sm-8">
                <input type="password" class="form-control" name="u_pass" id="u_pass">
            </div>
        </div>

        <div class="form-group row" >
            <label for="u_first_name" class="col-sm-2 col-form-label">firstname</label>
            <div class=" col-sm-8">
                <input type="text" class="form-control" name="u_first_name" id="u_first_name">
            </div>
        </div>
        
        <div class="form-group row" >
            <label for="u_last_name" class="col-sm-2 col-form-label">lastname</label>
            <div class=" col-sm-8">
                <input type="text" class="form-control" name="u_last_name" id="u_last_name">
            </div>
        </div>

        <div class="form-group row" >
            <label for="u_status" class="col-sm-2 col-form-label">Status </label>
            <div class=" col-sm-8">
                <select class="form-control" id="u_status" name="u_status">
                    <option value="true">Active</option>
                    <option value="false">Inactive</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="custom-file col-sm-2 col-form-label"> </label>
            <div class="col-sm-4 ">
                <button type="submit" name="btn-save"   id="btn-save" class="btn btn-primary btn_bottom">Save</button>
            </div>
        </div>
    </form>
</div>


