<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

use App\Models\Teachers;
use App\Models\Tenhim;
use App\Models\MergejilBagsh;
use App\Models\Fond;
use App\Models\Hicheel;
use App\Models\Angi;
use Illuminate\Support\Facades\Auth;

class TeachersController extends Controller
{

    public function index()
    {
        $pageTitle = 'Багш';
        $pageName = 'teachers';
        $teachers = Teachers::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teachers' => $teachers
        ]);
    }

    public function add()
    {
        $pageTitle = 'Багш нэмэх';
        $pageName = 'teachers';

        $tenhim = Tenhim::orderBy('created_at', 'desc')->get();
        $mergejil = MergejilBagsh::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/add', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'tenhims' => $tenhim,
            'mergejils' => $mergejil,
            'user' => Auth::guard('manager')->user()
        ]);
    }

    public function store(Request $request)
    {

        $member = new Teachers;

        if ($request->hasFile('image')) {

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->code) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/teachers/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/teachers/thumbs/' .$imageName.'.jpg'));
            $member->image = $imageName.'.jpg';
        }

        $member->ner = Str::ucfirst($request->get("ner"));
        $member->ovog = Str::ucfirst($request->get("ovog"));
        $member->urag = Str::ucfirst($request->get("urag"));
        $member->code = $request->get("code");
        $member->register = $request->get("register");
        $member->huis = $request->get("huis");
        $member->tursun = $request->get("tursun");
        $member->email = $request->get("email");
        $member->password = $request->get("password");
        $member->t_id = $request->get("t_id");
        $member->mb_id = $request->get("mb_id");
        $member->phone = $request->get("phone");
        $member->address = $request->get("address");


        $member->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('manager-teachers')->with('success', 'Багш амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Багш амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function edit($id)
    {
        $pageTitle = 'Багш засварлах';
        $pageName = 'teachers';

        $teacher = Teachers::findOrFail($id);
        $tenhim = Tenhim::orderBy('created_at', 'desc')->get();
        $mergejil = MergejilBagsh::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/edit', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teacher' => $teacher,
            'tenhims' => $tenhim,
            'mergejils' => $mergejil,
            'user' => Auth::guard('manager')->user()
        ]);
    }

    public function update(Request $request, $id)
    {
        $member = Teachers::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->code) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/teachers/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/teachers/thumbs/' .$imageName.'.'.$file->getClientOriginalExtension()));
            $member->image = $imageName.'.jpg';
        }

        $member->ner = Str::ucfirst($request->get("ner"));
        $member->ovog = Str::ucfirst($request->get("ovog"));
        $member->urag = Str::ucfirst($request->get("urag"));
        $member->code = $request->get("code");
        $member->register = $request->get("register");
        $member->huis = $request->get("huis");
        $member->tursun = $request->get("tursun");
        $member->email = $request->get("email");
        $member->password = $request->get("password");
        $member->phone = $request->get("phone");
        $member->address = $request->get("address");
        $member->updated_at = Carbon::now();

        $member->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect()->route('manager-teachers')->with('success', 'Багш засварлагдлаа нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Багш засварлагдлаа нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function fond()
    {
        $pageTitle = 'Багшийн цагийн фонд';
        $pageName = 'teachers';
        $teachers = Teachers::orderBy('created_at', 'desc')->get();

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/fond', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teachers' => $teachers,
            'user' => Auth::guard('manager')->user()
        ]);
    }

    public function fond_list($id)
    {
        $pageTitle = 'Багшийн цагийн фонд';
        $pageName = 'teachers';

        $teacher = Teachers::select('teachers.id', 'teachers.ner', 'teachers.ovog', 'teachers.image', 'teachers.code', 'teachers.t_id', 'teacher_mergejil.ner as mergejil', 'tenhim.ner as tenhim', 'tenhim.tovch')
                            ->join('teacher_mergejil', 'teacher_mergejil.id', '=', 'teachers.mb_id')
                            ->join('tenhim', 'tenhim.id', '=', 'teachers.t_id')
                            ->findOrFail($id);
        $hicheels = Hicheel::orderBy('ner', 'asc')->get();
        $angis = Angi::orderBy('ner', 'asc')->get();
        
        $fonds = Fond::select('fond.id as fid', 'fond.t_id', 'fond.tsag as tsag', 'teachers.id', 'angi.ner as angi', 'angi.course as course', 'angi.buleg as buleg', 'angi.tovch', 'hicheel.ner as hicheel', 'hicheel.tovch as hicheel_tovch')
                            ->join('teachers', 'teachers.id', '=', 'fond.t_id')
                            ->join('angi', 'angi.id', '=', 'fond.a_id')
                            ->join('hicheel', 'hicheel.id', '=', 'fond.h_id')
                            ->orderBy('angi', 'asc')
                            ->where('fond.t_id', $id)->get();

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/fond-list', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'teacher' => $teacher,
            'hicheels' => $hicheels,
            'angis' => $angis,
            'fonds' => $fonds,
            't_id' => $id,
            'user' => Auth::guard('manager')->user()
        ]);
    }

    public function fond_store(Request $request)
    {

        $fond = new Fond;

        $fond->a_id = $request->get("a_id");
        $fond->h_id = $request->get("h_id");
        $fond->t_id = $request->get("t_id");
        $fond->tsag = $request->get("tsag");

        $angi = Angi::where("id", $fond->a_id)->first();
        $hicheel = Hicheel::where("id", $fond->h_id)->first();

        $angi_text = explode(" ", $angi->ner);
        $a_t = '';
        foreach($angi_text as $ax)
        {
            $a_t .= Str::substr($ax, 0, 1);
        }

        $hicheel_text = explode(" ", $hicheel->ner);
        $h_t = '';
        foreach($hicheel_text as $hx)
        {
            $h_t .= Str::substr($hx, 0, 3).' ';
        }

        $fond->slug = Str::slug($a_t.$angi->course.$angi->buleg.' '.$h_t);

        $fond->save();

        switch ($request->input('action')) {
            case 'save':
                return redirect('manager/teachers/fond_list/'.$request->get("t_id"))->with('success', 'Багш цагийн фонд амжилттай нэмэгдлээ!'); 
                break;
    
            case 'save_and_new':
                return back()->with('success', 'Багш амжилттай нэмэгдлээ!');
                break;
    
            case 'preview':
                echo 'preview';
                break;
        }
    }

    public function fond_delete(Request $request)
    {
        $fond = Fond::findOrFail($request->get("t_id"));
        $fond->delete();
        return redirect('manager/teachers/fond_list/'.$request->get("id"))->with('success', 'Багшийн цагийн фонд амжилттай устгалаа!'); 
    }

    public function destroy(Request $request, $id)
    {
        $member = Teachers::findOrFail($id);
        $member->delete();

        return redirect()->route('teachers')->with('success', 'Багш устгагдлаа нэмэгдлээ!'); 

    }

    public function delete(Request $request)
    {
        $member = Teachers::findOrFail($request->get("t_id"));
        $member->delete();
        return redirect()->route('manager-teachers')->with('success', 'Багш амжилттай устгалаа!'); 
    }

}
