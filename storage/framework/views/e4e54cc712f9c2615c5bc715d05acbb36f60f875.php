<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width-device-width, initial-scale=1.0"/>
        <title> <?php echo e($cvTitlePage ?? "Titulo da página"); ?></title>
        <link href="<?php echo e(url('/bootstrap-4.4.1-dist/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="<?php echo e(url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(url('/bootstrap-4.4.1-dist/js/bootstrap.min.js')); ?>"></script>      
        <style>
            img.iconeAcao{
                height: 20px;
                width: 20px;
            }

            img.iconeAcao:hover{
                height: 25px;
                width: 25px;

            }
            div#formSearch{
                padding: 20px;
                border: gray 1px solid;
                border-radius: 10px;
                background-color: rgba(128, 128, 128, .1);
                margin-bottom: 10px;
                height: 70px

            }
            
            a.page-link{
                color: white;
                background-color: #6c757d;
            }

            span.page-link{
                background-color: white;
            }
            li.page-item.active{
                background-color: white;
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
            <div class="row" style="padding-bottom: 10px">
                <div class="col-2">                    
                    <a href="<?php echo e(route($cvRoute.'.create')); ?>" class="btn btn-secondary btn-sm" title="Novo produto">
                        <span class="btn-sm"><i class="fa fa-plus"></i> Cadastrar produto</span> 
                    </a>
                </div>
                <div class="col-10">                   
                    <button class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#formSearch">
                        Filtro <img src="<?php echo e(url('icones/empty-filter-512.png')); ?>" style="height: 20px;width: 20px;">
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="formSearch" class="collapse">
                <div class="row" style="padding-top: 0px">
                    <div class="col-12">
                        <form class="form-inline" action="<?php echo e(route($cvRoute.'.search')); ?>" method="post">                            
                            <?php echo csrf_field(); ?>

                            <input style="height: 30px; width: 200px; margin-right: 10px" name="nome" class="form-control" type="text" placeholder="Pequisar por nome" required>                                                                
                            Data da Fabricação: <input style="height: 30px; margin-right: 10px" name="data_fabricacao" class="form-control" type="date" placeholder="Data da fabricação" required>                                    
                            Data da validade: <input style="height: 30px; margin-right: 10px" name="data_validade" class="form-control" type="date" placeholder="Data da validade" required>                            
                            <button class="btn btn-secondary  btn-sm" type="submit" style="height: 30px; position: relative;">
                                pesquisar
                            </button>                                                                
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped">
                        <thead>
                            <th> Nome </th>
                            <th> Preço </th>
                            <th> Marca </th>                        
                            <th> Tipo </th>
                            <th style="width: 145px;"> Data de fabricação </th>
                            <th style="width: 130px;"> Data de validade </th>
                            <th style="width: 15px"> Ver </th>                        
                            <th style="width: 20px"> Editar </th>                        
                            <th style="width: 20px"> Excluir </th>                        
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cvObjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $object): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($object->nome); ?> </td>
                                <td> <?php echo e($object->preco); ?> </td>
                                <td> <?php echo e($object->marca); ?> </td>
                                <td> <?php echo e($object->tipo->nome); ?> </td>
                                <td> <?php echo e(date("d/m/Y", (strtotime($object->data_fabricacao)))); ?> </td>
                                <td> <?php echo e(date("d/m/Y", (strtotime($object->data_validade)))); ?> </td>     
                                <td><center><a href="<?php echo e(route($cvRoute.'.show', $object->id)); ?>"><img src="<?php echo e(url('icones/eye.svg')); ?>" title="Ver detalhes" class="iconeAcao"></a></center></td>
                                <td><center><a href="<?php echo e(route($cvRoute.'.edit', $object->id)); ?>"><img src="<?php echo e(url('icones/edit-pencil.svg')); ?>" title="Editar"  class="iconeAcao"></a></center></td>
                                <td><center><a href="<?php echo e(route($cvRoute.'.destroy', $object->id)); ?>"><img src="<?php echo e(url('icones/recycle-bin.svg')); ?>" title="Excluir" class="iconeAcao"></a></center></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                        
                        </tbody>
                    </table>
                </div>
            </div>            
            <div class="row">
                <div class="col-sm-12">
                    <?php if(isset($searchCriteria)): ?>                    
                    <?php echo e($cvObjects->appends(['searchCriteria' => $searchCriteria])->links()); ?>                        
                    <?php else: ?>
                    <?php echo e($cvObjects->links()); ?>

                    <?php endif; ?>
                </div>
            </div>
        </div>        
    </body>
</html>

<?php /**PATH /var/www/html/laravel/CRUDBasicoComLaravelEBootstrap/resources/views/alimentos/index.blade.php ENDPATH**/ ?>