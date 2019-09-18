<?php

namespace App\Presenters;

use App\Transformers\PlantTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PlantPresenter.
 *
 * @package namespace App\Presenters;
 */
class PlantPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PlantTransformer();
    }
}
