<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Operator;
use App\Http\Resources\OperatorResource;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $operators = Operator::all();

            if($request->has('name')) {
                $operators = Operator::where('name', $request->name)->get();
            }
            if($request->has('active')) {
                $operators = $operators->intersect(Operator::where('active', $request->active)->get());
            }
            if($request->has('date')) {
                $operators = $operators->intersect(Operator::whereDate('created_at', date($request->date))->get());
            }
            if($request->has('sort')) {
                switch($request->sort) {
                    case 'name':
                        $operators = $operators->sortBy('name');
                        return response()->json(OperatorResource::collection($operators), Response::HTTP_OK);
                    case 'active':
                        $operators = $operators->sortByDesc('active');
                        return response()->json(OperatorResource::collection($operators), Response::HTTP_OK);
                    case 'date':
                        $operators = $operators->sortBy('date');
                        return response()->json(OperatorResource::collection($operators), Response::HTTP_OK);
                }
            }

            return response()->json(OperatorResource::collection($operators), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to get operators'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
                'active' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            }

            $operator = Operator::create($request->all());

            return response()->json(new OperatorResource($operator), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to create operator'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
            $operator = Operator::find($id);

            return response()->json(new OperatorResource($operator), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to get operator'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
                'active' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
            }

            $operator = Operator::updateOrCreate(['id' => $id], $request->all());

            return response()->json(new OperatorResource($operator), Response::HTTP_OK);

        } catch (Exception $exception) {
            if (env('APP_DEBUG')) {  dd ($exception->getMessage()); }
            return response()->json(['status' => false, 'error_messages' => 'Unable to update operator'], Response::HTTP_INTERNAL_SERVER_ERROR);
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
