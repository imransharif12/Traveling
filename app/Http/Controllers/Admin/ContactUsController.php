<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\{ContactUs};
use App\Http\Controllers\Controller;
use App\DataTables\ContactUsDataTable;
use App\Http\Helpers\Common;
class ContactUsController extends Controller
{
    protected $helper;
    public function __construct()
    {
        $this->helper = new Common;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactUsDataTable $dataTable)
    {
        return $dataTable->render('admin.contactus.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input=$request->all();
        ContactUs::create($input);
        return response(['message'=>'Record Added Successfully.', 'code'=>200]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request)
    {
        ContactUs::where(['id'=>$request->id])->delete();
        $this->helper->one_time_message('success', 'Deleted Successfully');
        return redirect('admin/contact');
    }
}
