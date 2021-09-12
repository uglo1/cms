@extends('layouts.app')

@section('content')



<div class="container">
  <div class="row">

      <!-- 戻るボタン -->
      <div class="m-5"><a href="/list" class="btn btn-danger">戻る</a></div>


      <table class="table table-striped table-bordered">
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Name</th>
          <th class="text-center">Address</th>
          <th class="text-center">Website</th>
          <th class="text-center">Email</th>
          <th></th>
        </tr>
        <tr>
          <form method="post" action="{{ url('update') }}/{{$company->id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <td>{{ $company->id }}</td>
            <!-- 名前 -->
            <td>
              <div class="form-group">
                <input type="text" name="name" id="name" 
                  class="form-control" placeholder="Enter Your Name" value="{{ $company->name }}" />
                {!! $errors->first('name', '<small class="text-danger">:message </small>') !!}
              </div>
            </td>
            <!-- 住所 -->
            <td>
              <div class="form-group">
                <input type="text" name="address" id="address" 
                  class="form-control" placeholder="Enter Your Address" value="{{ $company->address }}" />
                {!! $errors->first('address', '<small class="text-danger">:message </small>') !!}
              </div>
            </td>
            <!-- website -->
            <td>
              <div class="form-group">
                <input type="text" name="website" id="website" 
                  class="form-control" placeholder="Enter Your Website" value="{{ $company->website }}" />
                {!! $errors->first('website', '<small class="text-danger">:message </small>') !!}
              </div>
            </td>
            <!-- email -->
            <td>
              <div class="form-group">
                <input type="text" name="email" id="email" 
                  class="form-control" placeholder="Enter Your Email" value="{{ $company->email }}" />
                {!! $errors->first('email', '<small class="text-danger">:message </small>') !!}
              </div>
            </td>
            <!-- 登録 -->
            <td>
              <button type="submit" class="btn btn-success">更新</button>
            </td>
          </form>
        </tr>
      </table>
  </div>
</div>


@endsection