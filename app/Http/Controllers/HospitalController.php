<?php

namespace App\Http\Controllers;

use App\Hospital;
use App\Http\Requests\StoreHospitalRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->ability('superadministrator', 'read-hospitals')){
            return view('hospital.read',[
                'pageheader'=>'医院',
                'pagedescription'=>'列表',
                'hospitals'=>Hospital::all(),
                'enableUpdate'=>Auth::user()->hasPermission('update-hospitals'),
                'enableDelete'=>Auth::user()->hasPermission('delete-hospitals'),
            ]);
        }
        return abort(403,config('yyxt.permission_deny'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->ability('superadministrator', 'create-hospitals')){
            return view('hospital.create',[
                'pageheader'=>'医院',
                'pagedescription'=>'添加',
            ]);
        }
        return abort(403,config('yyxt.permission_deny'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreHospitalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHospitalRequest $request)
    {
        if (Auth::user()->ability('superadministrator', 'create-hospitals')){
            $hospital=new Hospital();
            $hospital->name=$request->input('name');
            $hospital->display_name=$request->input('display_name');
            $hospital->tel=$request->input('tel');
            $hospital->qq=$request->input('qq');
            $hospital->wechat=$request->input('wechat');
            $hospital->addr=$request->input('addr');
            $hospital->description=$request->input('description');
            $bool=$hospital->save();
            if ($bool){
                return redirect()->route('hospitals.index')->with('success','well done!');
            }else{
                return redirect()->back()->with('error','Something wrong!!!');
            }
        }
        return abort(403,config('yyxt.permission_deny'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->ability('superadministrator', 'update-hospitals')){
            return view('hospital.update',[
                'pageheader'=>'医院',
                'pagedescription'=>'更新',
                'hospital'=>Hospital::findOrFail($id),
            ]);
        }
        return abort(403,config('yyxt.permission_deny'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreHospitalRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreHospitalRequest $request, $id)
    {
        if (Auth::user()->ability('superadministrator', 'update-hospitals')){
            $hospital=Hospital::findOrFail($id);
            $hospital->display_name=$request->input('display_name');
            $hospital->tel=$request->input('tel');
            $hospital->qq=$request->input('qq');
            $hospital->wechat=$request->input('wechat');
            $hospital->addr=$request->input('addr');
            $hospital->description=$request->input('description');
            $bool=$hospital->save();
            if ($bool){
                return redirect()->route('hospitals.index')->with('success','well done!');
            }else{
                return redirect()->back()->with('error','Something wrong!!!');
            }
        }
        return abort(403,config('yyxt.permission_deny'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->ability('superadministrator', 'delete-hospitals')){
            $hospital=Hospital::findOrFail($id);
            //todo : before delete hospital you should detach the relations between hospital-user-office-disease
            //删除用户与医院关联
            DB::table('user_hospital')->where('hospital_id',$hospital->id)->delete();
            //删除医院下的科室
            foreach ($hospital->offices as $office){
                //清空用户与科室关联
                DB::table('user_office')->where('office_id',$office->id)->delete();
                foreach ($office->diseases as $disease){
                    //删除科室下的病种
                    $disease->delete();
                }
                $office->delete();
            }
            $bool=$hospital->delete();
            if ($bool){
                return redirect()->route('hospitals.index')->with('success','well done!');
            }else{
                return redirect()->back()->with('error','Something wrong!!!');
            }
        }
        return abort(403,config('yyxt.permission_deny'));
    }
}
