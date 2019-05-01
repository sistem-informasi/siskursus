@extends('layouts.admin')

@section('sidebarchild')
@endsection

@section('content')

    @component('admin/contacts/navbar')
    @endcomponent
    
        {{ Form::hidden('id', $id) }}

        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', $name) }}
        </div>

        <div class="form-group">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address', $address) }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', $email) }}
        </div>

        <div class="form-group">
            {{ Form::label('phone', 'Phone') }}
            {{ Form::text('phone', $phone) }}
        </div>

@endsection