
<?php $__env->startSection('content'); ?>
 
 		<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo e(route('categories.index')); ?>" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<form action="" method="post" id="categoryForm" name="categoryForm"  enctype="multipart/form-data">
					<div class="card">
							<div class="card-body">								
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
		<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo e($category->name); ?>">
											<p></p>	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="slug">Slug</label>
		<input type="text" name="slug"   id="slug" class="form-control" placeholder="Slug" value="<?php echo e($category->slug); ?>">
											<p></p>	
										</div>
									</div>
                              
                              <div class="col-md-6">
										<div class="mb-3">
		<input type="hidden" name="image_id" id="image_id" value="">
											<label for="image">Image</label>
										<div id="image" class="dropzone dz-clickable">
											<div class="dz-message needclick">
												<br>Drop File here or Click to Upload.</br>
										</div>	
										</div>
										</div>	

										<?php if(!empty($category->image)): ?>

										<div>
			<img src="<?php echo e(asset('uploads/category/'.$category->image)); ?>"  height="200" width="200">	
										</div>


										<?php endif; ?>
		    			
									<div class="col-md-6">
										<div class="mb-3">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control" >
						<option <?php echo e(($category->status == 1) ? 'selected' : ''); ?>  value="1">Active</option>

						<option <?php echo e(($category->status == 0) ? 'selected' : ''); ?>  value="0">Block</option>
											</select>
										</div>
									</div>									
								</div>
							</div>							
						</div>
                      

						<div class="pb-5 pt-3">
							<button type="submit"  class="btn btn-primary">Update</button>
							<a href="<?php echo e(route('categories.index')); ?>" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
						 </form>
					</div>
					<!-- /.card -->
				</section>
				<!-- /.content -->

     <?php $__env->stopSection(); ?>
     <?php $__env->startSection('customJs'); ?>
<script type="text/javascript">
	$("#categoryForm").submit(function(event) {
		event.preventDefault();
		var element = $(this);
      		//alert(element);
		 $.ajax({
		 	url:'<?php echo e(route("categories.update", $category->id)); ?>',
		 	type:'put',
		 	data:element.serializeArray(),
		 	dataType:'json',
		 	success: function(response){

		 		$("button[type=submit]").prop('disabled',false);

		 		if(response["status"] == true){

		 			window.location.href = "<?php echo e(route('categories.index')); ?>";
                

		 				$("#name").removeClass('is-invalid')
		 			.siblings('p').removeClass('invalid-feedback').html("");

		 					$("#slug").removeClass('is-invalid')
		 			.siblings('p').removeClass('invalid-feedback').html("");


		 		} else{


		 			var errors = response['errors'];

		 		if(errors['name']){

		 			$("#name").addClass('is-invalid')
		 			.siblings('p').addClass('invalid-feedback').html(errors['name']);
		 		} else{

		 				$("#name").removeClass('is-invalid')
		 			.siblings('p').removeClass('invalid-feedback').html("");


		 		}

		 		if(errors['slug']){

		 			$("#slug").addClass('is-invalid')
		 			.siblings('p').addClass('invalid-feedback').html(errors['slug']);
		 		} else{

		 				$("#slug").removeClass('is-invalid')
		 			.siblings('p').removeClass('invalid-feedback').html("");
		 		}


		 		}

		 		


		 	}, error: function(jqXHR, exception){
		 		console.log("some things went wrong");


		 	}


 });



	});


     $("#name").change(function() {

     	element = $(this);
 $.ajax({
		 	url:'<?php echo e(route("getSlug")); ?>',
		 	type:'get',
		 	data:{title : element.val()},
		 	dataType:'json',
		 	success: function(response){

		 		if (response["status"] == true) {

		 			$("#slug").val(response["slug"]);
		 		}


		 	}

		 });
     });

	Dropzone.autoDiscover = false;
	const dropzone = $("#image").dropzone({
		init:function(){

			this.on('addedfile',function(file){
				if(this.files.length >1){

					this.removeFile(this.files[0]);
			}
		});

		},

	 url:"<?php echo e(route('temp-images.create')); ?>",
		maxFilesize: 1,
		paramName :'image',
		addRemoveLinks: true,
		acceptedFiles:"image/jpeg,image/png,image/gif",

		headers: {

			'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
		}, success: function(file,response){
			$("#image_id").val(response.image_id);
			//console.log(response)
		}

	});



</script>

       <?php $__env->stopSection(); ?>
     
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xaamp\htdocs\natural-shop\resources\views/admin/category/edit.blade.php ENDPATH**/ ?>