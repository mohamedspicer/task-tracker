<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {
        $user = auth()->user();
        if($user && $user->is_admin) {
            $projects = $user->projects()->get();
            return responseJson(1, 'All projects admin created', $projects);
        }
        return responseJson(0, 'User not authorized');
    }

    public function create(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $user = auth()->user();
        if($user && $user->is_admin) {
            $user->projects()->create($request->all());
            return responseJson(1, 'project created succefully');
        }
        return responseJson(0, 'User not authorized');
    }
}
