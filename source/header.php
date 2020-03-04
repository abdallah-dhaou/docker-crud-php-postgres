<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://devcache1:6379,tcp://devcache1:6379');

session_start();

require_once $_SERVER['DOCUMENT_ROOT']."/Classes/authCookieSessionValidate.php";

if(!$isLoggedIn) {
    header("Location: /index.php");
}

?>
<html>
    <head>

        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/select.dataTables.min.css">
        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/style.css" type="text/css" />

        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/animate.css" type="text/css" />
        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/jquery-confirm.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" type="text/css" />

        <link type="text/css" rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/test_css/dataTables.bootstrap4.min.css" />
        <link type="text/css" rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/test_css/buttons.bootstrap4.min.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.6/css/fileinput.min.css" type="text/css" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables-colvis/1.1.2/css/dataTables.colVis.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.10/sweetalert2.css" type="text/css" />
        <link rel="stylesheet" href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /css/intlTelInput.css" type="text/css" />



        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/moment.min.js"></script>   
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/dataTables.responsive.js"></script>

        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/dataTables.select.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/fr.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/bootstrap-notify.js"></script>

        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/jszip.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/pdfmake.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/vfs_fonts.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/buttons.print.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/test/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/test/buttons.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.3.1/js/buttons.colVis.min.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/autoNumeric-1.9.18.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables-colvis/1.1.2/js/dataTables.colVis.js"></script>
        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/jquery.autoresize.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js"></script>
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/1.0.3/purify.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.6/js/fileinput.js"></script>
<!--        <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/fileinput.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.6/js/locales/fr.js"></script>
<!--        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&callback=initialize"></script>-->

<!--        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAEGhR4L_FYy-2NMXe_k7Uhl8bX1sO5ybg&callback=initMap"
type="text/javascript"></script>-->
        <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyAEGhR4L_FYy-2NMXe_k7Uhl8bX1sO5ybg&sensor=false&amp;libraries=places"></script>



        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-locationpicker/0.1.12/locationpicker.jquery.min.js"></script>

        <script type="text/javascript" src="<?php $_SERVER['DOCUMENT_ROOT'] ?> /js/intlTelInput.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.10/sweetalert2.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.16/api/page.jumpToData().js"></script>
<!--        <script src="https://www.jqueryscript.net/tags.php?/map/maps.google.com/maps/api/js?sensor=false&libraries=places"></script>-->
        <!--AIzaSyAEGhR4L_FYy-2NMXe_k7Uhl8bX1sO5ybg-->

    </head>  
    <script type="text/javascript">
    $(document).ready(function () {
        var trigger = $('.hamburger'),
                overlay = $('.overlay'),
                isClosed = false;

        trigger.click(function () {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();

                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
                console.log('isClosed = ' + isClosed);
            } else {
                overlay.show();

                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
                console.log('isClosed = ' + isClosed);
            }
        }

        $('[data-toggle="offcanvas"]').click(function () {
            $('#wrapper').toggleClass('toggled');
        });

        $('.items').each(function () {
            if ($(this).is(':selected'))
                console.log("this item is selected");
        });

        $('.overlay').on('click', function () {
            $('#wrapper').toggleClass('toggled');
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            overlay.hide();
            isClosed = false;
        });
    });
    </script>   



    <div id="wrapper">
        <div class="overlay"></div>

        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        PROJECT-X
                    </a>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">User Management <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">Dropdown heading</li>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /crud/crud_read.php">User list</a></li>
                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /crud/crud_create.php">Create user</a></li>
<!--                        <li><a href="<?php $_SERVER['DOCUMENT_ROOT'] ?> /article/mass_operation.php">Mass operation</a></li>-->
                        <!--                        <li><a href="#">Separated link</a></li>
                                                <li><a href="#">One more separated link</a></li>-->
                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <!--            <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <h1>Fancy Toggle Sidebar Navigation</h1>
                                    <p>Bacon ipsum dolor sit amet tri-tip shoulder tenderloin shankle. Bresaola tail pancetta ball tip doner meatloaf corned beef. Kevin pastrami tri-tip prosciutto ham hock pork belly bacon pork loin salami pork chop shank corned beef tenderloin meatball cow. Pork bresaola meatloaf tongue, landjaeger tail andouille strip steak tenderloin sausage chicken tri-tip. Pastrami tri-tip kielbasa sausage porchetta pig sirloin boudin rump meatball andouille chuck tenderloin biltong shank </p>
                                    <p>Pig meatloaf bresaola, spare ribs venison short loin rump pork loin drumstick jowl meatball brisket. Landjaeger chicken fatback pork loin doner sirloin cow short ribs hamburger shoulder salami pastrami. Pork swine beef ribs t-bone flank filet mignon, ground round tongue. Tri-tip cow turducken shank beef shoulder bresaola tongue flank leberkas ball tip.</p>
                                    <p>Filet mignon brisket pancetta fatback short ribs short loin prosciutto jowl turducken biltong kevin pork chop pork beef ribs bresaola. Tongue beef ribs pastrami boudin. Chicken bresaola kielbasa strip steak biltong. Corned beef pork loin cow pig short ribs boudin bacon pork belly chicken andouille. Filet mignon flank turkey tongue. Turkey ball tip kielbasa pastrami flank tri-tip t-bone kevin landjaeger capicola tail fatback pork loin beef jerky.</p>
                                    <p>Chicken ham hock shankle, strip steak ground round meatball pork belly jowl pancetta sausage spare ribs. Pork loin cow salami pork belly. Tri-tip pork loin sausage jerky prosciutto t-bone bresaola frankfurter sirloin pork chop ribeye corned beef chuck. Short loin hamburger tenderloin, landjaeger venison porchetta strip steak turducken pancetta beef cow leberkas sausage beef ribs. Shoulder ham jerky kielbasa. Pig doner short loin pork chop. Short ribs frankfurter rump meatloaf.</p>
                                    <p>Filet mignon biltong chuck pork belly, corned beef ground round ribeye short loin rump swine. Hamburger drumstick turkey, shank rump biltong pork loin jowl sausage chicken. Rump pork belly fatback ball tip swine doner pig. Salami jerky cow, boudin pork chop sausage tongue andouille turkey.</p>                         
                                </div>
                            </div>
                        </div>-->
        </div>
        <!-- /#page-content-wrapper -->

        <!--    </div>
             /#wrapper 
         
        
        </html>-->
