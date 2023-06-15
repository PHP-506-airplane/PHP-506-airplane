<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : Http/Controller
 * 파일명       : NoticeController.php
 * 이력         :   v001 0612 이동호 new
**************************************************/

namespace App\Http\Controllers;

use App\Models\NoticeInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = NoticeInfo::select(['notice_no', 'notice_title', 'created_at', 'updated_at'])->orderBy('notice_no', 'DESC')->paginate(10);
        return view('noticelist', compact('data'));
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
    public function store(Request $req)
    {
        $notice = new NoticeInfo([
            'title'     => $req->input('title')
            ,'content'  => $req->input('content')
        ]);
        $notice->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($notice_no)
    {
        return view('noticedetail')->with('data', NoticeInfo::findOrFail($notice_no));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($notice_no)
    {
        $notice = NoticeInfo::find($notice_no);
        return view('noticeedit')->with('data', $notice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $notice_no)
    {
        $req->request->add(['notice_no' => $notice_no]);

        $validator = Validator::make(
            $req->only('notice_no', 'title', 'content')
            ,[
                'title'         => 'required|between:3,50'
                ,'content'      => 'required|max:4000'
                ,'notice_no'    => 'required|integer'
            ]
        );

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($req->only('title', 'content'));
        }

        $notice = NoticeInfo::find($notice_no);
        $notice->notice_title = $req->title;
        $notice->notice_content = $req->content;
        $notice->save();

        return view('noticedetail')->with('data', NoticeInfo::findOrFail($notice_no));
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
}
