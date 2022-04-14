<?php
namespace App\Services\report;

use App\Repositories\Contracts\IReportRepository;
use App\Services\Contracts\IReportService;
use Illuminate\Support\Facades\Hash;

class ReportService implements IReportService
{

    protected $reportRepository;

    public function __construct
    (
        IReportRepository $reportRepository
    ) {
       $this->reportRepository = $reportRepository;
    }

    public function list()
    {
        $data = $this->reportRepository->list();
        return $data;
    }


    public function add(string $title, string $category, string $description, int $user_id)
    {
        $description =   Hash::make($description);
        $data = $this->reportRepository->add($title, $category, $description, $user_id);
        return $data;
    }


    public function listBy(int $id)
    {
        $data = $this->reportRepository->listBy($id);
        return $data;
    }

    public function edit(int $id, string $title, string $category, string $description, int $user_id)
    {
        $description =   Hash::make($description);
        $data = $this->reportRepository->edit($id,$title, $category, $description, $user_id);
        return $data;
    }

    public function delete(int $id)
    {
        $data = $this->reportRepository->delete($id);
        return $data;
    }

}
