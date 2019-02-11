<?php
/**
 * Created by PhpStorm.
 * User: Saurav KC
 */

namespace App\Modules\Authentication\User\Requests;

use App\Modules\Framework\Request;

class UpdateUserRequest extends Request
{

    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}