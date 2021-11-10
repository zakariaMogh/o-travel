<?php

namespace App\Repositories;

use App\Models\Report;

class ReportRepository extends BaseRepositories implements \App\Contracts\ReportContract
{

    /**
     * @param Report $model
     * @param array $filters
     */
    public function __construct(Report $model, array $filters = [
        \App\QueryFilter\Search::class,
    ])
    {
        parent::__construct($model, $filters);
    }


    /**
     * @inheritDoc
     */
    public function new(array $data)
    {
        return $this->model::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $report = $this->findOneById($id);

        $report->update($data);

        return $report;
    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        return Report::destroy($id);
    }


}
