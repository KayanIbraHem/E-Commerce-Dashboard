<?php

namespace App\Services\Dashboard\Category;

use App\Models\Permission\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Bases\CrudOperation\CrudOperationBase;

class CategoryService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Category\\Category';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
    protected array $imageKeys = ["image"];

    public function store($dataRequest): Model
    {
        $categoryData = $this->prepareData($dataRequest);
        $categoryData['id_category'] = $dataRequest['id_category'];
        $image = $this->handleImages($dataRequest->toArray(), null);
        $data = array_merge($categoryData, $image);
        $category = $this->model::create($data);
        if (isset($dataRequest['sections'])) {
            foreach ($dataRequest['sections'] as $section) {
                $categorySectionData = $this->prepareData($section);
                $category->sections()->create($categorySectionData);
            }
        }

        return $category;
    }
    public function update($dataRequest, int $id): Model
    {
        $row =  $this->getRowById($id);
        $categoryData = $this->prepareData($dataRequest);
        $categoryData['id_category'] = $dataRequest['id_category'];
        $image = $this->handleImages($dataRequest->toArray(), $row);
        $data = array_merge($categoryData, $image);

        $row->update($data);
        if (isset($dataRequest['sections'])) {
            $row->sections()->delete();
            foreach ($dataRequest['sections'] as $detail) {
                $categorySectionData = $this->prepareData($detail);
                $row->sections()->create($categorySectionData);
            }
        }

        return $row;
    }
}
