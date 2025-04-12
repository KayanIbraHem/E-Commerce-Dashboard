<?php

namespace App\Services\Dashboard\Permisssion;

use App\Bases\CrudOperation\CrudOperationBase;
use App\Models\Permission\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Permission\\Permission';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
    public function store($dataRequest): Model
    {
        $permissionData = $this->prepareData($dataRequest);
        $permission = $this->model::create($permissionData);
        if (isset($dataRequest['details'])) {
            foreach ($dataRequest['details'] as $detail) {
                $permissionDetailsData = $this->prepareData($detail);
                $permission->details()->create($permissionDetailsData);
            }
        }

        return $permission;
    }
    public function update($dataRequest, int $id): Model
    {
        $row =  $this->getRowById($id);
        $data = $this->prepareData($dataRequest);
        $row->update($data);
        if (isset($dataRequest['details'])) {
            $row->details()->delete();
            foreach ($dataRequest['details'] as  $detail) {
                $permissionDetailsData = $this->prepareData($detail);
                $row->details()->create($permissionDetailsData);
            }
        }

        return $row;
    }
}
