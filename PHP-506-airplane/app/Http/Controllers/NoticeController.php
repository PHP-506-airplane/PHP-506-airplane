<?php
/**************************************************
 * 프로젝트명   : PHP-506-airplane
 * 디렉토리     : Http/Controller
 * 파일명       : NoticeController.php
 * 이력         :   v001 0612 이동호 new
 *                  v002 0623 이동호 add 검색기능
**************************************************/

namespace App\Http\Controllers;

use App\Models\FlightInfo;
use App\Models\NoticeInfo;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Http\Middleware\AdminMiddleware;
use App\Models\RateInfo;

class NoticeController extends Controller
{
    // 미들웨어로 관리자권한 체크
    public function __construct()
    {
        $this->middleware(AdminMiddleware::class)->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        // $data = NoticeInfo::select(['notice_no', 'notice_title', 'created_at', 'updated_at'])->orderBy('notice_no', 'DESC')->paginate(10);
        // return view('noticelist', compact('data')); // v002 del

        // v002 add
        $searchText = $req->input('search');

        $query = NoticeInfo::select(['notice_no', 'notice_title', 'created_at', 'updated_at'])
            ->orderBy('notice_no', 'DESC');
    
        // 검색어를 받아와서 해당하는 공지사항을 검색하고 페이지네이션해서 반환
        if ($searchText) {
            $query->where('notice_title', 'like', '%' . $searchText . '%');
        }
    
        $data = $query->paginate(10);
    
        return view('noticelist', compact('data', 'searchText'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validator = Validator::make(
            $req->only('notice_no', 'title', 'content'),
            [
                'title'         => 'required|between:3,50'
                ,'content'       => 'max:4000'
                ,'image'         => 'nullable|image|max:2048'
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($req->only('title', 'content'));
        }

        $notice = new NoticeInfo([
            'u_no'            => Auth::user()->u_no
            ,'notice_title'     => $req->title
            ,'notice_content'   => $req->content
        ]);
        
        // 이미지가 업로드되었는지 확인
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            // 파일 이름 (작성자 PK + 현재 시간 + 확장자)
            $imageName = Auth::user()->u_no . time() . '.' . $image->getClientOriginalExtension();
            // 이미지를 public/uploadedimg 로 이동
            $image->move(public_path('uploadedimg'), $imageName);
            // 이미지 경로
            $imagePath = 'uploadedimg/' . $imageName;
            // 이미지 경로를 image_path칼럼에 insert
            $notice->image_path = $imagePath;
        }
        $notice->save();
        
        $notice_no = NoticeInfo::select('notice_no')->max('notice_no');
        
        return redirect()->route('notice.show', $notice_no);
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
        if (empty(Auth::user()) || Auth::user()->admin_flg === '0') {
            return redirect()->route('notice.index')->with('alert', '권한이 없습니다.');
        }

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
        if (empty(Auth::user()) || Auth::user()->admin_flg === '0') {
            return redirect()->route('notice.index')->with('alert', '권한이 없습니다.');
        }

        $req->request->add(['notice_no' => $notice_no]);

        $validator = Validator::make(
            $req->only('notice_no', 'title', 'content'),
            [
                'title'         => 'required|between:3,50'
                ,'content'       => 'max:4000'
                ,'notice_no'     => 'required|integer'
                ,'image'         => 'nullable|image|max:2048'
            ]
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($req->only('title', 'content'));
        }

        $notice = NoticeInfo::find($notice_no);
        $notice->notice_title = $req->title;
        $notice->notice_content = $req->content;

        // 기존 이미지 유지
        if ($notice->image_path) {
            $imagePath = $notice->image_path;
        } else {
            $imagePath = null;
        }

        // 이미지가 업로드되었는지 확인
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = Auth::user()->u_no . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploadedimg'), $imageName);
            $imagePath = 'uploadedimg/' . $imageName;
            $notice->image_path = $imagePath;
        }

        $notice->save();

        return redirect()->route('notice.show', ['notice' => $notice_no])->with('alert', '수정되었습니다.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($notice_no)
    {
        if (empty(Auth::user()) || Auth::user()->admin_flg === '0') {
            return redirect()->route('notice.index')->with('alert', '권한이 없습니다.');
        }
        
        NoticeInfo::destroy($notice_no);
        return redirect()->route('notice.index')->with('alert', '삭제되었습니다.');
    }

    public function rateinfoget() {
        $data = RateInfo::select('*')
            ->get();

        return view('rateinfo')->with('data', $data);
    }
}
