<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CreatorController extends Controller
{
    // return view manager creator
    public function index()
    {
        return view('admin.creator');
    }
    // get all creator to show
    public function getAllUsers()
    {
        $list = User::whereHas('login', function ($query) {
            $query->where('role', 1)->where('isActive', 1);
        })->get();
        return  DataTables::of($list)
            ->addColumn('project', function (User $object) {
                // get all projects creator is joining
                $html = '';
                foreach ($object->getProjectOfCreator as $relate) {
                    $html .= "<a class='btn btn-default' href='" . route('admin.project.detail', ['idProject' => $relate->getProject->id, 'idCreator' => $object->id]) . "'>" . $relate->getProject->name . " : <span class=''>" . $relate->getTime() . " 時間 </span></a>";
                }
                if (!$html == '') {
                    return $html;
                }
                return "<span >No assign </span>";
            })
            ->addColumn('avatar', function (User $user) {
                return $user->getAvatar()? $user->getAvatar() :asset('assets/img/default-avatar.png');
            })
            ->rawColumns(['project'])
            ->make(true);
    }
}
