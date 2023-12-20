<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //mainPage
    public function mainPage(){
        $category = Category::select('id', 'name', 'user_id', 'created_at')->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('adminuser.Category.list', compact('category'));
    }

    //createPage
    public function createPage(){
        return view('adminuser.Category.create');
    }

    //createData
    public function createCategory(Request $request){
        // dd($request->toArray());
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        Category::create($data);
        return back()->with(['successCategoryData'=>'သင့် ကုန်ပစည်းအတွက် category ဖန်တီးပြီးပါပြီ။ အသေးစိတ်သိရန် မူလ page သို့သွားပေးပါ။']);
    }

    //editPage
    public function editPage($id){
        $category = Category::where('id', $id)->first();
        return view('adminuser.Category.edit', compact('category'));
    }
    //edit
    public function editData(Request $request){
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('adminuser#categorymain');
    }

    //delete
    public function deleteData($id){
        Category::where('id', $id)->delete();
        return back()->with(['deleteCategorysuccess'=>'Category ပယ်ဖျက်ခြင်းအောင်မြင်ပါသည်။']);
    }

    //validate
    public function validateRequestData($request){
        $validateRule = [
            'name' => 'required'
        ];
        Validator::make($request->all(), $validateRule)->validate();
    }

    //request
    public function requestData($request){
        return[
            'name' => $request->name,
            'user_id'=>$request->userId
        ];
    }
}
