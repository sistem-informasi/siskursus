@extends('layouts.admin')

@section('sidebarchild')
@endsection

@section('content')

    @component('admin/contacts/navbar')
    @endcomponent

    {{ Form::open(['url' => 'admin/contact', 'method' => 'POST']) }}
    
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name') }}
        </div>

        <div class="form-group">
            {{ Form::label('address', 'Address') }}
            {{ Form::text('address') }}
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email') }}
        </div>
    
    
        {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
    
    {{ Form::close() }}

@endsection