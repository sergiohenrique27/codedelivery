<?php

namespace CodeDelivery\Presenters;

use CodeDelivery\Transformers\CheckinTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CheckinPresenter
 *
 * @package namespace CodeDelivery\Presenters;
 */
class CheckinPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CheckinTransformer();
    }
}
