
@inject('basket','App\Support\Basket\Basket')
<div class="card text-right">

    <div class="card-header">
        پرداخت
    </div>
    <div class="card-body">
       
        <p class="card-text"> {{number_format($basket->subTotal())}}مبلغ کل</p>
        <hr>
        <p class="card-text">{{number_format(10000)}}هزینه حمل </p>
        <hr>
        <p class="card-text">{{number_format($basket->subTotal() + 10000)}}مبلغ قابل پرداخت</p>
    </div>
<a href="{{route('basket.checkout.form')}}" class="btn btn-block btn-primary">ثبت و ادامه سفارش</a>
</div>