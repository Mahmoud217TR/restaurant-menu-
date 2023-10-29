<?php

namespace App\Http\Requests\Discount;

use App\Enums\DiscountableType;
use App\Models\Contracts\Discountable;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class AssignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'discountable_type' => ['bail', 'required', new EnumValue(DiscountableType::class)],
            'discountable_id' => 'required',
            'percentage' => 'required|numeric|min:0|max:100',
        ];
    }

    public function getDiscountable(): Discountable
    {
        return $this->getDiscountableModel()::findOrFail($this->discountable_id);
    }

    public function getDiscountableModel(): string
    {
        return DiscountableType::fromValue($this->discountable_type)->getModelClass();
    }
}
