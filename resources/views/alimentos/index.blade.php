<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width-device-width, initial-scale=1.0"/>
        <title> {{$cvTitlePage ?? "Titulo da página"}}</title>
        <link href="{{ url('/bootstrap-4.4.1-dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="{{ url('/bootstrap-4.4.1-dist/js/jquery-3.4.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('/bootstrap-4.4.1-dist/js/bootstrap.min.js') }}"></script>      
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
                    <center> <h1> {{$cvHeaderPage}} </h1> </center>
                </div>            
            </div>
            @include('includes.MensagemSucessoOuFalha')             
            <div class="row" style="padding-bottom: 10px">
                <div class="col-2">                    
                    <a href="{{route($cvRoute.'.create')}}" class="btn btn-secondary btn-sm" title="Novo produto">
                        <span class="btn-sm"><i class="fa fa-plus"></i> Cadastrar alimento</span> 
                    </a>
                </div>
                <div class="col-10">                   
                    <button class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#formSearch">
                        Filtro <img src="{{url('icones/empty-filter-512.png')}}" style="height: 20px;width: 20px;">
                    </button>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="formSearch" class="collapse">
                <!--Linhas do filtro-->
                <div class="row" style="padding-top: 0px">
                        <!--Formulario do filtro-->
                    <form class="form-inline" action="{{route($cvRoute.'.search')}}" method="post">                            
                        <div class="col-12">
                            {!! csrf_field() !!}
                            <!--Linha 1-->
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-12">
                                    Nome: <input style="height: 30px; width: 160px; margin-right: 10px" name="nome" class="form-control" type="text" placeholder="Pequisar por nome"> 

                                    <select name="tipo_id" class="form-control" style="margin-bottom: 0px">  
                                        <option value="null" selected="">Tipo alimento</option>
                                        @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}"> {{$tipo->nome}}</option>
                                        @endforeach
                                    </select>

                                    Data da Fabricação inicial: <input style="height: 30px; margin-right: 10px" name="data_fabricacao_inicial" class="form-control" type="date" placeholder="Data da fabricação">

                                    Data da validade inicial: <input style="height: 30px; margin-right: 10px" name="data_validade_inicial" class="form-control" type="date" placeholder="Data da validade">
                                </div>    
                            </div>       
                             <!--Linha 2-->                                                   
                            <div class="row" style="margin-bottom: 10px"> 
                                <div class="col-12">
                                    Preço: <input style="width: 60px" name="preco_min" class="form-control" type="text" placeholder="Min">

                                    <input style="width: 60px" name="preco_max" class="form-control" type="text" placeholder="Max">

                                    Marca <input style="width: 160px" type="text" name="marca" class="form-control" placeholder="Marca">

                                    Data da Fabricação final: <input style="height: 30px; margin-right: 10px" name="data_fabricacao_final" class="form-control" type="date" placeholder="Data da fabricação">


                                    Data da validade final: <input style="height: 30px; margin-right: 10px" name="data_validade_final" class="form-control" type="date" placeholder="Data da validade">      
                                </div>
                            </div>
                             <!--Linha 3-->
                            <div class="row">     
                                <div class="col-12">
                                    <div class="float-right">            
                                        <button class="btn btn-secondary  btn-sm" type="submit" style="height: 30px; position: relative;">
                                            pesquisar
                                        </button>                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--Formulario para excluir vários-->
            <form action="{{route($cvRoute.'.destroyMany')}}" method="get">
                <!--Linha do grid principal-->
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <th style="width: 10px"></th>
                                <th> Nome </th>
                                <th> Preço </th>
                                <th> Marca </th>                        
                                <th style="width: 130px;"> Tipo </th>
                                <th style="width: 170px;"> Data de fabricação </th>
                                <th style="width: 170px;"> Data de validade </th>
                                <th style="width: 15px"> Ver </th>                        
                                <th style="width: 20px"> Editar </th>                        
                                <th style="width: 20px"> Excluir </th>                        
                            </thead>
                            <tbody>                               
                                    @foreach($cvObjects as $alimento)
                                    <tr>
                                        <td> <input type="checkbox" name="id[]" value="{{$alimento->id}}"></td>
                                        <td> {{$alimento->nome}} </td>
                                        <td> {{number_format($alimento->preco, 2, ',', ' '). " $"}} </td>
                                        <td> {{$alimento->marca}} </td>
                                        <td> {{$alimento->tipo->nome}} </td>
                                        <td> {{date("d/m/Y", (strtotime($alimento->data_fabricacao)))}} </td>
                                        <td> {{date("d/m/Y", (strtotime($alimento->data_validade)))}} </td>     
                                        <td><center><a href="{{route($cvRoute.'.show', $alimento->id)}}"><img src="{{url('icones/eye.svg')}}" title="Ver detalhes" class="iconeAcao"></a></center></td>
                                        <td><center><a href="{{route($cvRoute.'.edit', $alimento->id)}}"><img src="{{url('icones/edit-pencil.svg')}}" title="Editar"  class="iconeAcao"></a></center></td>
                                        <td><center><a href="{{route($cvRoute.'.destroyOne', $alimento->id)}}"><img src="{{url('icones/recycle-bin.svg')}}" title="Excluir" class="iconeAcao"></a></center></td>
                                    </tr>
                                    @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div> 
                @if(isset($voltar))
                <div class="row">
                    <div class="col-1" style="margin-right: 0px">
                        <button class="btn btn-danger btn-sm">
                            Excluir
                        </button>
                    </div>
                    <div class="col-1">
                        <a href="{{route($cvRoute.'.index')}}" class="btn btn-secondary btn-sm"> Voltar </a>
                    </div>
                    <div class="col-sm-10">
                        @if(isset($searchCriteria))                    
                        {{$cvObjects->appends(['searchCriteria' => $searchCriteria])->links()}}                        
                        @else
                        {{$cvObjects->links()}}
                        @endif
                    </div>
                </div>
                @else
                    <div class="row">
                    <div class="col-1">
                        <button class="btn btn-danger btn-sm">
                            Excluir
                        </button>
                    </div>
                    <div class="col-sm-11">
                        @if(isset($searchCriteria))                    
                        {{$cvObjects->appends(['searchCriteria' => $searchCriteria])->links()}}                        
                        @else
                        {{$cvObjects->links()}}
                        @endif
                    </div>
                </div>
                @endif
            </form>    
        </div>    
    </body>
</html>

