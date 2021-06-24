@extends('layouts.app')
@section('content')

    <register 
    :editable-user="{{json_encode($user)}}"
    :roles="{{json_encode($roles)}}"
    :has-roles="{{json_encode($user->roles)}}"
    uri="/users/{{$user->id}}"
    method="PUT"
>
</register>

@endsection