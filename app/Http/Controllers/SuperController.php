<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuperController extends Controller
{
    //mainPage
    public function dashboardPage(){
        $persons = User::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->groupBy('date')
        ->get();
        // dd($person->toArray());
        return view('superuser.dashboard', compact('persons'));
    }

    //detailPage
    public function detailPage($id){
        $personDetail = User::where('id', $id)->first();
        // dd($personDetail->role);
        return view('superuser.detail', compact('personDetail'));
    }

    //editPage
    public function editPage($id){
        // dd($id);
        $personEdit = User::where('id', $id)->first();
        return view('superuser.edit', compact('personEdit'));
    }

    //edit
    public function editData(Request $request){
        dd($request->all());
    }

    //teamPage
    public function teamPage(){
        $personList = User::where('role', 'admin')->get();
        // dd($personList->toArray());
        return view('superuser.team', compact('personList'));
    }
}
