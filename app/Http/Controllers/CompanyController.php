<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{   
    // 一覧
    public function list(){
        $companies = Company::all();
        return view('list')->withTitle('取引企業管理 | LIST')->with(['companies' => $companies]);
    }

    // 登録
    public function register() {
        $company = new Company();
        $nextId = DB::table('companies')->max('id') + 1;
        return view('register')->withTitle('取引企業管理 | REGISTER')->with([
            'company' => $company,
            'nextId' => $nextId,
        ]);
    }
    
    // 保存する
    public function store(Request $request) { 
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'address'       => 'required',
            'website'       => 'required|active_url',
            'email'         => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $company = new Company();
        $company->name = $request->name;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->email = $request->email;
        $company->save();

        return redirect()->route('list');
    }

    // 削除
    public function delete($id) {
        $company = Company::find($id)->delete();
        return redirect()->route('list')->with('success_msg', 'Company is removed!');
    }

    // 修正
    public function modify($id){
        $company = Company::find($id);
        return view('modify')->withTitle('取引企業管理 | MODIFY')->with(compact('company'));
    }

    // 更新
    public function update(Request $request) {

        $company = Company::findOrFail($request->id);
        $company->name = $request->name;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->email = $request->email;
        $company->save();

        return redirect()->route('list')->with('success_msg', 'Company is updated!');
    }

    


}
