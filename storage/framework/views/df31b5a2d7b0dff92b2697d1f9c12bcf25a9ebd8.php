<?php if(session('success')): ?>
<div class="row" style=" padding: 0px 5px">
    <div class="col-sm-12">
        <div class="alert alert-success box">                       
            <?php echo e(session('success')); ?>

        </div>        
    </div> 
</div>

<?php echo e(request()->session()->forget('success')); ?>

<?php elseif(session('error')): ?>   
<div class="row" style=" padding: 0px 5px">
    <div class="col-sm-12">
        <div class="alert alert-danger box">                  
            <?php echo e(session('error')); ?>                          
        </div>                      
    </div> 
</div>
<?php echo e(request()->session()->forget('error')); ?>

<?php endif; ?><?php /**PATH /var/www/html/laravel/CRUDBasicoComLaravelEBootstrap/resources/views/includes/MensagemSucessoOuFalha.blade.php ENDPATH**/ ?>