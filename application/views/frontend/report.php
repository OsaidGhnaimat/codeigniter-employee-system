
<?php

// echo '<pre>';
// print_r($employee);
// echo '</pre>';

// echo '<pre>';
// print_r($operations);
// echo '</pre>';

?>
<!DOCTYPE html>
<html>
<body>
<style>
table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 40%;
}

th, td {
    padding: 13px;
}
</style>
<table class="col-8 m-auto my-5"> 
        <thead>  
            <th>Year</th>  
            <th>Month</th>  
            <th>Total Operations</th>
            <th>Net salary</th>
            
            <?php $x = $employee->salary ?>
            
        </thead>  
        <tbody>  
            <?php  
                foreach($operations as $row)
                {  
				$monthNum = $row->month;
                $dateObj = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F');
                    /*name has to be same as in the database. */
                   ?> <tr> 
                                <td><?php echo $row->year ?></td>
                                <td><?php echo $monthName ?></td>  
                                <td><?php echo $row->net_operation ?></td> 
                                <td><?php echo $employee->salary + $row->net_operation  ?></td> 

                                
                    </tr> 
               <?php }  
            ?>  
        </tbody> 
    </table> 
</body>
</html>