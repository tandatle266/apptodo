<?php

namespace App\Http\Controllers;
use App\Http\Requests\List\TaskRequest;
use App\Models\ListTodo;
use Illuminate\Http\Request;


class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ListTodo::paginate(5);
        return view('listtodo.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listtodo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'name' => 'required',
            'status' => 'required'
        ],
        [
            'name.required' => 'Tên Task không được để trống',
            'status.required' => 'Tiến trình không được để trống',
            'name.unique' => 'Task này đã có',
        ]);
        ListTodo::create($request->all());
        return redirect()->route('listtodo.index')->with('success','Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       //dd(ListTodo::all());
        //$alert = ListTodo::find($id);
       // return $alert;
        //return redirect()->route('listtodo.index',['alert'=>$alert]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ListTodo::find($id);
        return view('listtodo.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        
        ListTodo::find($id)->update($request->only('name','status'));
        return redirect()->route('listtodo.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $progress =  ListTodo::find($id);
        $stat = $progress->status;
        if($stat == 0)
        {
            return redirect()->route('listtodo.index')->with('error','Không thể xoá hoạt động này');
        }
        else{
            ListTodo::where('id',$id)->delete();
            return redirect()->route('listtodo.index')->with('success','Xoá thành công');
        }
        //
        
    }
   
}
