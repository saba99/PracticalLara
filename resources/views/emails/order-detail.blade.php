<h3>جزییات سفارش </h3>
سفارش شما با شماره 

{{$order->id}}


ثبت شد 

لیست سفارش های شما به صورت زیر می باشد 

<ul>

    @foreach($order->products as $product)
   

  <li>{{$product->title}}</li>


    @endforeach
</ul>

