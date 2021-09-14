<?php

namespace App\Http\Controllers;

use App\Models\ExcelData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Importer;


class ExcelDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('upload');
    }


    public function store(Request $request)
    {
        $validator                      =   Validator::make($request->all(), [
            'file_xls'                      => ['required', 'max:2000', 'mimes:xls,xlsx'],
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(request('file_xls')){
            $bannerFileNameWithExtension        = request('file_xls')->getClientOriginalName();
            $fileNameToStore                    = date('Ymd_His') . '_' . $bannerFileNameWithExtension;
            $path                               = request('file_xls')->storeAs('public/uploads', $fileNameToStore);

            /// Accessing the uploaded excel file
            try{
                $excelFileToProcess                 = Importer::make('Excel');
                $excelFileToProcess->load('storage/uploads/'.$fileNameToStore);     //Check your projects file structure, you will find your uploaded files here

                $tempCollection                     = $excelFileToProcess->getCollection();

                /// Our test excel file has 4 columns. If number of columns do not match, we know data in not in expected format and so, we do not proceed
                if(sizeof($tempCollection[1]) == 4){        /// Sikkping row 0 as it is the heading in the sheet
                    for($row=1; $row<sizeof($tempCollection); $row++){
                        dump($tempCollection[$row]);
                    }
                    dd('data');
                }
                else{
                    return redirect()->back()->with(['error'=>'Data not in expected format.']);
                }

            }
            catch(\Exception $ex){
                return redirect()->back()->with(['error'=>$ex->getMessage()]);
            }


        }
        return redirect()->back()->with(['success'=>'File uploaded successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExcelData  $excelData
     * @return \Illuminate\Http\Response
     */
    public function show(ExcelData $excelData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExcelData  $excelData
     * @return \Illuminate\Http\Response
     */
    public function edit(ExcelData $excelData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExcelData  $excelData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExcelData $excelData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExcelData  $excelData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExcelData $excelData)
    {
        //
    }
}
