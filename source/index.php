<?php
ob_start();
?>


<html>
    <head>
        <title> Authentication page</title>
        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?>/css/index_1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.10/sweetalert2.css" type="text/css" />
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.10/sweetalert2.js"></script>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    </head>

    <body>


<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://devcache1:6379,tcp://devcache1:6379');
session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/Classes/Auth.php";
require_once $_SERVER['DOCUMENT_ROOT']."/Classes/Util.php";

$auth = new Auth();
$util = new Util();

require_once $_SERVER['DOCUMENT_ROOT']."/Classes/authCookieSessionValidate.php";


//die;
if ($isLoggedIn) {
    $util->redirect("crud/crud_read.php");
}

if (isset($_POST['btn_signin'])) {
    
    if (! empty($_POST["login_signin"])) {
        $isAuthenticated = false;

        $username = $_POST["login_signin"];
        $password = $_POST["password_signin"];

        $user = $auth->getMemberByUsername($username);
        if (password_verify($password, $user[0]["u_pass"])) {
            $isAuthenticated = true;
        }

        if ($isAuthenticated) {
            
            if($user[0]["u_status"])
            {
                
                $_SESSION["member_id"] = $user[0]["u_id"];

                // Set Auth Cookies if 'Remember Me' checked
                if (! empty($_POST["remember"])) 
                {
                    setcookie("member_login", $username, $cookie_expiration_time);

                    $random_password = $util->getToken(16);
                    setcookie("random_password", $random_password, $cookie_expiration_time);

                    $random_selector = $util->getToken(32);
                    setcookie("random_selector", $random_selector, $cookie_expiration_time);

                    $random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);
                    $random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);

                    $expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);

                    // mark existing token as expired
                    $userToken = $auth->getTokenByUsername($username, 0);
                    if (! empty($userToken[0]["id"])) {
                        $auth->markAsExpired($userToken[0]["id"]);
                    }
                    // Insert new token
                    $auth->insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
                } 
                else 
                {
                    $util->clearAuthCookie();
                }
                $util->redirect("crud/crud_read.php");
            }
            else
            {
                ?>
            <script type="text/javascript">

                swal({
                    title: "Warning!",
                    text: "Account not activated yet.",
                    type: "warning"
                })

            </script>
<?php
                
            }
        } 
        else 
        {
            ?>
                <script type="text/javascript">

                    swal({
                        title: "Error!",
                        text: "Login and/or password are incorrects!",
                        type: "error"
                    })

                </script>
<?php
            error_log("\n error credentials", 3, "/tmp/errors.log");
        }
    }
}


