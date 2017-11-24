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
     *
     * @var BaseValidator
     */
    protected $validator;

    /**
     * Model errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Model data
     *
     * @var array
     */
    protected $data = [];

    /**
     * Model messages
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Exclude from transforms
     * @var array
     */
    protected $excludeTransforms = ['updated_at', 'created_at', 'deleted_at', 'relevance'];


    /**
     * Default hidden attributes
     * This attribute will be excluded from JSON
     * @var array
     */
    protected $hidden = ['password','pivot'];


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
     * Returns errors in line from array of errors
     *
     * @return string
     */
    public function getErrorsInLine()
    {
        $message = '';
        foreach($this->errors as $error){
            if (is_array($error)){
                foreach($error as $errorMessage){
                    $message .= $errorMessage.' ';
                }
                continue;
            }
            $message .= $error.' ';
        }

        return $message;
    }



    /**
     * Check if column is transformable.
     * For this we check $excludeTransforms list. If it is presented there - then it's not transformable. By default - all fields transforms at API
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
    public function validate(array $data, $type = 'create')
    {
        if ($this->validator == null)
        {
          //attempt to create new validator and validate.
          $validator = Validator::make($data, $this->rules[$type], $this->messages);
          $this->data = $data;
            if (!$result = $validator->passes())
            {
                $this->errors = $validator->messages()->getMessages();
            }
            return $result;
        }
        $validationResult = $this->validator->validate($data, $type);
        
        if (! $validationResult)
        {
            $this->errors = $this->validator->errors()->getMessages();
        }
        return $validationResult;
    }
}