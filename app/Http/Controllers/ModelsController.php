<?php

namespace App\Http\Controllers;

use Ixudra\Curl\Facades\Curl;
use App\Models\ModelPredict;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = ModelPredict::select();

        $name=$request->name;
        if($name){
            $models=$models->where('model.name', 'LIKE', '%' . $name . '%')->where('status', 1);
        }
        $models=$models->get();
        return view('models.index', compact('models','name'));
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('models.create');
    }

    public function show($id)
    {
        $model = ModelPredict::find($id);
        return view('models.show', compact('model'));
    }
    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new ModelPredict();
        $model->name = $request->name;
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');;
            $model->status = 1;
            $model->description = $request->description;

            $response = Curl::to('http://127.0.0.1:8000/uploadModel/')
                ->withFile('file', $file, 'h5', $file->getClientOriginalName())
                ->post();
            $data = json_decode($response);
            if (strcmp($data->status, "success") === 0) {
                $model->file_name = $data->file_name;
                $model->save();
            }
        }
        return redirect(route('models.index'));
    }

    /**
     * Edit user data
     *
     * @param
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = ModelPredict::find($id);
        return view('models.edit', compact('model'));
    }

    /**
     * Show form for creating user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = ModelPredict::find($id);
        $model->name = $request->name;
        if ($request->hasFile('new_file_name')) {
            $file = $request->file('new_file_name');
            $response = Curl::to('http://127.0.0.1:8000/uploadModel/')
                ->withFile('file', $file, 'h5', $file->getClientOriginalName())
                ->post();
            $data = json_decode($response);
            if (strcmp($data->status, "success") === 0) {
                $model->file_name = $data->file_name;
            }
        }
        $model->description = $request->description;
        $model->save();

        return redirect(route('models.index'));
    }

    public function delete($id)
    {
        $model = ModelPredict::find($id);
        $model->status = 0;
        $model->save();
        return redirect(route('models.index'));
    }

}
