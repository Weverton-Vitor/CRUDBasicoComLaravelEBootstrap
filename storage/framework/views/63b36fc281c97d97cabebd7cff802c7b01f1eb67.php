<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">		
		<meta name="viewport" content="width-device-width, initial-scale=1.0"/>
        <title> <?php echo e($cvTitlePage ?? "Titulo da página"); ?></title>
        <link href="<?php echo e(url('/bootstrap-4.4.1-dist/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?php echo e(url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(url('/bootstrap-4.4.1-dist/js/bootstrap.min.js')); ?>"></script>  
        <style type="text/css">
        	.form-control{
        		margin-bottom: 10px;
        	}
        </style>  
	</head>
	<body>
		<div class="container">
            <div class="row">
                <div class="col-12">                
                    <center> <h1> <?php echo e($cvHeaderPage); ?> </h1> </center>
                </div>            
            </div>
            <?php echo $__env->make('includes.MensagemSucessoOuFalha', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>             
        </div>
        <div class="container" style="background-color: rgba(128, 128, 128, 0.4); padding: 20px; border-radius: 10px;">
			<div class="row">
				<div class="col-12">
					<?php if(isset($alimento)): ?>
					<form class="form" action="<?php echo e(route($cvRoute.'.update', $alimento->id)); ?>" method="post">						
            		<?php echo method_field('PUT'); ?>

					<?php else: ?>
					<form class="form" action="<?php echo e(route($cvRoute.'.store')); ?>" method="post">
					<?php endif; ?>
						<?php echo csrf_field(); ?>

						<label for="nome"><b>Nome do alimento:</b></label>
						<input type="text" name="nome" class="form-control" placeholder="Nome:" value="<?php echo e($alimento->nome  ??old('nome')); ?>">

						<label for="preco"><b>Preço:</b></label>
						<input type="number" name="preco" class="form-control" placeholder="Preço:" value="<?php echo e($alimento->preco  ?? old('preco')); ?>">

						<label for="marca"><b>Marca:</b></label>
						<input type="text" name="marca" class="form-control" placeholder="Marca:" value="<?php echo e($alimento->marca  ?? old('marca')); ?>">

						<label for="tipo_id"> <b>Tipo do alimento:</b></label>
						<select name="tipo_id" class="form-control" style="margin-bottom: 0px">
							<?php if(!isset($alimento)): ?>
							<option value="null">Selecione o tipo do alimento</option>
							<?php endif; ?>
							<?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>							
							<?php if(isset($alimento) && ($tipo->id == $alimento->tipo_id)): ?>								
							<option value="<?php echo e($tipo->id); ?>" selected=""> <?php echo e($tipo->nome); ?></option>											
							<?php else: ?>
							<option value="<?php echo e($tipo->id); ?>"> <?php echo e($tipo->nome); ?></option>
							<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select><br>

						<label for="data_fabricacao"><b>Data da fabricação:</b></label>
						<input type="date" name="data_fabricacao" class="form-control" value="<?php echo e($alimento->data_fabricacao ?? old('data_fabricacao')); ?>">

						<label for="data_validade"><b>Data da validade:</b></label>
						<input type="date" name="data_validade" class="form-control" value="<?php echo e($alimento->data_validade ?? old('data_validade')); ?>">

						<a href="<?php echo e(route($cvRoute.'.index')); ?>" class="btn btn-secondary"> Voltar </a>
						<?php if(isset($alimento)): ?>
						<button class="btn btn-secondary">
							Editar
						</button>
						<?php else: ?>
						<button class="btn btn-secondary">
							Cadastrar
						</button>
						<?php endif; ?>
					</form>
				</div>
			</div>
		</div>
	</body>
</html><?php /**PATH /var/www/html/laravel/CRUDBasicoComLaravelEBootstrap/resources/views/alimentos/create.blade.php ENDPATH**/ ?>