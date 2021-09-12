@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">

      <div class="m-5"><a href="/register" class="btn btn-success">Create New Company</a></div>

      <table class="table table-striped table-bordered">
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Name</th>
          <th class="text-center">Address</th>
          <th class="text-center">Website</th>
          <th class="text-center">Email</th>
          <th></th>
        </tr>
        @foreach($companies as $company)
        <tr>
          <td>{{ $company->id }}</td>
          <td>{{ $company->name }}</td>
          <td>{{ $company->address }}</td>
          <td>{{ $company->website }}</td>
          <td>{{ $company->email }}</td>
          <td>
            <div class="btn-group" role="group">
              <div class="mr-2"><a href="/modify/{{ $company->id }}" class="btn btn-outline-primary">Edit</a></div>
              <div>
                <form action="/delete/{{ $company->id }}" method="post">
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Delete</span></button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </table>
  </div>
</div>

@endsection