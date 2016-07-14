<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Hotel;

/**
 * Class ClientTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class HotelTransformer extends TransformerAbstract
{
    protected $skipPresenter = true;
    /**
     * Transform the \Client entity
     * @param \Client $model
     *
     * @return array
     */
    public function transform(Hotel $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'latitude' => $model->latitude,
            'longitude' => $model->longitude
        ];
    }
    
    
}
