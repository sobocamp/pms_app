<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    //Mendefinisikan properti
    public $status;
    public $message;
    public $resource;

    /**
     * Membuat konstruktor baru untuk menyimpan status, pesan, dan sumber daya.
     *
     * @return array<string, mixed>
     */
    public function __construct($status = 200, $message = 'success', $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        if ($this->resource) {
            return [
                'status' => $this->status,
                'message' => $this->message,
                'data' => $this->resource
            ];
        } else {
            return [
                'status' => $this->status,
                'message' => $this->message
            ];
        }
    }
}
