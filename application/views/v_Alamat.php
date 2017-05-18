<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/sweetalert/sweetalert.css'); ?>">

<script type="text/javascript" src="<?php echo base_url('assets/jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/sweetalert/sweetalert.min.js'); ?>"></script>

<style type="text/css">
	td{
		cursor: pointer;
	}

		.editor{
	display: none;
	}

</style>

</head>
<body>
<div class="container">
	<div class="row">
		<div class="cols-md-6">
		<h2>APP CI Json by Enter</h2>

		<button class='btn btn-info' id='add-data'><i class='glyphicon glyphicon-plus-sign'></i> Tambah </button><br><br>
		<table id="table-data" class="table table-striped">

		<thead>
			<tr>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Email</th>
				<th>NO Handphone</th>
				<th>Aksi</th>
			</tr>
			</thead>
			<tbody id="table-body">
			<?php

			foreach ($data_diri as $v) {
				echo "<tr data-id='$v[id]'>
								<td>
										<span class='span-nama caption' data-id='$v[id]'>$v[nama]</span>
										<input type='text' class='field-nama form-control editor' value='$v[nama]' data-id='$v[id]' />
								</td>		
								<td>
										<span class='span-alamat caption' data-id='$v[id]'>$v[alamat]</span>
										<input type='text' class='field-alamat form-control editor' value='$v[alamat]' data-id='$v[id]' />
								</td>
								<td>
										<span class='span-email caption' data-id='$v[id]'>$v[email]</span>
										<input type='text' class='field-email form-control editor' value='$v[email]' data-id='$v[id]' />
								</td>
								<td>
										<span class='span-nope caption' data-id='$v[id]'>$v[nope]</span>
										<input type='text' class='field-nope form-control editor' value='$v[nope]' data-id='$v[id]' />
								</td>
								<td><button class='btn btn-xs btn-danger hapus-alamat' data-id='$v[id]'><i class='glyphicon glyphicon-remove'></i> Hapus</button></td>

							</tr>";
			}
			 
			?>
			</tbody>
		
		</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){

	$.ajaxSetup({
		type:"post",
		cache:false,
		dataType:"json"

	})

	$(document).on("click","td",function(){
	$(this).find("span[class~='caption']").hide();
	$(this).find("input[class~='editor']").fadeIn().focus(); //diklik form tidak respon 
	});

	$('#add-data').click(function(){
		$.ajax({
		url:"<?php echo base_url('index.php/Alamat/create'); ?>",
		success: function(add){
		var form="";
		form+="<tr data-id='"+add.id+"'>";
		form+="<td><span class='span-nama caption' data-id='"+add.id+"'></span> <input type='text' class='field-nama form-control editor' data-id='"+add.id+"' /></td>";
		form+="<td><span class='span-alamat caption' data-id='"+add.id+"'></span> <input type='text' class='field-alamat form-control editor' data-id='"+add.id+"' /></td>";
		form+="<td><span class='span-email caption' data-id='"+add.id+"'></span> <input type='text' class='field-email form-control editor' data-id='"+add.id+"' /></td>";
		form+="<td><span class='span-nope caption' data-id='"+add.id+"'></span> <input type='text' class='field-nope form-control editor' data-id='"+add.id+"'></td>";

		form+="<td><button class='btn btn-xs btn-danger hapus-alamat' data-id='"+add.id+"'><i class='glyphicon glyphicon-remove'></i> Hapus</button></td>";
		form+="</tr>";

		var element=$(form); //salah variabel hrs refresh bwt muncul tambah form 
		element.hide();
		element.prependTo("#table-body").fadeIn(1500);
		}
		});
	});

	$(document).on("keydown",".editor",function(e){
		if(e.keyCode==13){
		var target=$(e.target);
		var value=target.val();
		var id=target.attr("data-id");
		var data={id:id,value:value};
		if(target.is(".field-nama")){
		data.modul="nama";
		}else if(target.is(".field-alamat")){
			data.modul="alamat";
		}else if(target.is(".field-email")){
			data.modul="email";
		}else if(target.is(".field-nope")){
			data.modul="nope";
		}

		$.ajax({
			data:data,
			url:"<?php echo base_url('index.php/Alamat/update'); ?>",
			success: function(add){
				target.hide();
				target.siblings("span[class~='caption']").html(value).fadeIn();
			}

		})

		}

		});
	
	$(document).on("click",".hapus-alamat",function(){
		var id=$(this).attr("data-id");
		swal({
			title:"Hapus Alamat",
			text:"Anda yakin akan menghapus data ini?",
			type:"warning",
			showCancelButton: true,
			confirmButtonText: "Hapus",
			closeOnConfirm: true,
		},
			function(){
				$.ajax({
					url:"<?php echo base_url('index.php/alamat/delete'); ?>",
					data:{id:id},
					success: function(){
						$("tr[data-id='"+id+"']").fadeOut("fast",function(){
							$(this).remove();
						});
					}
				});
			});


	});

	});

</script>

</body>
</html>