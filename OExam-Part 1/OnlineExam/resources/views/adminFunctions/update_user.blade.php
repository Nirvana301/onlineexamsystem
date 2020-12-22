<!DOCTYPE html>
<html>
    <head>

    <title>O-Exam | Edit User</title>
      
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />

    </head>

    <body>
            
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible" style="width: 1905px;">
        {{ session('error')}}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" style="width: 1905px;">
        {{ session('success')}}
        </div>
    @endif


    <form action = "/homepage_admin/edit_user/<?php echo $users[0]->id; ?>" method = "post">
            {{csrf_field()}}
            <div class="container3 register-form">
                <div class="form">
                        <h2 style="text-align:center; margin-top:70px;">Edit User</h2>
                    <br>
    
                    <div class="form-content">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-6 control-label">ID</label>
                                    <input name="id" type="text" class="form-control input-md" value = '<?php echo$users[0]->id; ?>' required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Username</label>
                                    <input name="user_name" type="text" class="form-control input-md" value = '<?php echo$users[0]->user_name; ?>' required="">
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Name - Surname</label>
                                    <input name="full_name" type="text" class="form-control input-md" value = '<?php echo$users[0]->full_name; ?>' required="">
                                </div>
                                
                            </div>


                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-6 control-label">Email</label> 
                                    <input name="email" type="email" class="form-control input-md" value = '<?php echo$users[0]->email; ?>' required="">                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Locality</label>
                                    <input name="locality" type="text" class="form-control input-md" value = '<?php echo$users[0]->locality; ?>' required="">
                                </div>

                                <div class="form-group">
                                    <label class="col-md-6 control-label">Department</label>
                                    <select style="width:100%; height:1.3cm;" class="form-control input-md" name="department" id="department"> 
                                        <option><?php echo$users[0]->department; ?></option>                              
                                        <option value="CS">CS</option>
                                        <option value="SE">SE</option>
                                        <option value="CE">CE</option>
                                        <option value="IE">IE</option>
                                        <option value="EE">EE</option>
                                        <option value="ME">ME</option>
                                        <option value="CT">CT</option>
                                        <option value="IR">IR</option>
                                        <option value="HS">HS</option>
                                        <option value="LA">LA</option>
                                        <option value="-">-</option>
                                    </select>    

                                    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
                                    <script type="text/javascript">
                                    var code = {};
                                    $("select[name='department'] > option").each(function () {
                                    if(code[this.text]) {
                                    $(this).remove();
                                    } else {
                                    code[this.text] = this.value;
                                    }
                                    });
                                    </script>
                                
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-6 control-label" style="margin-left:236px">Role</label>  
                                    <select style= "width:100%; height:1.3cm; margin-left:238px;" class="form-control input-md" name="role" id="role">
                                      <option><?php echo$users[0]->role; ?></option>
                                      <option value="Student">Student</option>
                                      <option value="Teacher">Teacher</option>
                                      <option value="Assistant">Assistant</option>  
                                    </select>

                                    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
                                    <script type="text/javascript">
                                    var code = {};
                                    $("select[name='role'] > option").each(function () {
                                    if(code[this.text]) {
                                    $(this).remove();
                                    } else {
                                    code[this.text] = this.value;
                                    }
                                    });
                                    </script>
                                    
                                  </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                              <button style="margin-left:393px; width:2.5cm;" id="save" name="save" class="btn btn-success">Update</button>
                            </div>
                          </div>
                          
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>