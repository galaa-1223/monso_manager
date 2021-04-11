<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Settings;
use App\Models\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class SettingsController extends Controller
{

    public function index()
    {

        $pageTitle = 'Хувийн мэдээлэл';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/index', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('manager')->user()
        ]);
    }

    public function password()
    {

        $pageTitle = 'Нууц үг солих';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/password', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('manager')->user()
        ]);
    }

    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::guard('manager')->user()->password))) {
            return redirect()->back()->with("error2","Таны одоогийн нууц үг таны оруулсан нууц үгтэй таарахгүй байна. Дахин оролдоно уу.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            return redirect()->back()->with("error2","Шинэ нууц үг нь таны одоогийн нууц үгтэй ижил байж болохгүй. Өөр нууц үг сонгоно уу.");
        }

        $request->validate([
            'new-password' => 'between:8,255|required_with:new-password-confirm|same:new-password-confirm',
            'new-password-confirm' => 'required|between:8,255'
        ]);

        $user = Auth::guard('manager')->user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success2","Нууц үг амжилттай өөрчлөгдсөн!");

    }

    public function changePicture(Request $request, $id)
    {
        $manager = Manager::findOrFail($id);

        if ($request->hasFile('image')) {

            if($manager->image != null){
                $imagePath = public_path('/uploads/managers/'.$manager->image);
                $imageThumbPath = public_path('/uploads/managers/thumbs/'.$manager->image);

                if(file_exists($imagePath))
                {
                    unlink($imagePath);
                    unlink($imageThumbPath);
                }
            }

            $date = Str::slug(Carbon::now());
            $imageName = Str::slug($request->name) . '-' . $date;
            $image = Image::make($request->file('image'))->save(public_path('/uploads/managers/') . $imageName . '.jpg')->encode('jpg','50');
            $image->fit(300, 300);
            $image->save(public_path('/uploads/managers/thumbs/' .$imageName.'.jpg'));
            
            
            $manager->image = $imageName.'.jpg';
            
        }

        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->save();

        return redirect()->route('manager-settings')->with('success', 'Мэдээлэл амжилттай солигдлоо!'); 
    }

    public function huvaari()
    {

        $pageTitle = 'Хуваарь тохиргоо';
        $pageName = 'settings';

        $activeMenu = activeMenu($pageName);

        return view('manager/pages/'.$pageName.'/huvaari', [
            'first_page_name' => $activeMenu['first_page_name'],
            'page_title' => $pageTitle,
            'page_name' => $pageName,
            'user' => Auth::guard('manager')->user()
        ]);
    }
}
