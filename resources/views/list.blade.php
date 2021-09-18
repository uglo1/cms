@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">

    {{-- 新規作成ボタン --}}
    <div class="m-5"><a href="/register" class="btn btn-success">Create New Company</a></div>

    {{-- 検索用フォーム --}}
    <div class="search-wrapper m-5 col-sm-4">
      <div class="company-search-form">
        {{ Form::text('search_name', null, ['id' => 'search_name', 'class' => 'form-control shadow', 'placeholder' => '会社名を検索する']) }}
        {{ Form::button('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'btn search-icon', 'type' => 'button']) }}
      </div>
    </div>

    {{-- 検索用のテーブル(検索フォームを入力したら見える) --}}
    <table class="search-table table table-striped table-bordered d-none">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Name</th>
          <th class="text-center">Address</th>
          <th class="text-center">Website</th>
          <th class="text-center">Email</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

    {{-- 通常のテーブル --}}
    <table class="company-table table table-striped table-bordered">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th class="text-center">Name</th>
          <th class="text-center">Address</th>
          <th class="text-center">Website</th>
          <th class="text-center">Email</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
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
      </tbody>
    </table>
  </div>
</div>

{{-- jqueryのcdnを追加 --}}
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" defer></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js" defer></script>

{{-- 検索の処理 --}}
<script>
$(function(){
  $('#search_name').on('keyup', function() {
    $('.search-table tbody').empty(); // 検索テーブルの要素をなくす
    $('.company-table').addClass('d-none'); // 通常のテーブルを隠す
    $('.search-table').removeClass('d-none'); // 検索テーブルを表示する
    $('.search-null').remove(); // 検索結果が0の時のテキストを消す
  
    let companyName = $('#search_name').val(); //検索ワードを取得(フォームのsearch_name)

    if (!companyName) {
      $('.company-table').removeClass('d-none');
      $('.search-table').addClass('d-none');
      return false;
    } // ガード節で検索ワードが空の時は、ここで処理を止めて何もビューに出さない
  
    $.ajax({
      type: 'GET',
      url: '/search/' + companyName, // 後述するweb.phpのURLと同じ形にする
      data: {
        'search_name': companyName, // ここはサーバーに送りたい情報。今回は検索フォームのバリュー
      },
      dataType: 'json', // json形式で受け取る
      
    }).done(function (data) {
      let html = '';
      $.each(data, function (_index, value){
        let id = value.id;
        let name = value.name;
        let address = value.address;
        let website = value.website;
        let email = value.email;
  
        // 1ユーザ情報のビューテンプレートを作成
        html = `
        <tr>
          <td>${id}</td>
          <td>${name}</td>
          <td>${address}</td>
          <td>${website}</td>
          <td>${email}</td>
          <td>
            <div class="btn-group" role="group">
              <div class="mr-2"><a href="/modify/${id}" class="btn btn-outline-primary">Edit</a></div>
              <div>
                <form action="/delete/${id}" method="post">
                  <input type="hidden" name="_method" value="DELETE"> 
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash">Delete</span></button>
                </form>
              </div>
            </div>
          </td>
        </tr>
        `
        $('.search-table tbody').append(html); // 出来上がったテンプレートをビューに追加
      })
      // 検索結果がなかった時の処理
      if (data.length === 0) {
        $('.company-search-form').after('<p class="text-center search-null">ユーザーが見つかりません</p>');
      }
    }).fail(function () {
      // ajax通信がエラーの時
      console.log('エラーが発生');
    })
  }) 
})

</script>

@endsection