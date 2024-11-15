<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $name
 */
class RoleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        //$roleId = $this->route('role');
        $roleId = $this->route('role')?->id;

        return [
            'name' => 'required|max:100|unique:roles,name,' . $roleId,
            'permissions' => 'required|array|min:1',
            'permissions.*' => 'string|exists:permissions,name',
        ];
    }
}