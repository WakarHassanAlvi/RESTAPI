<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $brands = Brand::all();

            if($request->has('name')) {
                $brands = Brand::where('name', $request->name)->get();
            }
            if($request->has('active')) {
                $brands = $brands->intersect(Brand::where('active', $request->active)->get());
            }
            if($request->has('date')) {
                $brands = $brands->intersect(Brand::whereDate('created_at', date($request->date))->get());
            }
            if($request->has('sort')) {
                switch($request->sort) {
                    case 'name':
                        $brands = $brands->sortBy('name');
                        return response()->json(BrandResource::collection($brands), Response::HTTP_OK);
                    case 'active':
                        $brands = $brands->sortByDesc('active');
                        return response()->json(BrandResource::collection($brands), Response::HTTP_OK);
                    case 'date':
                        $brands = $brands->sortBy('date');
                        return response()->json(BrandResource::collection($brands), Response::HTTP_OK);
                }
            }

            return response()->json(BrandResource::collection($brands), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to get brands'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'url' => 'required',
                'operator_id' => 'required',
                'active' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            }

            $brand = Brand::create($request->all());

            return response()->json(new BrandResource($brand), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to create brand'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $brand = Brand::find($id);

            return response()->json(new BrandResource($brand), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to get brand'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'url' => 'required',
                'operator_id' => 'required',
                'active' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            }

            $brand = Brand::updateOrCreate(['id' => $id], $request->all());

            return response()->json(new BrandResource($brand), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to update brand'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
