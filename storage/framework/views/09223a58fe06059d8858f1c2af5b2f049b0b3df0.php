<?php if(isset($errors) && count($errors) > 0): ?> <!--errors é um varialvel passada pelo controller -->
<div class="row" style=" padding: 10px 25px 0px 20px">
  <div class="col-sm-12">
    <div class=" alert alert-danger">      
        <?php $__currentLoopData = ($errors->all()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($error); ?><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
    </div>                                 
  </div>
</div>    
<?php endif; ?><?php /**PATH /var/www/html/laravel/CRUDBasicoComLaravelEBootstrap/resources/views/includes/ErrosFormRequest.blade.php ENDPATH**/ ?>