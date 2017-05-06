@extends('layouts.app')

@section('title', trans('transaction.detail'))

@section('content')
<h3 class="page-header">{{ $transaction->invoice_no }} <small>{{ trans('transaction.detail') }}</small></h3>
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">{{ trans('transaction.detail') }}</h3></div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <tbody>
                        <tr><td>{{ trans('transaction.invoice_no') }}</td><td class="text-primary strong">{{ $transaction->invoice_no }}</td></tr>
                        <tr><td>{{ trans('app.date') }}</td><td>{{ $transaction->created_at->format('Y-m-d') }}</td></tr>
                        <tr><td>{{ trans('transaction.customer_name') }}</td><td>{{ $transaction->customer['name'] }}</td></tr>
                        <tr><td>{{ trans('transaction.customer_phone') }}</td><td>{{ $transaction->customer['phone'] }}</td></tr>
                        <tr><td>{{ trans('transaction.items_count') }}</td><td>{{ $transaction->items_count }}</td></tr>
                        <tr><td>{{ trans('transaction.total') }}</td><td class="text-right strong">{{ formatRp($transaction->total) }}</td></tr>
                        <tr><td>{{ trans('transaction.payment') }}</td><td class="text-right">{{ formatRp($transaction->payment) }}</td></tr>
                        <tr><td>{{ trans('transaction.exchange') }}</td><td class="text-right">{{ formatRp($transaction->getExchange()) }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading"><h3 class="panel-title">{{ trans('transaction.items') }}</h3></div>
        <div class="panel-body">
            <table class="table table-condensed">
            <thead>
                <tr>
                    <th>{{ trans('app.table_no') }}</th>
                    <th>{{ trans('product.name') }}</th>
                    <th class="text-right">{{ trans('product.item_price') }}</th>
                    <th class="text-right">{{ trans('product.item_discount') }}</th>
                    <th class="text-center">{{ trans('product.item_qty') }}</th>
                    <th class="text-right">{{ trans('product.item_subtotal') }}</th>
                </tr>
            </thead>
            <tbody>
            <?php $discountTotal = 0; ?>
            @foreach($transaction->items as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $item['name'] }} <br>
                        <small class="text-primary">({{ $item['unit'] }})</small>
                    </td>
                    <td class="text-right">{{ formatRp($item['price']) }}</td>
                    <td class="text-right">{{ formatRp($item['item_discount']) }}</td>
                    <td class="text-center">{{ $item['qty'] }}</td>
                    <td class="text-right">{{ formatRp($item['subtotal']) }}</td>
                </tr>
                <?php $discountTotal = $transaction['item_discount_subtotal'] ?>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-right">{{ trans('transaction.subtotal') }} :</th>
                    <th class="text-right">{{ formatRp($transaction['total'] + $discountTotal) }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-right">{{ trans('transaction.discount_total') }} :</th>
                    <th class="text-right">{{ formatRp($discountTotal) }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-right">{{ trans('transaction.total') }} :</th>
                    <th class="text-right">{{ formatRp($transaction['total']) }}</th>
                </tr>
            </tfoot>
        </table>
        </div>
    </div>
    </div>
</div>
@endsection