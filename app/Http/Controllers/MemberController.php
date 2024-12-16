<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Member::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:members',
            'phone' => 'required',
        ]);

        return Member::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return Member::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $member = Member::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $member->update($validated);
        return $member;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Member::findOrFail($id)->delete();
        return response()->noContent();
    }
}
