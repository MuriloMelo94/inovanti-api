<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $formatter = new NumberFormatter('pt_BR', NumberFormatter::CURRENCY);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price ? [
                'original' => $this->price,
                'formatted' => $formatter->formatCurrency($this->price, 'BRL'),
            ] : null,
            'quantity' => $this->quantity,
            'status' => $this->status ? __('message.avaiable') : __('message.not_avaiable'),
        ];
    }
}
