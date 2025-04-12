<?php

namespace App\Bases\Trait;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Model;

trait FileHandle
{
    public function prepareImage(array $data, ?Model $model = null, string $imageKey): ?string
    {
        return  array_key_exists($imageKey, $data)
            ? imageHandle($data, $imageKey, $model, strtolower(class_basename($this->model)))
            : null;
    }
    public function prepareMultiImages(array $data, ?Model $model = null, $oldImages = null, string $mutliImageKey, string $morphableType = null, int $morphableId = null): mixed
    {
        return (array_key_exists($mutliImageKey, $data) || !empty($oldImages))
            ? mutliImageHandle(
                request: $data,
                name: $mutliImageKey,
                oldImages: $oldImages,
                model: $model,
                folder: strtolower(class_basename($this->model)),
                morphableType: $morphableType,
                morphableId: $morphableId,
            )
            : null;
    }
    public function prepareFile(array $data, ?Model $model = null, string $fileKey): ?string
    {
        return  array_key_exists($fileKey, $data)
            ? fileHandle($data, $fileKey, $model, strtolower(class_basename($this->model)))
            : null;
    }


    public function removeImage($row): void
    {
        foreach ($this->imageKeys as $imageKey) {
            $image = hasImage($row, $imageKey);
            if ($image) deleteImage($image);
        }
    }
    public function removeFile($row): void
    {
        $file = hasFile($row, $this->fileKey);
        if ($file) deleteFile($file);
    }
}
