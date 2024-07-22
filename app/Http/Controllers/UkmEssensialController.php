<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UkmEssensialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.ukm-essensial.index');
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
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('admin.ukm-essensial.promkes.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function showKegiatan()
    {
        return view('admin.ukm-essensial.promkes.promkes-umum.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
