
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Employee Edit Page</h5>
                            <a href="<?php echo base_url('employee'); ?>" class="btn btn-danger float-right">back</a>

                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url('employee/update/'. $employee->id); ?>" method="POST">
                                <div class="form-group">
                                    <label for="">First name</label>
                                    <input type="text" name="first_name" class="form-control" value="<?php echo $employee->first_name ?>">
                                    <small style="color:red;"><?php echo form_error('first_name'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="">Last name</label>
                                    <input type="text" name="last_name" class="form-control" value="<?php echo $employee->last_name ?>">
                                    <small style="color:red;"><?php echo form_error('last_name'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="salary">Salary</label>
                                    <input type="number" name="salary" class="form-control" value="<?php echo $employee->salary ?>">
                                    <small style="color:red;"><?php echo form_error('salary'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="number" name="phone" class="form-control" value="<?php echo $employee->phone ?>">
                                    <small style="color:red;"><?php echo form_error('phone'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" class="form-control" value="<?php echo $employee->email ?>">
                                    <small style="color:red;"><?php echo form_error('email'); ?></small>
                                </div>
                                <div class="form-group">
                                    <label> image</label>
                                    <input type="file" name="image" class="file-upload-default">
                                    <small style="color:red;"><?php echo form_error('image'); ?></small>
                                </div>
                                    <br>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                                </div>
                                
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>


