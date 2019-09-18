<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Plant;

/**
 * Class PlantTransformer.
 *
 * @package namespace App\Transformers;
 */
class PlantTransformer extends TransformerAbstract
{
    /**
     * Transform the Plant entity.
     *
     * @param \App\Entities\Plant $model
     *
     * @return array
     */
    public function transform(Plant $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
