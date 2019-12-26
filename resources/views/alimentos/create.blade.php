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
        </div>
        <div class="container" style="background-color: rgba(128, 128, 128, 0.4); padding: 20px; border-radius: 10px;">
			<div class="row">
				<div class="col-12">
					<form class="form" action="{{route($cvRoute.'.store')}}" method="post">
						{!! csrf_field() !!}
						<label for="nome"><b>Nome do alimento:</b></label>
						<input type="text" name="nome" class="form-control" placeholder="Nome:">

						<label for="preco"><b>Preço:</b></label>
						<input type="number" name="preco" class="form-control" placeholder="Preço:">

						<label for="marca"><b>Marca:</b></label>
						<input type="text" name="marca" class="form-control" placeholder="Marca:">

						<label for="tipo_id"> <b>Tipo do alimento:</b></label>
						<select name="tipo_id" class="form-control" style="margin-bottom: 0px">
							<option value="null">Selecione o tipo do alimento</option>
							@foreach($tipos as $tipo)
							<option value="{{$tipo->id}}"> {{$tipo->nome}}</option>
							@endforeach
						</select><br>

						<label for="data_fabricacao"><b>Data da fabricação:</b></label>
						<input type="date" name="data_fabricacao" class="form-control">

						<label for="data_validade"><b>Data da validade:</b></label>
						<input type="date" name="data_validade" class="form-control">

						<a href="{{route($cvRoute.'.index')}}" class="btn btn-secondary"> Voltar </a>

						<button class="btn btn-secondary">
							Cadastrar
						</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>