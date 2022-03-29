<div class="container">
	<div class="row">
		<div class="col-md-12 mt-4">
			<div class="card">
				<div class="card-header">
					<h5>Manage Salary</h5>
				</div>
				<div class="card-body">
					<h1>
						<?php if (!empty($results)) { ?>
							<button class="btn btn-success" onclick="hideForm()" id="addOperation">New Operation +</button>
							<a href="<?php echo base_url('employee/report/'. $results->id); ?>"><button class="btn btn-warning" id="report">Report</button></a>
						<?php	} else { ?>
							<h3 class="text-danger">Employee id is not exist</h3>

						<?php	} ?>
						
					</h1>

				</div>

				<div class="card-body">
					<div>
						<?php if (isset($results)) { ?>

							<div class="head-emp-info">
								<div>
									<h2> <?php echo 'ID: ' . $results->id ?> </h2>
								</div>
								<div>
									<h2> <?php echo 'Name: ' . $results->first_name . ' ' . $results->last_name; ?> </h2>
								</div>
								<div class="net-salary">
									<h2 id="salary" value="<?php echo $results->salary; ?>"><?php echo $results->salary; ?></h2>
									<span style="display: none;" id="base_salary"><?php echo $results->salary; ?></span>
								</div>
							</div>

							<?php
							// echo '<pre>';
							// print_r($name);
							// echo '</pre>';
							?>


						<?php	} ?>

						<form id="formAdd" class="p-2 col-12" style="display: none;" action="<?php echo base_url('employee/storeOperation'); ?>" method="POST">
							<div class="form-group div-input col-2">
								<label for="operation_name">Operation Name</label>
								<input onchange="netSalary()" type="text" name="operation_name" id="operation_name" class="form-control" placeholder="bonus..">
								<small style="color:red;" id="errName"><?php echo form_error('operation_name'); ?></small>
							</div>
							<div class="form-group div-input col-2">
								<label for="amount">amount</label>
								<input onchange="netSalary()" type="number" id="amount" name="amount" class="form-control" placeholder="20.00">
								<small style="color:red;" id="errAmount"></small>
							</div>
							<div class="form-group div-input col-2">
								<label for="">Operation Type</label>
								<select name="operation_type" id="operation_type" class="form-select" onchange="netSalary()">
									<option value="null" selected>null</option>
									<option value="fixed">Fixed</option>
									<option value="percentage">Percentage</option>
								</select>
								<small style="color:red;" id="errOperationType"></small>
							</div>
							<div class="form-group div-input col-2 ">
								<label for="">Operation</label>
								<select name="operation" class="form-select" onchange="netSalary()" id="operation">
									<option value="null" selected>null</option>
									<option value="income">income</option>
									<option value="deduction">deduction</option>
								</select>
								<small style="color:red;" id="errOperation"></small>
							</div>
							<input type="hidden" name="emp_id" value="<?php echo $results->id ?>">
							<input type="hidden" id="salarydb" name="salary" value="">
							<input type="hidden" id="net" name="net" value="" >
							<input type="hidden" id="base" name="base" value="" >


							<div class="form-group div-input ">
								<button onclick="fetchData()" style="display: none;" type="submit" id="save-btn" name="submit" class="btn btn-primary btn-save">Save</button>
							</div>

						</form>
					</div>

				</div>
				<div class="table-operation">
					<table class="table table table-borderd p-5">
						<thead>
							<tr>
								<th>Amount</th>
								<th>Operation Type</th>
								<th>Operation</th>
								<th>created_at</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<?php

							// echo '<pre>';
							// print_r($join_table);
							// echo '</pre>';
							foreach ($join_table as $key => $value) : ?>

								<tr>
									<td><?php echo $value->amount ?></td>
									<td><?php echo $value->operation_type ?></td>
									<td><?php echo $value->operation ?></td>
									<td><?php echo $value->created_at ?></td>

									<td>
										<a href="<?php echo base_url('employee/deleteOperation/' . $value->id) ?>" class="btn btn-danger btn-sm">Delete</a>
									</td>
								</tr>
							<?php endforeach; ?>

						</tbody>
					</table>

				</div>

			</div>

		</div>
	</div>
</div>
</div>

