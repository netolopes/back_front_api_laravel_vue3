<?php
namespace App\Repositories\report;

use App\Models\Report;
use App\Repositories\Contracts\IReportRepository;


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

    public function list()
    {
        return $this->report::paginate(10);
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
        $data =  $this->report::findOrFail($id);
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
