<?php

namespace App\Services\Office;

use App\Repositories\Office\OfficeRepository;

class OfficeService {

    protected $officeRepository;

    public function __construct(OfficeRepository $_officeRepository)
    {
        $this->officeRepository = $_officeRepository;
    }


}
