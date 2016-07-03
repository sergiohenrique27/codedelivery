<?php

namespace CodeDelivery\Presenters;

use CodeDelivery\Transformers\GuestTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GuestPresenter
 *
 * @package namespace CodeDelivery\Presenters;
 */
class GuestPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GuestTransformer();
    }
}
