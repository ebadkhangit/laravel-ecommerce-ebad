
<?php $__env->startSection('content'); ?>
  <section class="content-header">                    
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Dashboard cvvv</h1>
                            </div>
                            <div class="col-sm-6">
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 col-6">                            
                                <div class="small-box card">
                                    <div class="inner">
                                        <h3>150</h3>
                                        <p>Total Orders</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                    <a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-6">                            
                                <div class="small-box card">
                                    <div class="inner">
                                        <h3>50</h3>
                                        <p>Total Customers</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    <a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-6">                            
                                <div class="small-box card">
                                    <div class="inner">
                                        <h3>$1000</h3>
                                        <p>Total Sale</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person-add"></i>
                                    </div>
                                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                                </div>
                            </div>
                        </div>
                    </div>                  
                    <!-- /.card -->
                </section>

     <?php $__env->stopSection(); ?>

     <?php $__env->startSection('customJs'); ?>
<script type="text/javascript">
	console.log("hello");
</script>

       <?php $__env->stopSection(); ?>
     

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xaamp\htdocs\natural-shop\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>