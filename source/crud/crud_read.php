<?php
require_once  $_SERVER['DOCUMENT_ROOT'] . '/header.php';

require_once ($_SERVER['DOCUMENT_ROOT'] . "/Classes/User.php");
$user = new User();
$userResult = $user->getAllUser();

unset($user);
?>
<div  id="container_article"> 
    <div class = "page-header">
        <h1 class="upper"> List of Users</h1>
    </div>

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#new_userModal">Add User</button>

    <br>

    <!-- Modal -->
    <div id="new_userModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New user informations</h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="form1" enctype="multipart/form-data">
                        <div class="form-group row" >
                            <label for="u_id" class="col-sm-2 col-form-label">ID</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control" name="u_id" id="u_id"  maxlength="20"   required>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="u_login" class="col-sm-2 col-form-label">Login</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control" name="u_login" id="u_login"  maxlength="15"  >
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="u_email" class="col-sm-2 col-form-label">email</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control" name="u_email" id="u_email">
                            </div>
                        </div>
                        
                        <div class="form-group row" >
                            <label for="u_first_name" class="col-sm-2 col-form-label">firstname</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control" name="u_first_name" id="u_first_name">
                            </div>
                        </div>
                        
                        <div class="form-group row" >
                            <label for="u_last_name" class="col-sm-2 col-form-label">lastname</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control" name="u_last_name" id="u_last_name">
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="u_pass" class="col-sm-2 col-form-label">Password</label>
                            <div class=" col-sm-10">
                                <input type="password" class="form-control" name="u_pass" id="u_pass">
                            </div>
                        </div>

                        

                        <div class="form-group row" >
                            <label for="u_status" class="col-sm-2 col-form-label">Status </label>
                            <div class=" col-sm-10">
                                <select class="form-control" id="u_status" name="u_status">
                                    <option value="true">Active</option>
                                    <option value="false">Inactive</option>
                                </select>
                            </div>
                        </div>

   

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitNewUser()">Save</button>
                </div>
            </div>

        </div>
    </div>
    
    <div class="modal fade" id="EditUserModal" role="dialog" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Modification </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form role="form">

                           <div class="form-group row" >
                            <label for="u_id_edit" class="col-sm-2 col-form-label">ID</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control"  id="u_id_edit"  maxlength="20"  readonly>
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="u_login_edit" class="col-sm-2 col-form-label">Login</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control"  id="u_login_edit"  maxlength="15"  >
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="u_email_edit" class="col-sm-2 col-form-label">email</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control"  id="u_email_edit">
                            </div>
                        </div>
                            
                        <div class="form-group row" >
                            <label for="u_first_name_edit" class="col-sm-2 col-form-label">firstname</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control"  id="u_first_name_edit">
                            </div>
                        </div>
                            
                        <div class="form-group row" >
                            <label for="u_last_name_edit" class="col-sm-2 col-form-label">lastname</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control"  id="u_last_name_edit">
                            </div>
                        </div>

                        <div class="form-group row" >
                            <label for="u_pass_edit" class="col-sm-2 col-form-label">Password</label>
                            <div class=" col-sm-10">
                                <input type="text" class="form-control"  id="u_pass_edit">
                            </div>
                        </div>                        

                        <div class="form-group row" >
                            <label for="u_status_edit" class="col-sm-2 col-form-label">Status </label>
                            <div class=" col-sm-10">
                                <select class="form-control" id="u_status_edit" >
                                    <option value="true">Active</option>
                                    <option value="false">Inactive</option>
                                </select>
                            </div>
                        </div>
                           
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary submitBtn" onclick="submitEditUserForm()">Actualiser</button>
                    </div>
                </div>
            </div>
        </div>
        <br>

    <br>

    <table id="user_table" class="table  table-bordered row-border hover order-column table-condensed" cellspacing="0" width="100%">
        <thead >
            <tr>
                <th>ID</th>
                <th>Login</th>
                <th>Email</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
<?php

if (count($userResult) > 0) 
{
    for ($i = 0; $i < count($userResult); $i++) {
        ?>
        <tr>
            <td><strong><a  href="javascript:edt_id('<?php echo $userResult[$i]['u_id'];?>')"><?php echo $userResult[$i]['u_id']; ?></a></strong></td>
            <td><?php echo $userResult[$i]['u_login']; ?></td>
            <td><?php echo $userResult[$i]['u_email']; ?></td>
            <td><?php echo $userResult[$i]['u_first_name']; ?></td>
            <td><?php echo $userResult[$i]['u_last_name']; ?></td>
            <td><a href="javascript:delete_id('<?php echo $userResult[$i]['u_id']; ?>')"><span class="glyphicon glyphicon-trash"></span></a></td>
        </tr>
        <?php
    }
} 
else 
{
?>
    <tr>
        <td colspan="5" align="center">No users Found !</td>
    </tr>
<?php
}
?>

        </tbody>
    </table>
    
    <div id="cand"></div>
