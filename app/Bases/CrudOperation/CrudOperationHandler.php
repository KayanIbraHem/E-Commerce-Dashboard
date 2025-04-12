<?php

namespace App\Bases\CrudOperation;

use App\Bases\Trait\FileHandle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



abstract class CrudOperationHandler
{
    use FileHandle;

    protected string $model;
    protected array $imageKeys = [];
    protected string $multiImagesKey = "";
    protected string $fileKey = "";
    protected bool $hasTranslatedColumns = false;
    protected bool $hasPaginate = true;
    protected array $translatedColumns = [];

    public function setTranslatedColumns(array $columns): void
    {
        $this->translatedColumns = $columns;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }
    public function setHasTranslatedColumns(bool $hasTranslatedColumns): void
    {
        $this->hasTranslatedColumns = $hasTranslatedColumns;
    }
    public function setHasPaginate(bool $hasPaginate): void
    {
        $this->hasPaginate = $hasPaginate;
    }

    abstract protected function store(array|object $data): Model;

    abstract protected function update(array|object $data, int $id): Model;

    abstract protected function delete(int $id): bool;

    public function paginate(): LengthAwarePaginator|Collection
    {
        return $this->preparePaginate();
    }
    private function preparePaginate(): LengthAwarePaginator|Collection
    {
        return $this->hasPaginate
            ? $this->applyPerOrganization($this->model)->paginate(5)
            : $this->applyPerOrganization($this->model)->get();
    }
    private  function applyPerOrganization($model)
    {
        $model = reflectionClass($model);

        if (method_exists($model, 'scopePerOrganization')) {
            $model = $model->perOrganization();
        }
        return $model;
    }
    protected function dataHandle(array|object $dataRequest, ?Model $model = null): array
    {
        $data = $this->prepareColumns($dataRequest);
        $image = $this->handleImages($dataRequest, $model);
        $file = $this->prepareFile($dataRequest, $model, $this->fileKey);
        // if ($file) $data[$this->fileKey] = $file;

        return array_merge($data, $image);
    }
    protected function prepareColumns(array|object $data): array
    {
        if ($this->hasTranslatedColumns) {
            $nonTranslatedData = array_diff_key((is_array($data) ? $data : (array)$data), array_flip($this->getTranslatedColumnKeys()));
            $translatedData = $this->prepareData($data);
            return array_merge($nonTranslatedData, $translatedData);
        }

        return $data;
    }
    protected function prepareData(array|object $dataRequest): array
    {
        $data = [];

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            foreach ($this->translatedColumns as $column) {
                // $data[$localeCode][$column] = $dataRequest[$column . '_' . $localeCode];
                $key = $column . '_' . $localeCode;
                if (isset($dataRequest[$key])) {
                    $data[$localeCode][$column] = $dataRequest[$key];
                }
            }
        }

        return $data;
    }
    private function getTranslatedColumnKeys(): array
    {
        $keys = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            foreach ($this->translatedColumns as $column) {
                $keys[] = $column . '_' . $localeCode;
            }
        }

        return $keys;
    }
    protected function handleFile(array|object $dataRequest, ?Model $model): array
    {
        $file = $this->prepareFile($dataRequest, $model, $this->fileKey);
        if ($file) {
            $data[$this->fileKey] = $file;
        }

        return $data ?? [];
    }
    protected function handleImages(array|object $dataRequest, ?Model $model): array
    {
        $data = [];
        foreach ($this->imageKeys as $imageKey) {
            $image = $this->prepareImage($dataRequest, $model, $imageKey);
            if ($image) {
                $data[$imageKey] = $image;
            }
        }

        return $data;
    }
    protected function handleMultiImages(array $dataRequest, ?Model $model, $oldImages = null, string $morphableType = null, int $morphableId = null)
    {
        $images = $this->prepareMultiImages(
            data: $dataRequest,
            model: $model,
            oldImages: $oldImages,
            mutliImageKey: $this->multiImagesKey,
            morphableType: $morphableType,
            morphableId: $morphableId
        );
        return $images ? $images : [];
    }
}
