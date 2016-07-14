<?php

namespace CodeDelivery\Presenters;

use CodeDelivery\Transformers\HotelTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ClientPresenter
 *
 * @package namespace CodeDelivery\Presenters;
 */
class HotelPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new HotelTransformer();
    }
}