</div> 

<script type="text/javascript" >
    
    $(document).ready(function () {

        var table = $('#user_table').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "order": [[ 0, "asc" ]],
            'columnDefs': [
                {
                    'targets': [0,1,2],
                    'className': 'dt-head-center dt-body-center',

                },
                {
                    'targets': 5,
                    'searcheable': false,
                    'orderable': false,
                    'className': 'dt-head-center dt-body-center noVis',
                }
            ],

            "buttons": [

                {
                    extend: 'colvis',
                    columns: ':not(.noVis)',

                }
            ],

        });
        table.buttons().container().appendTo('#user_table_wrapper .col-md-6:eq(0)');

//        $('table').each(function () {
//            $('[name="' + this.id + '_length"]').css({'height': 30 + "px"});
//        });

        $('.dt-buttons').css({'padding-left': 10 + "px"});
        $('.glyphicon-trash').css({'color': "red"});


        $(".buttons-colvis").hover(function () {
            $(this).css("color", "white");
        });

    });

    function submitNewUser() {

        var fd = new FormData();
        
        
        fd.append('action','create_user');
        fd.append('u_id', $('#u_id').val());
        fd.append('u_login', $('#u_login').val());
        fd.append('u_email', $('#u_email').val());
        fd.append('u_first_name', $('#u_first_name').val());
        fd.append('u_last_name', $('#u_last_name').val());
        fd.append('u_pass', $('#u_pass').val());
        fd.append('u_status', $('#u_status').val());



        $.ajax({
            type: 'POST',
            url: 'parsing.php',
            data: fd,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled", "disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success: function (msg) {
                console.log('return msg :||'+msg+'||');
                if (msg == 1) {
                    $('#new_userModal').modal('hide');
                    swal({
                        title: "Congratulation!",
                        text: "User Is Inserted Successfully!",
                        type: "success"
                    }).then(function () {
                        location.reload();
                    });
//                    $('#top-section1').css("z-index", "9998");
//                    location.reload();
                } 
                else
                {
                    $('.statusMsg').html('<span style="color:red;">Not able to execute this request, check again in few minutes ... If the problem persist, please contact your IT departement.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });

    };
    
    function edt_id(id)
    {        
        var fd = new FormData();        
        fd.append('action','get_user');
        fd.append('u_id', id);        
        $.ajax({
            type: 'POST',
            url: 'parsing.php',
            data: fd,
            dataType: 'json',
            contentType: false,
            processData: false,
            
            success: function (response) {

                $("#EditUserModal").modal();
                $('#u_id_edit').val(id);
                $('#u_login_edit').val(response.data[0]['u_login']);
                $('#u_email_edit').val(response.data[0]['u_email']);
                $('#u_first_name_edit').val(response.data[0]['u_first_name']);
                $('#u_last_name_edit').val(response.data[0]['u_last_name']);
                $('#u_status_edit option[value='+response.data[0]['u_status']+']').attr('selected','selected');
                
            }
        });
    }
    
    
    function delete_id(id)
    {
            
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
            if (result.value) {
                var fd = new FormData();        
                fd.append('action','delete_user');
                fd.append('u_id', id);
        
//        alert (id);
//        return false;
        
                $.ajax({
                    type: 'POST',
        //            method:"POST",
                    url: 'parsing.php',
                    data: fd,
                    contentType: false,
                    processData: false,

                    success: function (response) {
                            swal({
                                title: "Congratulation!",
                                text: "User removed Successfully!",
                                type: "success"
                            }).then(function () {
                                location.reload();
                            });

                    }
                });
            }
        })
            
    }
    
    function submitEditUserForm() {

        var fd = new FormData();

        fd.append('action','update_user');
        fd.append('u_id_edit',$('#u_id_edit').val());
        fd.append('u_login_edit', $('#u_login_edit').val());
        fd.append('u_email_edit', $('#u_email_edit').val());
        fd.append('u_first_name_edit', $('#u_first_name_edit').val());
        fd.append('u_last_name_edit', $('#u_last_name_edit').val());
        fd.append('u_status_edit', $('#u_status_edit').val());



        $.ajax({
            type: 'POST',
            url: 'parsing.php',
            data: fd,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled", "disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success: function (response) {

                if (response == 1) {
                    $('#EditUserModal').modal('hide');
                    swal({
                        title: "Congratulation!",
                        text: "User updated successfully!",
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

    };

</script>    


