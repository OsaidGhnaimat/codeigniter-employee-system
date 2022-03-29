
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>how to insert data into database</h5>
                        </div>
                        <div class="card-body">
                            <a href="<?php echo base_url('employee/add'); ?>" class="btn btn-primary float-right">Add Employee</a>
                            <a href="<?php echo base_url('employee/manageSalary'); ?>" class="btn btn-warning float-right"> Manage Salary </a>

                        </div>

                        <div class="card-body">
                            <table class="table table table-borderd">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>image</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Salary</th>
                                        <th>Phone No </th>
                                        <th>Email ID</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($employee as $row): ?>
                                            <tr>
                                                <td><?php echo $row->id ?></td>
                                                <td><img class="emp_img" src="<?php echo './asset/img/'.$row->img ?>" class="rounded-circle" alt="img"></td>
                                                <td><?php echo $row->first_name ?></td>
                                                <td><?php echo $row->last_name ?></td>
                                                <td><?php echo $row->salary ?></td>
                                                <td><?php echo $row->phone ?></td>
                                                <td><?php echo $row->email ?></td>
                                                <td>
                                                    <a href="<?php  echo base_url('employee/edit/'.$row->id) ?>" class="btn btn-success btn-sm">Edit</a>
                                                </td>
                                                <td>
                                                <a href="<?php  echo base_url('employee/delete/'.$row->id) ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>   
                                    <?php    endforeach; ?>
                                  
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>