?>


        <div class="container">
            <div class="frame">
                <div class="nav">
                    <ul class"links">
                        <li class="signin-active"><a class="btn">Sign in</a></li>
                        <li class="signup-inactive"><a class="btn">Sign up </a></li>
                    </ul>
                </div>
                <div ng-app ng-init="checked = false">
                    <form class="form-signin" action="" method="post" name="form">
                        <label for="login_signin">Username</label>
                        <input class="form-styling" type="text" id="login_signin" name="login_signin" />
                        <label for="password_signin">Password</label>
                        <input class="form-styling" type="password" id="password_signin" name="password_signin" />
                        <input type="checkbox" id="remember" name="remember"/>
                        <label for="remember" ><span class="ui"></span>Keep me signed in</label>
                        <div class="btn-animate">
                            <!--                    <a class="btn-signin" id="sign_in">Sign in</a>-->
                            <button type="submit" name="btn_signin"   id="btn-save" class="btn-signin">SIGN IN</button>
                        </div>
                    </form>

                    <form class="form-signup" action="" method="post" name="form">
                        <label for="login">Login</label>
                        <input class="form-styling" type="text" name="login" id="login" placeholder="" required/>
                        <label for="first_name">First name</label>
                        <input class="form-styling" type="text" name="first_name" id="first_name" placeholder=""/>
                        <label for="last_name">Last name</label>
                        <input class="form-styling" type="text" name="last_name" id="last_name" placeholder=""/>
                        <label for="email">Email</label>
                        <input class="form-styling" type="text" name="email" id="email" placeholder=""/>
                        <label for="password">Password</label>
                        <input class="form-styling" type="text" name="password" id="password" placeholder=""/>
                        <label for="confirmpassword">Confirm password</label>
                        <input class="form-styling" type="text" name="confirmpassword" id="confirmpassword" placeholder=""/>
                        <a ng-click="checked = !checked" class="btn-signup" id="sign_up">Sign Up</a>
                        <!--                <button type="submit" name="btn-save"   id="btn-save" class="btn btn-primary ">Sign Up</button>-->
                        <!--                <a class="btn-signup" id="sign_up">Sign Up</a>-->
                    </form>

                    <!--            <div  class="success">
                                    <svg width="270" height="270" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 60 60" id="check" ng-class="checked ? 'checked' : ''">
                                    <path fill="#ffffff" d="M40.61,23.03L26.67,36.97L13.495,23.788c-1.146-1.147-1.359-2.936-0.504-4.314
                                          c3.894-6.28,11.169-10.243,19.283-9.348c9.258,1.021,16.694,8.542,17.622,17.81c1.232,12.295-8.683,22.607-20.849,22.042
                                          c-9.9-0.46-18.128-8.344-18.972-18.218c-0.292-3.416,0.276-6.673,1.51-9.578" />
                                    <div class="successtext">
                                        <p> Thanks for signing up! Check your email for confirmation.</p>
                                    </div>
                                </div>-->
                </div>

                <div class="forgot">
                    <a href="#">Forgot your password?</a>
                </div>

                <!--        <div>
                            <div class="cover-photo"></div>
                            <div class="profile-photo"></div>
                            <h1 class="welcome">Welcome, Chris</h1>
                            <a class="btn-goback" value="Refresh" onClick="history.go()">Go back</a>
                        </div>-->
            </div>

            <!--  <a id="refresh" value="Refresh" onClick="history.go()">
                <svg class="refreshicon"   version="1.1" id="Capa_1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="25px" height="25px" viewBox="0 0 322.447 322.447" style="enable-background:new 0 0 322.447 322.447;"
                     xml:space="preserve">
                     <path  d="M321.832,230.327c-2.133-6.565-9.184-10.154-15.75-8.025l-16.254,5.281C299.785,206.991,305,184.347,305,161.224
                            c0-84.089-68.41-152.5-152.5-152.5C68.411,8.724,0,77.135,0,161.224s68.411,152.5,152.5,152.5c6.903,0,12.5-5.597,12.5-12.5
                            c0-6.902-5.597-12.5-12.5-12.5c-70.304,0-127.5-57.195-127.5-127.5c0-70.304,57.196-127.5,127.5-127.5
                            c70.305,0,127.5,57.196,127.5,127.5c0,19.372-4.371,38.337-12.723,55.568l-5.553-17.096c-2.133-6.564-9.186-10.156-15.75-8.025
                            c-6.566,2.134-10.16,9.186-8.027,15.751l14.74,45.368c1.715,5.283,6.615,8.642,11.885,8.642c1.279,0,2.582-0.198,3.865-0.614
                            l45.369-14.738C320.371,243.946,323.965,236.895,321.832,230.327z"/>
                </svg>
              </a>-->
        </div>
    </body>

    <script type="text/javascript">

        $(function () {
            $(".btn").click(function () {
                $(".form-signin").toggleClass("form-signin-left");
                $(".form-signup").toggleClass("form-signup-left");
                $(".frame").toggleClass("frame-long");
                $(".signup-inactive").toggleClass("signup-active");
                $(".signin-active").toggleClass("signin-inactive");
                $(".forgot").toggleClass("forgot-left");
                $(this).removeClass("idle").addClass("active");
            });
        });

        $(function () {
//        $(".btn-signup").click(function () {
//            alert($('#login').val())
////            $(".nav").toggleClass("nav-up");
////            $(".form-signup-left").toggleClass("form-signup-down");
////            $(".success").toggleClass("success-left");
////            $(".frame").toggleClass("frame-short");
//            
//            
//        });

            $("#sign_up").click(function () {
//                alert($('#login').val());
                var fd = new FormData();

                fd.append('action', 'create_user');
//            fd.append('u_id', $('#u_id').val());
                fd.append('u_login', $('#login').val());
                fd.append('u_email', $('#email').val());
                fd.append('u_first_name', $('#first_name').val());
                fd.append('u_last_name', $('#last_name').val());
                fd.append('u_pass', $('#password').val());
//                fd.append('u_status', $('#u_status').val());

                $.ajax({
                    type: 'POST',
                    url: 'crud/parsing.php',
                    data: fd,
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        $('.submitBtn').attr("disabled", "disabled");
                        $('.modal-body').css('opacity', '.5');
                    },
                    success: function (msg) {
//                        console.log('return msg :||' + msg + '||');
                        if (msg == 1) {
                            $('#new_userModal').modal('hide');
                            swal({
                                title: "Congratulation!",
                                text: "User Is Inserted Successfully!",
                                type: "success"
                            }).then(function () {
                                location.reload();
                            });
                        } 
                        else
                        {
                            $('.statusMsg').html('<span style="color:red;">Not able to execute this request, check again in few minutes ... If the problem persist, please contact your IT departement.</span>');
                        }
                        $('.submitBtn').removeAttr("disabled");
                        $('.modal-body').css('opacity', '');
                    }
                });


            });

        });


    </script>
</html>