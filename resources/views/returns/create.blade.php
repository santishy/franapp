@extends('layouts.app')
@section('content')
    <sale-return-component :sale="{{ json_encode($sale) }}" />
@endsection
