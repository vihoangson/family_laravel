<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Celebration;

/**
 * Class CelebrationTransformer.
 *
 * @package namespace App\Transformers;
 */
class CelebrationTransformer extends TransformerAbstract
{
    /**
     * Transform the Celebration entity.
     *
     * @param \App\Models\Celebration $model
     *
     * @return array
     */
    public function transform(Celebration $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
