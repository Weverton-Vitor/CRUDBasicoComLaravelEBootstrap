<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">		
		<meta name="viewport" content="width-device-width, initial-scale=1.0"/>
        <title> {{$cvTitlePage ?? "Titulo da página"}}</title>
        <link href="{{ url('/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="{{ url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>  
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
                    <center> <h1> {{$cvHeaderPage}} </h1> </center>
                </div>            
            </div>
            @include('includes.MensagemSucessoOuFalha')
            @include('includes.ErrosFormRequest')             
        </div>
        <div class="container" style="background-color: rgba(128, 128, 128, 0.4); padding: 20px; border-radius: 10px;">
			<div class="row">
				<div class="col-12">
					@if(isset($alimento))
					<form class="form" action="{{route($cvRoute.'.update', $alimento->id)}}" method="post" enctype="multipart/form-data">						
            		{!! method_field('PUT')!!}
					@else
					<form class="form" action="{{route($cvRoute.'.store')}}" method="post" enctype="multipart/form-data">
					@endif
						{!! csrf_field() !!}
						<label for="nome"><b>Nome do alimento:</b></label>
						<input type="text" name="nome" class="form-control" placeholder="Ex: Arroz" value="{{ $alimento->nome  ??old('nome')}}" required="" maxlength="60">

						<label for="preco"><b>Preço:</b></label>
						<input type="text" name="preco" class="form-control" placeholder="Ex: 2.50" value="{{ $alimento->preco  ?? old('preco')}}" required="">

						<label for="marca"><b>Marca:</b></label>
						<input type="text" name="marca" class="form-control" placeholder="Ex: Marca genérica" value="{{ $alimento->marca  ?? old('marca')}}" required="" maxlength="60">

						<label for="tipo_id"> <b>Tipo do alimento:</b></label>
						<select name="tipo_id" class="form-control" style="margin-bottom: 0px">
							@if(!isset($alimento))
							<option value="null">Selecione o tipo do alimento</option>
							@endif
							@foreach($tipos as $tipo)							
							@if(isset($alimento) && ($tipo->id == $alimento->tipo_id))								
							<option value="{{$tipo->id}}" selected=""> {{$tipo->nome}}</option>											
							@else
							<option value="{{$tipo->id}}"> {{$tipo->nome}}</option>
							@endif
							@endforeach
						</select><br>

						<label for="imagem"> <b>Imagem(Opcional):</b></label><br>
						<input type="file" name="imagem" file-accept="jpg, jpeg, png, gif"><br>


						<label for="data_fabricacao"><b>Data da fabricação:</b></label>
						<input type="date" name="data_fabricacao" class="form-control" value="{{ $alimento->data_fabricacao ?? old('data_fabricacao') }}" required="">

						<label for="data_validade"><b>Data da validade:</b></label>
						<input type="date" name="data_validade" class="form-control" value="{{ $alimento->data_validade ?? old('data_validade') }}" required="">

						<a href="{{route($cvRoute.'.index')}}" class="btn btn-secondary"> Voltar </a>
						@if(isset($alimento))
						<button class="btn btn-secondary">
							Editar
						</button>
						@else
						<button class="btn btn-secondary">
							Cadastrar
						</button>
						@endif
					</form>
				</div>
			</div>
		</div>
	</body>
</html>