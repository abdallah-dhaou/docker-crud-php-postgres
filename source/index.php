<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>PROCOMM-MMC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
<!--        <link rel="shortcut icon" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /img/favicon.ico"> -->
        <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/index.css" />
        <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/animate-custom.css" />
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/jquery.min.js"></script>        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.css" type="text/css" />

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.js"></script>

    </head>

    <!DOCTYPE html>


    <body>
        <?php
        error_reporting(0);
        ob_start();
        session_start();
        require_once 'dbconfig.php';

        // it will never let you open index(login) page if session is set
        if (isset($_SESSION['user']) != "") {
            ?>
            <script type="text/javascript">
                window.location.href = 'article/article.php';
            </script>
            <?php
            exit;
        }

        $error = false;

        if (isset($_POST['btn-login'])) {

            // prevent sql injections/ clear user invalid inputs
            $username = trim($_POST['username']);
            $username = strip_tags($username);
            $username = htmlspecialchars($username);

            $password = trim($_POST['password']);
            $password = strip_tags($password);
            $password = htmlspecialchars($password);

            if (!$error) {

                $password = hash('sha256', $password); // password hashing using SHA256
                $query = "SELECT user_id, user_name, user_pass FROM users WHERE user_email='$username' or user_name='$username'";
                $res = pg_query($dbconn, $query);
                $row = pg_fetch_array($res);
                $count = pg_num_rows($res); // if uname/pass correct , it must return 1 row

                if ($count == 1 && $row['user_pass'] == $password) {
                    $_SESSION['user'] = $row['user_id'];
                    $_SESSION["name"] = $row['user_name'];
                    ?>
                    <script type="text/javascript">
                        window.location.href = 'article/article.php';
                    </script>
                    <?php
                } else {
                    $errMSG = "Le Nom d'utilisateur et/ou le Mot de passe sont incorrects.";
                }
            }
        }

        if (isset($_POST['btn-signup'])) {

            // clean user inputs to prevent sql injections
            $usernamesignup = trim($_POST['usernamesignup']);
            $usernamesignup = strip_tags($usernamesignup);
            $usernamesignup = htmlspecialchars($usernamesignup);

            $emailsignup = trim($_POST['emailsignup']);
            $emailsignup = strip_tags($emailsignup);
            $emailsignup = htmlspecialchars($emailsignup);

            $passwordsignup = trim($_POST['passwordsignup']);
            $passwordsignup = strip_tags($passwordsignup);
            $passwordsignup = htmlspecialchars($passwordsignup);

            $passwordsignup_confirm = trim($_POST['passwordsignup_confirm']);
            $passwordsignup_confirm = strip_tags($passwordsignup_confirm);
            $passwordsignup_confirm = htmlspecialchars($passwordsignup_confirm);

            // password encrypt using SHA256();:q
            $passwordsignup = hash('sha256', $passwordsignup);

            $query_user = "INSERT INTO users(user_name,user_email,user_pass) VALUES('$usernamesignup','$emailsignup','$passwordsignup')";
            $res = pg_query($dbconn, $query_user);

            if ($res) {
                $errTyp = "success";
                $errMSG = "Successfully registered, you may login now";
                unset($name);
                unset($email);
                unset($pass);
            } else {
                $errTyp = "danger";
                $errMSG = "Something went wrong, try again...";
                ?>
                <script type="text/javascript" >
                    swal({
                        title: "Sorry!",
                        text: "Something went wrong!",
                        type: "error"
                    }).then(function () {
                        window.location.href = 'index.php';
                    });
                </script>
                <?php
            }
        }
        ?>
        <div class="container">
            <div class="codrops-top">
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>

            </header>
            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on"> 
                                <h1>Log in</h1> 

                                <div class="form-group">  
                                    <label for="username" class="uname"> Your email or username </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input id="username" name="username" required="required" oninvalid="this.setCustomValidity('Ce champ est obligatoire!');"
                                               oninput="setCustomValidity('')" type="text" placeholder="myusername or mymail@mail.com" />
                                    </div>
                                </div>

                                <div class="form-group">  
                                    <label for="password" class="youpasswd"> Your password </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input id="password" name="password" required="required" oninvalid="this.setCustomValidity('Ce champ est obligatoire!');"
                                               oninput="setCustomValidity('')" type="password" placeholder="eg. X8df!90EO" />

                                    </div>
                                </div>

                                <?php
                                if (isset($errMSG)) {
                                    ?>
                                    <div class="form-group">
                                        <div id="wrongcredentials" class="alert alert-danger">
                                            <span  class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <p class="login button"> 
                                    <input type="submit" name="btn-login" value="Login" /> 
                                </p>
                                <p class="change_link">
                                    Not a member yet ?
                                    <a href="#toregister" class="to_register">Join us</a>
                                </p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  id="register-form" method="post" action=""> 
                                <h1> Inscription </h1> 

                                <div class="form-group"> 
                                    <label for="usernamesignup" class="uname">Your username</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <input id="usernamesignup" name="usernamesignup"  type="text" placeholder="exemple : Guillaume" onfocusout="myFunction()"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12" id="toto">
                                            <span id="usernamevalid" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 4 Char long!
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">  
                                    <label for="emailsignup" class="youmail"  > Your email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                                        <input id="emailsignup" name="emailsignup"  type="text" placeholder="mysupermail@mail.com"/> 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span id="emailvalid" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Email valid
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">  
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"
                                               required="required" oninvalid="this.setCustomValidity('Ce champ est obligatoire!');" oninput="setCustomValidity('')"/>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8 Characters Long<br>
                                            <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Uppercase Letter
                                        </div>
                                        <div class="col-sm-6">
                                            <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Lowercase Letter<br>
                                            <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Number
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                        <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"
                                               required="required" oninvalid="this.setCustomValidity('Ce champ est obligatoire!');" oninput="setCustomValidity('')"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Passwords Match
                                        </div>
                                    </div>
                                </div>

                                <p class="signin button"> 
                                    <input type="submit" id="btn-signup" name="btn-signup" value="Sign up"/> 
                                </p>

                                <p class="change_link">  
                                    Already a member ?
                                    <a href="#tologin" class="to_register"> Go and log in </a>
                                </p>
                            </form>
                        </div>

                    </div>
                </div>  
            </section>
        </div>
    </body>

    <script type="text/javascript" >

        $(document).ready(function () {

            $("#usernamesignup").focus(function () {
                $("#toto").css("display", "block");
            });


            $('#btn-signup').click(function (e) {

                //function to convert rgb color code to hexadecimal
                function rgb2hex(rgb) {
                    rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
                    function hex(x) {
                        return ("0" + parseInt(x).toString(16)).slice(-2);
                    }
                    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
                }


                var username_validity = rgb2hex($('#usernamevalid').css("color"));
                var email_validity = rgb2hex($('#emailvalid').css("color"));
                var pwd_total_chars = rgb2hex($('#8char').css("color"));
                var pwd_lower_chars = rgb2hex($('#lcase').css("color"));
                var pwd_upper_chars = rgb2hex($('#ucase').css("color"));
                var pwd_num_chars = rgb2hex($('#num').css("color"));
                var pwd_match = rgb2hex($('#pwmatch').css("color"));

                if (username_validity != '#00a41e')
                {
                    $('#usernamesignup').focus();
                    e.preventDefault();
                } else
                {
                    if (email_validity != '#00a41e')
                    {
                        $('#emailsignup').focus();
                        e.preventDefault();
                    } else
                    {
                        if (pwd_total_chars != '#00a41e' || pwd_lower_chars != '#00a41e' || pwd_upper_chars != '#00a41e' || pwd_num_chars != '#00a41e' || pwd_match != '#00a41e')
                        {
                            $('#passwordsignup').focus();
                            e.preventDefault();
                        }

                    }
                }
            });
        });

        $("#usernamesignup").keyup(function (e) {

            var sEmail = $('#usernamesignup').val().length;

            if ($("#usernamesignup").val().length >= 4) {
                $('#usernamesignup').focus();
                $("#usernamevalid").removeClass("glyphicon-remove");
                $("#usernamevalid").addClass("glyphicon-ok");
                $("#usernamevalid").css("color", "#00A41E");
                e.preventDefault();
            } else
            {
                $("#usernamevalid").removeClass("glyphicon-ok");
                $("#usernamevalid").addClass("glyphicon-remove");
                $("#usernamevalid").css("color", "#FF0004");
                e.preventDefault();
            }

        });


        $("input[type=password]").keyup(function () {
            var ucase = new RegExp("[A-Z]+");
            var lcase = new RegExp("[a-z]+");
            var num = new RegExp("[0-9]+");

            if ($("#passwordsignup").val().length >= 8) {
                $("#8char").removeClass("glyphicon-remove");
                $("#8char").addClass("glyphicon-ok");
                $("#8char").css("color", "#00A41E");
            } else {
                $("#8char").removeClass("glyphicon-ok");
                $("#8char").addClass("glyphicon-remove");
                $("#8char").css("color", "#FF0004");
            }

            if (ucase.test($("#passwordsignup").val())) {
                $("#ucase").removeClass("glyphicon-remove");
                $("#ucase").addClass("glyphicon-ok");
                $("#ucase").css("color", "#00A41E");
            } else {
                $("#ucase").removeClass("glyphicon-ok");
                $("#ucase").addClass("glyphicon-remove");
                $("#ucase").css("color", "#FF0004");
            }

            if (lcase.test($("#passwordsignup").val())) {
                $("#lcase").removeClass("glyphicon-remove");
                $("#lcase").addClass("glyphicon-ok");
                $("#lcase").css("color", "#00A41E");
            } else {
                $("#lcase").removeClass("glyphicon-ok");
                $("#lcase").addClass("glyphicon-remove");
                $("#lcase").css("color", "#FF0004");
            }

            if (num.test($("#passwordsignup").val())) {
                $("#num").removeClass("glyphicon-remove");
                $("#num").addClass("glyphicon-ok");
                $("#num").css("color", "#00A41E");
            } else {
                $("#num").removeClass("glyphicon-ok");
                $("#num").addClass("glyphicon-remove");
                $("#num").css("color", "#FF0004");
            }

            if (($("#passwordsignup").val() == $("#passwordsignup_confirm").val()) && ($("#passwordsignup").val().length >= 1)) {
                $("#pwmatch").removeClass("glyphicon-remove");
                $("#pwmatch").addClass("glyphicon-ok");
                $("#pwmatch").css("color", "#00A41E");
            } else {
                $("#pwmatch").removeClass("glyphicon-ok");
                $("#pwmatch").addClass("glyphicon-remove");
                $("#pwmatch").css("color", "#FF0004");
            }
        });


        $("#emailsignup").on('keyup change', function (e) {

            var sEmail = $('#emailsignup').val();

            if (validateEmail(sEmail)) {
                $('#emailsignup').focus();
                $("#emailvalid").removeClass("glyphicon-remove");
                $("#emailvalid").addClass("glyphicon-ok");
                $("#emailvalid").css("color", "#00A41E");
                e.preventDefault();
            } else
            {
                $("#emailvalid").removeClass("glyphicon-ok");
                $("#emailvalid").addClass("glyphicon-remove");
                $("#emailvalid").css("color", "#FF0004");
                e.preventDefault();
            }

        });

        function validateEmail(sEmail) {
            var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
            if (filter.test(sEmail)) {
                return true;
            } else {
                return false;
            }
        }

        function myFunction() {
            $("#toto").css("display", "none");
        }


    </script>
</html>
