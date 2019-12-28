<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
	        <meta name="viewport" content="width-device-width, initial-scale=1.0"/>
	        <title> <?php echo e($cvTitlePage ?? "Titulo da página"); ?></title>
	        <link href="<?php echo e(url('/bootstrap-4.4.1-dist/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
	        <script type="text/javascript" src="<?php echo e(url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js')); ?>"></script>
	        <script type="text/javascript" src="<?php echo e(url('/bootstrap-4.4.1-dist/js/bootstrap.min.js')); ?>"></script>
	        <style type="text/css">
	        	p.textoProduto{
	        		font-size: 19px;
	        	}

	        	img#imgAlimento{
	        		width: 250px;
	        		margin-bottom: 10px;
	        	}
	        </style>
	</head>
	<body>
		<div class="row">
            <div class="col-12">                
            	<center> <h1> <?php echo e($cvHeaderPage); ?> </h1> </center>
            </div>            
        </div>
		<div class="container" style="background-color: #cccccc; padding: 20px; border-radius: 10px">
			<div class="row">
				<div class="col-3">
					<?php if(is_null($alimento->imagem)): ?>
					<img id="imgAlimento" src="<?php echo e(url('/imagens/imagemGenerica.png')); ?>">
					<?php else: ?>
					<!--img id="imgAlimento" src="<?php echo e(url('storage/imagensShow/$alimento->imagem')); ?>"-->
					<img id="imgAlimento" src="/storage/imagensShow/<?php echo e($alimento->imagem); ?>">
					<?php endif; ?>
				</div>
				<div class="col-9">
					<p class="textoProduto"><b> Nome: </b><?php echo e($alimento->nome); ?></p>
					<p class="textoProduto"><b> Preço: </b><?php echo e($alimento->preco); ?></p>
					<p class="textoProduto"><b> Marca: </b><?php echo e($alimento->marca); ?></p>
					<p class="textoProduto"><b> Tipo: </b><?php echo e($alimento->tipo->nome); ?></p>
					<p class="textoProduto"><b> Data de fabricação: </b><?php echo e(date("d/m/Y", (strtotime($alimento->data_fabricacao)))); ?></p>
					<p class="textoProduto"><b> Data de validade: </b><?php echo e(date("d/m/Y", (strtotime($alimento->data_validade)))); ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<a href="<?php echo e(route($cvRoute.'.index')); ?>" class="btn btn-secondary btn-sm"> Voltar </a>			
					<a href="<?php echo e(route($cvRoute.'.destroyOne', $alimento->id)); ?>" class="btn btn-danger btn-sm"> Deletar </a>			
				</div>
			</div>
		</div>
	</body>
</html><?php /**PATH /var/www/html/laravel/CRUDBasicoComLaravelEBootstrap/resources/views/alimentos/show.blade.php ENDPATH**/ ?>