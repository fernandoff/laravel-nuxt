<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->render(Profile::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => ['required', 'min:3'],
            'biography' => ['required', 'min:3'],
        ]);

        if(!empty(request()->id)){
            $profile  = Profile::findOrFail(request()->id);
            $profile->fill(request()->all())->save();
        } else {
            $profile = Profile::create(request()->all());
        }

        return $profile;
    }

}
