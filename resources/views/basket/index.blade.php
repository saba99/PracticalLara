@extends('layouts.app') 


@section('content') 

  <div class="container">
<div class="row " style="direction:rtl;">
  @if($items->isEmpty())

<p>
    @lang('payment.empty basket',['link'=>route('products.index')])
</p>
  @else
<div class="col-8 col-md-6">

   
<div class="card">
    <div class="card-header">
       <table  >
            <th  class="pl-3">نام محصول </th>
            <th  class="pl-3">قیمت محصول</th>
           
            <th class="pl-4">تعداد</th>
</table>
    </div>
    <div class="card-body text-right">
        <table class="table">
        @foreach($items as $item)
        <tr>
        <td >{{$item->title}}</td>
        <td >{{number_format($item->price)}}</td>
        <td >
            
            <form action="{{route('basket.update',$item->id)}}" method="post" >
           
                @csrf 
             <select name="quantity"  id="quantity" class="input-sm  mr-sm-2 ">
               
                @for($i=0; $i <= $item->stock; $i++)
                  

                <option  {{$item->quantity == $i ? 'selected' :''}}  value="{{$i}}">
                    {{$i}}
                </option>

                @endfor

             </select>

             <button type="submit" class="btn btn-primary btn-sm">
             
           به روز رسانی

             </button>


            </form>
        </td>
          
        </tr>
        
    
    @endforeach
</table>
    </div>
   
</div>


</div>
<div class="col-4 col-md-4">

@include('partials.summary')


</div>
@endif
</div>
@endsection