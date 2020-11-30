<?php

namespace App\Http\Controllers;

use App\Http\Requests\Adviser\AdviserStoreRequest;
use App\Http\Requests\Adviser\AdviserUpdateRequest;
use App\Models\Adviser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use DateTime;

class AdviserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "advisers" => Adviser::with("user")->get()->all(),
            "token" => request()->get("token"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdviserStoreRequest $request)
    {
        try {
            $age = (new DateTime($request->birthday))->diff(new DateTime('now'))->y;
            $request->merge([
                'user_id' => Auth::id(),
                'age' => $age,
            ]);
            $adviser = Adviser::create($request->all());
            return response()->json([
                "adviser" => Arr::add($adviser, "user", $adviser->user),
                "token" => request()->get("token"),
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                "message" => "failed to create adviser",
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function show(Adviser $adviser)
    {
        return response()->json([
            "adviser" => Arr::add($adviser, "user", $adviser->user),
            "token" => request()->get("token"),
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function update(AdviserUpdateRequest $request, Adviser $adviser)
    {
        $adviser->update($request->all());
        return response()->json([
            "adviser" => Arr::add($adviser, "user", $adviser->user),
            "token" => request()->get("token"),
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adviser  $adviser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adviser $adviser)
    {
        $adviser->delete();
        return response()->json([
            "adviser" => $adviser,
            "token" => request()->get("token"),
        ], Response::HTTP_OK);
    }
}
