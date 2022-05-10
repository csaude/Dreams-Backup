<?php include '../header.php';?>
<?php include_once('config.php');?>
<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"  prefix="og: http://ogp.me/ns#" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Evaluation</title>
	
	<link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	
	<div class="bg-light border-bottom shadow-sm sticky-top">
		<div class="container">
			<header class="blog-header py-1">

			</header>
		</div> <!--/.container-->
	</div>
	
	<?php
	$condition	=	'';
	if(isset($_REQUEST['data_avaliacao']) and $_REQUEST['data_avaliacao']!=""){
		$condition	.=	' AND data_avaliacao LIKE "%'.$_REQUEST['data_avaliacao'].'%" ';
	}
	if(isset($_REQUEST['nome_avaliacao']) and $_REQUEST['nome_avaliacao']!=""){
		$condition	.=	' AND nome_avaliacao LIKE "%'.$_REQUEST['nome_avaliacao'].'%" ';
	}

	if(isset($_REQUEST['instancia_id']) and $_REQUEST['instancia_id']!=""){
		$condition	.=	' AND instancia_id LIKE "%'.$_REQUEST['instancia_id'].'%" ';
	}
	if(isset($_REQUEST['tipo_avaliacao_id']) and $_REQUEST['tipo_avaliacao_id']!=""){
		$condition	.=	' AND tipo_avaliacao_id LIKE "%'.$_REQUEST['tipo_avaliacao_id'].'%" ';
	}
	if(isset($_REQUEST['data_fim_avaliacao']) and $_REQUEST['data_fim_avaliacao']!=""){
		$condition	.=	' AND data_fim_avaliacao LIKE "%'.$_REQUEST['data_fim_avaliacao'].'%" ';
	}

	if(isset($_REQUEST['estado']) and $_REQUEST['estado']!=""){
		$condition	.=	' AND estado LIKE "%'.$_REQUEST['estado'].'%" ';
	}

	$userData	=	$db->getAllRecords('sa_avaliacao1','*',$condition,'ORDER BY id');
	?>
   

		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-globe"></i> <strong>Browse Evaluation</strong> <a href="add-users.php" class="float-right btn btn-dark btn-sm"><i class="fa fa-fw fa-plus-circle"></i> Add Evaluation</a></div>
			<div class="card-body">
				<?php
				if(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rds"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record deleted successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rus"){
					echo	'<div class="alert alert-success"><i class="fa fa-thumbs-up"></i> Record updated successfully!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rnu"){
					echo	'<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> You did not change any thing!</div>';
				}elseif(isset($_REQUEST['msg']) and $_REQUEST['msg']=="rna"){
					echo	'<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> There is some thing wrong <strong>Please try again!</strong></div>';
				}
				?>
				<div class="col-sm-12">
					<h5 class="card-title"><i class="fa fa-fw fa-search"></i> Find Evaluation</h5>
					<form method="get">
						<div class="row" >

							<div class="col-sm-2">
								<div class="form-group">
									<label>Data da Avaliacao</label>
									<input type="date" name="data_avaliacao" id="data_avaliacao" class="form-control" value="<?php echo isset($_REQUEST['data_avaliacao'])?$_REQUEST['data_avaliacao']:''?>" placeholder="date of evaluation">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Nome da Avaliacao</label>
									<input type="text" name="nome_avaliacao" id="nome_avaliacao" class="form-control" value="<?php echo isset($_REQUEST['nome_avaliacao'])?$_REQUEST['nome_avaliacao']:''?>" placeholder="Enter name of evaluation">
								</div>
							</div>
							
								<div class="form-group">
									<label>tipo da instancia</label>
									<input type="text" name="instancia_id" id="instancia_id" class="form-control" value="<?php echo isset($_REQUEST['instancia_id'])?$_REQUEST['instancia_id']:''?>" placeholder=" name instancy">
								</div>
							
							<div class="col-sm-2">
								<div class="form-group">
									<label>Tipo de Avaliacao</label>
									<input type="text" name="tipo_avaliacao_id" id="tipo_avaliacao_id" class="form-control" value="<?php echo isset($_REQUEST['tipo_avaliacao_id'])?$_REQUEST['tipo_avaliacao_id']:''?>" placeholder="type of evaluation">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Data Fim</label>
									<input type="date" name="data_fim_avaliacao" id="data_fim_avaliacao" class="form-control" value="<?php echo isset($_REQUEST['data_fim_avaliacao'])?$_REQUEST['data_fim_avaliacao']:''?>" placeholder="Enter End date">
								</div>
							</div>

							<div class="col-sm-2">
								<div class="form-group">
									<label>Status</label>
									<input type="text" name="estado" id="estado" class="form-control" value="<?php echo isset($_REQUEST['estado'])?$_REQUEST['estado']:''?>" placeholder="Enter Status">
								</div>
							</div>								
							
							<div class="col-sm-2">
								<div class="form-group">
									<label>&nbsp;</label>
									<div><button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr>
		
		<div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="bg-primary text-white">
						<th>Sr#</th>
						<th>Date Start</th>
						<th>Name Evaluation</th>
						<th>Instancy</th>
						<th>Type Evaluation</th>
						<th>End Date</th>
						<th>Status</th>						
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$s	=	'';
					foreach($userData as $val){
						$s++;
					?>
					<tr>
						<td><?php echo $s;?></td>
						<td><?php echo $val['data_avaliacao'];?></td>
						<td><?php echo $val['nome_avaliacao'];?></td>
						<td><?php echo $val['instancia_id'];?></td>
						<td><?php echo $val['tipo_avaliacao_id'];?></td>
						<td><?php echo $val['data_fim_avaliacao'];?></td>
						<td><?php echo $val['estado'];?></td>							
						<td align="center">
							<a href="edit-users.php?editId=<?php echo $val['id'];?>" class="text-primary"><i class="fa fa-fw fa-edit"></i> Edit</a> | 
							<a href="delete.php?delId=<?php echo $val['id'];?>" class="text-danger" onClick="return confirm('Are you sure to delete this user?');"><i class="fa fa-fw fa-trash"></i> Delete</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div> <!--/.col-sm-12-->
		
	
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
</body>
</html>