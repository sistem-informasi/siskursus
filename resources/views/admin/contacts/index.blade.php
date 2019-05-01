@extends('layouts.admin')

@section('sidebarchild')
@endsection

@section('content')

    @component('admin/contacts/navbar')
    @endcomponent

    @foreach ($contacts as $contact)
    <div class="row table table-striped table-bordered" style='border:solid 1px #ccc;'>
    <div class="col-md-2">{{ $contact->name }}</div>
    <div class="col-md-3">{{ $contact->address }}</div>
    <div class="col-md-2">{{ $contact->phone }}</div>
    <div class="col-md-3">{{ $contact->email }}</div>
    <div class="col-md-2">
        <a href='/admin/contact/{{ $contact->id}}/edit'>Edit</a>
        <a href='/admin/contact/{{ $contact->id}}'>Hapus</a>

        {{ Form::open(array('url' => '/admin/contact/' . $contact->id, 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Hapus Contact', ['class' => 'btn btn-warning']) }}
        {{ Form::close() }}

    </div>
    </div>
    @endforeach

@endsection