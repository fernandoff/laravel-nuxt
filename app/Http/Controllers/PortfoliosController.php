<?php

namespace App\Http\Controllers;

use http\Message\Body;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\Types\Boolean;

class PortfoliosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response|JsonResponse
    {
        return $this->render(Portfolio::orderBy("start", "desc")->paginate());
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
            'description' => ['required', 'min:3'],
        ]);

        if(!empty(request()->id)){
            $portfolio  = Portfolio::findOrFail(request()->id);
            $portfolio->fill(request()->all())->save();
        } else {
            $portfolio = Portfolio::create(request()->all());
        }

        return $portfolio;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio): Response|JsonResponse|bool
    {
        return $portfolio->delete();
    }
}
