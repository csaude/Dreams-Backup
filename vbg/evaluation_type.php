<?php
//category.php

include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

if($_SESSION['type'] != 'master')
{
	header("location:index.php");
}

include('header.php');

?>

	<span id="alert_action"></span>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                        <div class="row">
                            <h3 class="panel-title">Evaluation Type List</h3>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <div class="row" align="right">
                             <button type="button" name="add" id="add_button" data-toggle="modal" data-target="#categoryModal" class="btn btn-success btn-xs">Add</button>   		
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                    		<table id="evaluation_type_data" class="table table-bordered table-striped">
                    			<thead><tr>
									<th>ID</th>
									<th>Evaluation Type Name</th>
									<th>Status</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr></thead>
                    		</table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="categoryModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="evaluation_type_form">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Evaluation Type</h4>
    				</div>
    				<div class="modal-body">
    					<label>Enter Evaluation Type Name</label>
						<input type="text" name="evaluation_type_name" id="evaluation_type_name" class="form-control" required />
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="evaluation_type_id" id="evaluation_type_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
	
		<script src="js/jquery-1.10.2.min.js"></script> 
		<script src="js/jquery.dataTables.min.js"></script> 
		<script src="js/dataTables.bootstrap.min.js"></script>	 	
		<script src="js/bootstrap.min.js"></script> 		
	
<script>
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#evaluation_type_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Area");
		$('#action').val('Add');
		$('#btn_action').val('Add');
	});

	$(document).on('submit','#evaluation_type_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"evaluation_type_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#evaluation_type_form')[0].reset();
				$('#categoryModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				categorydataTable.ajax.reload();
			}
		})
	});

	$(document).on('click', '.update', function(){
		var evaluation_type_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"evaluation_type_action.php",
			method:"POST",
			data:{evaluation_type_id:evaluation_type_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#categoryModal').modal('show');
				$('#evaluation_type_name').val(data.evaluation_type_name);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Category");
				$('#evaluation_type_id').val(evaluation_type_id);
				$('#action').val('Edit');
				$('#btn_action').val("Edit");
			}
		})
	});

	var categorydataTable = $('#evaluation_type_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"evaluation_type_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[3, 4],
				"orderable":false,
			},
		],
		"pageLength": 25
	});
	$(document).on('click', '.delete', function(){
		var evaluation_type_id = $(this).attr('id');
		var status = $(this).data("status");
		var btn_action = 'delete';
		if(confirm("Are you sure you want to change status?"))
		{
			$.ajax({
				url:"evaluation_type_action.php",
				method:"POST",
				data:{evaluation_type_id:evaluation_type_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					categorydataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});
});
</script>

<?php
include('footer.php');
?>


				