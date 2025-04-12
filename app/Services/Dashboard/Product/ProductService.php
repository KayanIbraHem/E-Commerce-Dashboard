<?php

namespace App\Services\Dashboard\Product;


use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Bases\CrudOperation\CrudOperationBase;
use App\Services\Dashboard\Product\Factory\PriceCalculator;

class ProductService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Product\\Product\\Product';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title', 'description'];
    protected array $imageKeys = ["main_image"];
    protected string $fileKey = "video";
    protected string $multiImagesKey = "images";
    public function __construct(protected PriceCalculator $priceCalculator) {}
    public function store($dataRequest): Model
    {
        DB::beginTransaction();
        try {
            $productData = $this->prepareData($dataRequest);
            $productData['category_id'] = $dataRequest['category_id'];
            $productData['discount_type'] = array_key_exists('discount_type', $dataRequest->toArray()) ? $dataRequest['discount_type'] : 0;
            $productData['quantity'] = $dataRequest['quantity'];
            $productData['discount_value'] = array_key_exists('discount_value', $dataRequest->toArray()) ? $dataRequest['discount_value'] : 0;
            $productData['price'] = array_key_exists('price', $dataRequest->toArray()) ? $dataRequest['price'] : 0;
            $productData['price_after_discount'] = $this->priceCalculator->calculatePrice($productData['price'], $productData['discount_type'], $productData['discount_value']);
            $mainImage = $this->handleImages($dataRequest->toArray(), null);
            $file = $this->handleFile($dataRequest->toArray(), null);
            $data = array_merge($productData, $mainImage, $file);
            $product = $this->model::create($data);
            $images = $this->handleMultiImages($dataRequest->toArray(), null, $this->model, $product->id);
            $product->images()->createMany($images);

            if (isset($dataRequest['product_features'])) {
                foreach ($dataRequest['product_features'] as $feature) {
                    $productAdvantages = $feature['product_advantages'] ?? [];
                    unset($feature['product_advantages']);
                    $productFeatureData = $this->prepareData($feature);
                    $productFeature = $product->features()->create($productFeatureData);

                    if (isset($productAdvantages)) {
                        foreach ($productAdvantages as $advantage) {
                            $productAdvantageData = $this->prepareData($advantage);
                            $productAdvantageData['price'] = $advantage['price'];
                            $productFeature->advantages()->create($productAdvantageData);
                        }
                    }
                }
            }
            DB::commit();
            return $product;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception(__('message.failed_create_product'), 500);
        }
    }
    public function update($dataRequest, int $id): Model
    {
        DB::beginTransaction();
        try {
            $row =  $this->getRowById($id);
            $productData = $this->prepareData($dataRequest);
            $productData['category_id'] = $dataRequest['category_id'];
            $productData['discount_type'] = array_key_exists('discount_type', $dataRequest->toArray()) ? $dataRequest['discount_type'] : 0;
            $productData['quantity'] = $dataRequest['quantity'];
            $productData['discount_value'] = array_key_exists('discount_value', $dataRequest->toArray()) ? $dataRequest['discount_value'] : 0;
            $productData['price'] = array_key_exists('price', $dataRequest->toArray()) ? $dataRequest['price'] : 0;
            $productData['price_after_discount'] = $this->priceCalculator->calculatePrice($productData['price'], $productData['discount_type'], $productData['discount_value']);
            $mainImage = $this->handleImages($dataRequest->toArray(), $row);
            $file = $this->handleFile($dataRequest->toArray(), $row);
            $data = array_merge($productData, $mainImage, $file);

            $row->update($data);

            $images = $this->handleMultiImages($dataRequest->toArray(), $row, $dataRequest['old_images'], $this->model, $row->id);
            $row->images()->createMany($images);

            if (isset($dataRequest['product_features'])) {
                $requestFeatureIds = array_column($dataRequest['product_features'], 'id');
                foreach ($dataRequest['product_features'] as  $feature) {
                    $productAdvantages = $feature['product_advantages'] ?? [];
                    unset($feature['product_advantages']);

                    $featureId = $feature['id'] ?? null;
                    $productFeatureData = $this->prepareData($feature);

                    if ($featureId && in_array($featureId, $requestFeatureIds)) {
                        $featureRow = $row->features()->updateOrCreate(
                            ['id' => $featureId],
                            $productFeatureData
                        );
                    } else {
                        $featureRow =  $row->features()->create($productFeatureData);
                    }

                    if (isset($productAdvantages)) {

                        $requestAdvantageIds = array_column($productAdvantages, 'id');

                        foreach ($productAdvantages as $advantage) {
                            $advantageId = $advantage['id'] ?? null;
                            $productAdvantageData = $this->prepareData($advantage);
                            $productAdvantageData['price'] = $advantage['price'];

                            if ($advantageId && in_array($advantageId, $requestAdvantageIds)) {
                                $featureRow->advantages()->updateOrCreate(
                                    ['id' => $advantageId],
                                    $productAdvantageData
                                );
                            } else {
                                $featureRow->advantages()->create($productAdvantageData);
                            }
                        }
                    }
                }
            }
            DB::commit();
            return $row;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception(__('message.failed_create_product'), 500);
        }
    }
}
