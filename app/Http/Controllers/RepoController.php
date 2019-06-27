<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GrahamCampbell\GitHub\Facades\GitHub;

class RepoController extends Controller
{
    public function index()
    {
        return view('repos.index');
    }

    public function getAllRepos()
    {
        $repos = Github::api('repo')->find('symfony');
        dd($repos);
    }

    public function getUsernames(Request $request)
    {
      $users = GitHub::api('user')->find($request->input('text'));
      return $users;
    }

    public function getRepoByUser(Request $request)
    {
        $repos = GitHub::api('user')->repositories($request->input('name'));
        return $repos;
    }
}
