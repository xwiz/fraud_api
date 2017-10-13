<?php 

namespace App\Api\Models;

use Validator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * Every model should extend this model and not Eloquent
 *
 * @package Api\Models
 */

class BaseModel extends Model
{
    /**
     * Model validator
     */

    protected $validator;

    protected $errors = [];


    /**
     * Exclude from transforms
     * @var array
     */
    protected $excludeTransforms = ['updated_at', 'created_at', 'deleted_at'];


    /**
     * Default hidden attributes
     * This attribute will be excluded from JSON
     */
    protected $hidden = 'password';


    /**
     * Returns errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }


    /**
     * Check if column is transformable.
     * For this we check $excludeTransforms list. If it presented there - then it's not transformable. By default - all fields transforms at API
     * @param $key
     * @return bool
     */
    public function isTransformable($key){
        return array_search($key, $this->excludeTransforms) === false;
    }


    /**
     * Validates provided data for model
     *
     * @param array $data
     * @param string $type
     *
     * @throws Exception
     *
     * @return bool
     */
    public function validate(array $data,array $rules, $type = 'create'){

    	$this->validator = Validator::make($data, $rules[$type]);

    	$validationResult = $this->validator->passes();
        if (!$validationResult)
        {
            $this->errors = $this->validator->messages();
        }

        // return $this->validator;
        return $validationResult;
    }
}