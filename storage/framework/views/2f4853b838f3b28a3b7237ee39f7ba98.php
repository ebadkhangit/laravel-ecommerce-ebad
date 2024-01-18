
<?php $__env->startSection('content'); ?>

					<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Sub Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="<?php echo e(route('sub-categories.index')); ?>" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
				<form action="" name="SubCategoryForm" id="SubCategoryForm">		
						<div class="card">
							<div class="card-body">								
								<div class="row">
                                    <div class="col-md-12">
										<div class="mb-3">
											<label for="name">Category</label>

											<select name="category" id="category" class="form-control">
												<option value="">Select  a Category</option>
												<?php if($categories->isNotEmpty()): ?>
												<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                               <?php endif; ?>
                                            </select>
                                            	<p></p>	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">
											<p></p>		
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="email">Slug</label>
											<input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
											<p></p>	
										</div>
									</div>	

										<div class="col-md-6">
										<div class="mb-3">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control" >
												<option value="1">Active</option>
												<option value="0">Block</option>
											</select>
											<p></p>	
										</div>
									</div>									
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" name="submit" class="btn btn-primary">Create</button>
							<a href="subcategory.html" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
						</form>
					</div>
				
					<!-- /.card -->
				</section>
				<!-- /.content -->		

     <?php $__env->stopSection(); ?>

     <?php $__env->startSection('customJs'); ?>
<script type="text/javascript">

$("#SubCategoryForm").submit(function(event) {
		event.preventDefault();
		var element = $(this);
      		//alert(element);
		 $.ajax({
		 	url:'<?php echo e(route("sub-categories.store")); ?>',
		 	type:'post',
		 	data:element.serializeArray(),
		 	dataType:'json',
		 	success: function(response){

		 		if(response["status"] == true){

		 			window.location.href = "<?php echo e(route('sub-categories.index')); ?>";
                

		 				$("#name").removeClass('is-invalid')
		 			.siblings('p').removeClass('invalid-feedback').html("");

		 					$("#slug").removeClass('is-invalid')
		 			.siblings('p').removeClass('invalid-feedback').html("");

		 					$("#category").removeClass('is-invalid')
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

		 			if(errors['category']){

		 			$("#category").addClass('is-invalid')
		 			.siblings('p').addClass('invalid-feedback').html(errors['category']);
		 		} else{

		 				$("#category").removeClass('is-invalid')
		 			.siblings('p').removeClass('invalid-feedback').html("");
		 		}


		 		}

		 		


		 	}, error: function(jqXHR, exception){
		 		console.log("some things went wrong");


		 	}


 })



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


</script>

       <?php $__env->stopSection(); ?>
     

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xaamp\htdocs\natural-shop\resources\views/admin/sub_category/create.blade.php ENDPATH**/ ?>