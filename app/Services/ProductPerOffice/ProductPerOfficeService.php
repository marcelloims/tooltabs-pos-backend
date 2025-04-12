<?php

namespace App\Services\ProductPerOffice;

use App\Repositories\ProductPerOffice\ProductPerOfficeRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductPerOfficeService
{
    protected $productPerOfficeRepository;

    public function __construct(ProductPerOfficeRepository $_productPerOfficeRepository)
    {
        $this->productPerOfficeRepository = $_productPerOfficeRepository;
    }

    public function fetch($request)
    {
        $response   = $this->productPerOfficeRepository->fetch($request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "fetch"
            ];
        }
    }

    public function save($request)
    {
        $validator  = Validator::make($request->all(), [
            'office_id'         => 'required|max:255',
            'product_id'        => 'required|max:255',
            'price'             => 'required|max:255',
            'status'            => 'required|max:255'
        ], [
            'office_id.required' => 'The office field is required',
            'product_id.required' => 'The product field is required',
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->productPerOfficeRepository->save($this->validateData($request), $request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_CREATED,
                "status"    => "success",
                "message"   => "Data has been created"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "insert"
            ];
        }
    }

    public function validateData($request)
    {
        return [
            'office_id'             => $request->office_id,
            'product_id'            => $request->product_id,
            'price'                 => $request->price,
            'service_charge_(%)'    => $request->service_charge,
            'commission_(%)'        => $request->commission,
            'status'                => $request->status
        ];
    }

    public function getData($id)
    {
        $response   = $this->productPerOfficeRepository->getData($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "response"  => $response
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => false,
                "process"   => "getData"
            ];
        }
    }

    public function update($request)
    {
        $validator  = Validator::make($request->all(), [
            'office_id'         => 'required|max:255',
            'product_id'        => 'required|max:255',
            'price'             => 'required|max:255',
            'status'            => 'required|max:255'
        ], [
            'office_id.required' => 'The office field is required',
            'product_id.required' => 'The product field is required',
        ]);

        if ($validator->fails()) {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "validation"
            ];
        }

        $response = $this->productPerOfficeRepository->updated($this->validateData($request), $request);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_CREATED,
                "status"    => "success",
                "message"   => "Data has been updated"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "request"   => $validator->errors(),
                "process"   => "update"
            ];
        }
    }

    public function destory($id)
    {
        $response = $this->productPerOfficeRepository->destroyed($id);

        if ($response == true) {
            return [
                "code"      => Response::HTTP_OK,
                "status"    => "success",
                "message"   => "Your file has been deleted"
            ];
        } else {
            return [
                "code"      => Response::HTTP_BAD_REQUEST,
                "process"   => "delete"
            ];
        }
    }
}
