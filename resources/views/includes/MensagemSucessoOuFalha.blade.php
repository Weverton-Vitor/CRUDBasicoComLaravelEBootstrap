@if(session('success'))
<div class="row" style=" padding: 0px 5px">
    <div class="col-sm-12">
        <div class="alert alert-success box">                       
            {{session('success')}}
        </div>        
    </div> 
</div>

{{request()->session()->forget('success')}}
@elseif(session('error'))   
<div class="row" style=" padding: 0px 5px">
    <div class="col-sm-12">
        <div class="alert alert-danger box">                  
            {{session('error')}}                          
        </div>                      
    </div> 
</div>
{{request()->session()->forget('error')}}
@endif