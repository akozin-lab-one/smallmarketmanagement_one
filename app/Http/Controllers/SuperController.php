<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SuperController extends Controller
{
    //mainPage
    public function dashboardPage(){
        $persons = User::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->where('role', 'admin')
        ->groupBy('date')
        ->get();
        // dd($persons->toArray());
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
        // $userStatus = User::select('user_action')->where( 'id', 2)->get();
        // dd($userStatus->toArray());
        $personList = User::where('role', 'admin')->get();
        // dd($personList->toArray());
        $updateTime = null;
        foreach($personList as $person){
        // dd($person->user_action);
        $duration = $person->duration;
        // dd($duration);
        $createdDate = $person->created_at;
        $after50Days = $createdDate->modify('+'. $duration .'days');
        // dd($after50Days);
        // dd(User::where('role', 'admin')->get()->toArray());
        $dayAfter = $after50Days->format('d-m-y');
        // dd($dayAfter);
        $daysDifference = now()->diffInDays($createdDate) + 1 === $person->duration ? now()->diffInDays($createdDate) + 1 : now()->diffInDays($createdDate) + ($person->duration - now()->diffInDays($createdDate));
        // dd($daysDifference ,$person->duration);
        // dd($person->user_action);
        if ($person->user_action === 0) {
            $daysDifference === $person->duration ? User::where('role', 'admin')->where('id', $person->id)->update(['user_action' => 0]) : User::where('role', 'admin')->where('id', $person->id)->update(['user_action' => 1]);
        }else{
            User::where('role', 'admin')->where('id', $person->id)->update(['duration' => 0]);
        }


        // dd( $person->created_at->format('d-m-y') !== $person->updated_at->format('d-m-y'));
        // if ($person->user_action === 1) {
        //     // dd(true);
        //     User::where('role', 'admin')->where('id', $person->id)->update(['duration' => 0]);
        // }elseif ($person->user_action === 0) {
        //     User::where('role', 'admin')->where('id', $person->id)->update(['duration' => 30]);
        // }

        // if ($person->duration > 0) {
        //     // dd(true);
        //     User::where('role', 'admin')->update(['user_action' => 0]);
        // }elseif ($person->duration === 0) {
        //     User::where('role', 'admin')->update(['user_action' => 1]);
        // }

        }

        return view('superuser.team', compact('personList','dayAfter','daysDifference','updateTime'));
    }
}

