@extends('layouts.app')
@section('content')
    <purchase-component 
        :products-in-purchase="{{json_encode($productsInPurchase)}}"
        :total-purchase="{{$totalPurchase}}"
        :purchase="{{json_encode($purchase)}}"
    />
@endsection