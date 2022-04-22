<?php
namespace App\Repositories\report;

use App\Models\Report;
use App\Repositories\Contracts\IReportRepository;
use Illuminate\Support\Facades\DB;

class ReportRepository  implements IReportRepository
{

    protected $report;
    protected $imlearnServ;

    public function __construct
    (
       Report $report
    ) {
       $this->report = $report;
    }

    public function list($data)
    {

        $result = "";
        if($data->search == ''){
            $result =  $this->report::select(['id','title','category','description','user_id'])->with('users:id,name,email')->paginate(5);
        }else{
            $result = $this->report::select(['id','title','category','description','user_id'])->with('users:id,name,email')
                ->where('title', 'like', '%'.$data->search.'%')
                ->orderBy('id')
                ->cursorPaginate(5);

        }
        return $result;

    }

    public function add(string $title, string $category, string $description, int $user_id)
    {
        $result = $this->report::create([
            'title' => $title,
            'category' => $category,
            'description' => $description,
            'user_id' => $user_id
        ]);

        $data = [
            'title' => $title,
            'category' => $category,
            'description' => $description,
            'user_id' => $user_id
        ];


       return $result;
    }

    public function listBy(int $id)
    {
         $data =  $this->report::select(['id','title','category','description','user_id'])->with('users:id,name,email')->findOrFail($id);
        return $data;
    }

    public function edit(int $id,string $title, string $category, string $description, int $user_id)
    {

           $obj =  $this->report::findOrFail($id);
           $obj->title = $title;
           $obj->category = $category;
           $obj->description = $description;
           $obj->user_id = $user_id;

           if( $obj->save() ){
            return  $obj;
          }
    }

    public function delete(int $id){

        $obj =  $this->report::findOrFail($id);

          if( $obj->delete() ){
           return  $obj;
         }
   }

}
