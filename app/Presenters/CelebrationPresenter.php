<?php

namespace App\Presenters;

use App\Transformers\CelebrationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CelebrationPresenter.
 *
 * @package namespace App\Presenters;
 */
class CelebrationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CelebrationTransformer();
    }
}
