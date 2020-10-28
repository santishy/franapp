@extends('layouts.app')
@section('content')
    <purchase-component :products-in-purchase="{{json_encode($productsInPurchase)}}">
@endsection