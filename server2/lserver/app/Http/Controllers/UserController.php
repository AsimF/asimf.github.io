<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Username;
use App\Token;
use App\Items;

class UserController extends Controller
{
    public function authenticate(Request $request){
        $user = Username::where('user', '=', $request->input('user'))->first();
        if($user && password_verify($request->password, $user->password)){
            $newTokenObj = new Token;
            $newTokenObj->user = $request->input('user');
            $newToken = sha1($request->input('user'));
            $newTokenObj->token = $newToken;
            $newTokenObj->save();
            $data['status']="OK";
            $data['msg']="Valid Credentials";
            $data['token']=$newToken;
            //$data['Access-Control-Allow-Origin']='*';
        } else {
            $data['status']="FAIL";
            $data['msg']="Invalid Credentials";
        }
        return json_encode($data);
    }

    public function updateItems(Request $request){
        $user = Token::where('token', '=', $request->input('token'))->first()->user;
        if($user){
            $uPK = DB::table('users')
                    //->select('pk')
                    ->where('users.user', '=', $user)->first()->pk;
            DB::table('diary')
                ->insert(['userFK' => $uPK, 'itemFK' => $request->input('itemFK')]);
            $data['status']="OK";
            $data['msg']="Valid Credentials";
        } else {
            $data['status']="FAIL";
            $data['msg']="Invalid Token";
        }
        return json_encode($data);
    }

    public function getUserItems($token){
        $user = Token::where('token', '=', $token)->first();
        if($user){
            //$dI = DB::table('diary')->get();
            $uPK = DB::table('users')
                    //->select('pk')
                    ->where('users.user', '=', $user->user)->first()->pk;
            //$items = DB::table('diary')->where('userFK', '=', $uPK)->find(30);//$dI::where('userFK', '=', $uPK);
            $items = DB::table('diary')//Items::where('userFK', '=', $uPK)->first()
                ->select('diaryItems.pk', 'diaryItems.item', 'timestamp')
                ->leftJoin('diaryItems', 'diary.itemFK', '=', 'diaryItems.pk')
                ->where('userFK', '=', $uPK)
                ->orderBy('timestamp', 'desc')
                ->get();//find(30);//find(30);
            //$itemlist = DB::table('diaryItems')->where('pk', $items->itemFK);
            $data['status']="OK";
            $data['msg']="Valid Token";
            //select diaryItems.item,timestamp from diaryItems left join diary on diaryItems.pk=diary.itemFK  where userFK=? order by timestamp desc
            $data['items']=$items;//$itemlist->item;
        } else {
            $data['status']="FAIL";
            $data['msg']="Invalid Credentials";
        }
        return json_encode($data);
    }

    public function getUserItemsSummary($token){
        $user = Token::where('token', '=', $token)->first();
        if($user){
            //$dI = DB::table('diary')->get();
            $uPK = DB::table('users')
                    //->select('pk')
                    ->where('users.user', '=', $user->user)->first()->pk;
            //select diaryItems.item,count(timestamp) as count from diaryItems left join diary on diaryItems.pk=diary.itemFK  where userFK=? group by diaryItems.item
            $items = DB::table('diary')//Items::where('userFK', '=', $uPK)->first()
                ->leftJoin('diaryItems', 'diary.itemFK', '=', 'diaryItems.pk')
                ->where('userFK', '=', $uPK)
                ->groupBy('item')
                ->select('item', DB::raw('COUNT(timestamp) as count'))
                ->get();//find(30);//find(30);
            //$itemlist = DB::table('diaryItems')->where('pk', $items->itemFK);
            $data['status']="OK";
            $data['msg']="Valid Token";
            //select diaryItems.item,timestamp from diaryItems left join diary on diaryItems.pk=diary.itemFK  where userFK=? order by timestamp desc
            $data['items']=$items;//$itemlist->item;
        } else {
            $data['status']="FAIL";
            $data['msg']="Invalid Credentials";
        }
        return json_encode($data);
    }

    public function getItems(){
        $dI = DB::table('diaryItems')->get();
        $data['status']="OK";
        $data['msg']="Valid Request";
        $data['items']= $dI;
        //return $data;
        return json_encode($data);
    }
}
