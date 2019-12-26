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
					<form class="form" action="<?php echo e(route($cvRoute.'.store')); ?>" method="post">
						<?php echo csrf_field(); ?>

						<label for="nome"><b>Nome do alimento:</b></label>
						<input type="text" name="nome" class="form-control" placeholder="Nome:">

						<label for="preco"><b>Preço:</b></label>
						<input type="number" name="preco" class="form-control" placeholder="Preço:">

						<label for="marca"><b>Marca:</b></label>
						<input type="text" name="marca" class="form-control" placeholder="Marca:">

						<label for="tipo_id"> <b>Tipo do alimento:</b></label>
						<select name="tipo_id" class="form-control" style="margin-bottom: 0px">
							<option value="null">Selecione o tipo do alimento</option>
							<?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($tipo->id); ?>"> <?php echo e($tipo->nome); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select><br>

						<label for="data_fabricacao"><b>Data da fabricação:</b></label>
						<input type="date" name="data_fabricacao" class="form-control">

						<label for="data_validade"><b>Data da validade:</b></label>
						<input type="date" name="data_validade" class="form-control">

						<a href="<?php echo e(route($cvRoute.'.index')); ?>" class="btn btn-secondary"> Voltar </a>

						<button class="btn btn-secondary">
							Cadastrar
						</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html><?php /**PATH /var/www/html/laravel/CRUDBasicoComLaravelEBootstrap/resources/views/alimentos/create.blade.php ENDPATH**/ ?>