<script>
	hideForm = function() {
		let formAdd = document.getElementById('formAdd');
		let savebtn = document.getElementById('save-btn');
		if (formAdd.style.display == 'none') {
			formAdd.style.display = '';
			savebtn.style.display = '';
		} else {
			formAdd.style.display = 'none';
			savebtn.style.display = 'none';
		}
	}

	netSalary = function() {
		var salarydb = document.getElementById("salarydb");
		var net = document.getElementById("net");
		var base = document.getElementById("base");



		let amount = document.getElementById('amount');
		let operation_type = document.getElementById('operation_type').value;
		let operation = document.getElementById('operation').value;

		let salary = document.getElementById('salary');
		// let salarydb = document.getElementById('salarydb').value;
		let base_salary = document.getElementById('base_salary').innerText;

		let intSalary = parseInt(salary.innerHTML);
		let intAmount = parseInt(amount.value);
		let intbase_salary = parseInt(base_salary);
		base.value = intSalary;


		// console.log(salary.innerText);

		if (operation != 'null' && operation_type != 'null') {
			if (amount.value != '') {
				if (operation_type == 'fixed') {
					if (operation == 'income') {
						salary.innerText = intbase_salary + intAmount;
						salarydb.value = salary.innerText;

						// console.log(salarydb);

					} else if (operation == 'deduction') {
						salary.innerText = intbase_salary - intAmount;
						salarydb.value = salary.innerText;

					}
				} else if (operation_type == 'percentage') {
					if (operation == 'income') {
						salary.innerText = intbase_salary + (intbase_salary * (intAmount * 0.01));
						salarydb.value = salary.innerText;
					} else if (operation == 'deduction') {
						let x = intbase_salary - (intbase_salary * (intAmount * 0.01));
						x >= 0 ? salary.innerText = x : salary.innerText = 0;
						salarydb.value = salary.innerText;
					}
				}
			} else if (amount.value == '') {
				salary.innerText = base_salary;
				salarydb.value = salary.innerText;
			}
		} else {
			salary.innerText = base_salary;
			salarydb.value = salary.innerText;
		}

		net.value =  salarydb.value - intbase_salary;
		
	}



	fetchData = function() {
		let salary = document.getElementById('salary');
		let intSalary = parseInt(salary.innerHTML);

		// let data = {"netsalary" : intSalary};
		// fetch("http://localhost:8000/employee/storeOperation",{
		// 	method : 'POST',
		// 	body : JSON.stringify(data),
		// 	headers : {"Content-Type": "application/json"}
		// });


		// var postData = new FormData();
		// postData.append('netSalary', 123);
		// axios.post('http://localhost:8000/employee/storeOperation', postData).then(function(response){
		// 	console.log("success:", response);
		// }).catch(function(error){
		// 	console.log("error:", error);
		// });
		// console.log(netSalary);

		// let postData = new FormData();
		// postData.append('testdata', 123);

		// fetch('http://localhost:8000/employee/storeOperation', {
		// 	method: 'POST',
		// 	mode: 'no-cors',
		// 	headers: {
		// 		"Content-Type": "application/json"
		// 	},
		// 	body: postData
		// }).then((res) => {
		// 	console.log(res);
		// }).catch(console.log);

		// 	$.ajax({
		// 	url: "http://localhost:8000/employee/storeOperation",
		// 	type: "POST",
		// 	cache: false,
		// 	success: function(data){
		// 		$('#salary').html(data); 
		// 	}
		// });

		// 	$(document).ready(function(){   

		// 	$("#save-btn").click(function()
		// 	{       
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "http://localhost:8000/employee/storeOperation", 
		// 		data: {netSalary: $("#salary").val()},
		// 		dataType: "text",  
		// 		cache:false,
		// 		success: 
		// 			function(data){
		// 				alert(data);  //as a debugging message.
		// 			}
		// 		});// you have missed this bracket
		// 		console.log(netSalary);

		// 	return false;
		// 	});
		// });



		// console.log(intSalary);

		// $.ajax({
		// 	method : "POST",
		// 	url  : "/employee/storeOperation",
		// 	// dataType : "JSON",
		// 	data : {salary:intSalary},
		// 	error: function() {
		// 		alert('Something is wrong');
		// 	},
		// 	success: function(data){
		// 		 alert("Record added successfully");  
		// 	}
		// });

	}
</script>