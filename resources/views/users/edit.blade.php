@extends('layouts.app')
@section('content')
<div class="flex flex-wrap items-baseline">
    <registration-form 
        class="mr-4" 
        :editable-user="{{json_encode($user)}}"
        method="PUT"
        uri="/users/{{$user->id}}"
    ></registration-form>
    <assign-role 
        :roles="{{json_encode($roles)}}"
        :has-roles="{{json_encode($user->roles)}}"
        class="self-start"
    ></assign-role>
</div>
@endsection