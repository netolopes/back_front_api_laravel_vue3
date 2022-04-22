<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ReportResource;
use App\Http\Requests\ReportRequest;
use App\Services\Contracts\IReportService;
use App\Models\Report;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{

    protected $reportService;

    public function __construct
    (
        IReportService $reportService
    )
    {

        $this->reportService = $reportService;
    }


    public function index(Request $request)
    {
        $data = (object)$request->only([
            'page',
            'search'
        ]);

         try{

             $data = $this->reportService->list($data);
            // return ReportResource::collection($data);
            return $data;
         } catch (\Exception $e) {
             return response()->json(
                 [
                     'success' => false,
                     'error' => $e->getMessage()
                 ],
                 403
             );
         }
    }


    public function store(ReportRequest $request)
    {

        try{
         //   DB::beginTransaction();

            $data = (object)$request->only([
                'title',
                'category',
                'description' ,
                'user_id'
            ]);


            $data = $this->reportService->add($data->title,$data->category,$data->description,$data->user_id);

      //      DB::commit();

            return $data;

        } catch (\Exception $e) {
        //    DB::rollBack();
        //    Log::error($e);

            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }

    }


    public function show($id)
    {

        try{

            $data = $this->reportService->listBy($id);
           // return new ReportResource($data);
           return $data;

        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }
    }


    public function update(ReportRequest $request)
    {

        try{

            $data = (object)$request->only([
                'id',
                'title',
                'description',
                'category' ,
                'user_id'
            ]);

            $data = $this->reportService->edit($data->id,$data->title,$data->category,$data->description,$data->user_id);
            return $data;

        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }

    }

    public function destroy($id)
    {
        try{

            $data = $this->reportService->delete($id);
            return $data;

        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'error' => $e->getMessage()
                ],
                403
            );
        }
    }

}
