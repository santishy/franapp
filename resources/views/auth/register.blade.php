@extends('layouts.app')
@section('content')
<register 
    :inventories="{{json_encode($inventories)}}" 
    :roles="{{json_encode($roles)}}"
>
</register>
@endsection