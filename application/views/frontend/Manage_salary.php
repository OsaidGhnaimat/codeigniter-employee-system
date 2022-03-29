	<?php echo validation_errors(); ?>
<form action="<?php echo base_url('employee/search') ?>" method="post" class="form-search my-5">
	<input class="search-bar" type="number" name="search" placeholder="Search employee..">
	<small style="color:red;"><?php echo form_error('search'); ?></small>

	<button type="submit"> search </button>
</form>
<h2 class="text-center">All Operations</h2>
<div class=" col-12 d-flex flex-wrap justify-content-center">

	<?php
   
	if ($manageSalary) {
		
		foreach ($manageSalary as $item) : ?>
		<?php $date= $item->created_at;
		$dateFormat=date("d-m-Y h-m", strtotime($date)); ?>
			<div class="card col-2 m-3">
				<img src="<?php echo '../asset/img/'.$item->img ?>" class="card-img-top" alt="img">

				<div class="card-body card-operation">
					<h5 class="card-title"><?php echo $item->first_name.' '.$item->last_name ?></h5>
					<h5>Emp Id : <?php echo $item->emp_id ?></h5>
					<h5 ><?php echo $item->operation_name ?></h5>
					<h5 ><?php echo $dateFormat ?></h5>
				</div>
			</div>
	<?php endforeach;
	} else echo '<h1> No Item </h1>';
	?>


</div>