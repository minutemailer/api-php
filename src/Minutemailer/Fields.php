<?php

namespace Minutemailer;

class Fields extends RestAPI
{
    /**
     * @var string
     */
    public $endpoint = 'fields';

    /**
     * @param  string $fieldId
     * @return mixed
     */
    public function remove($fieldId)
    {
        $this->id = $fieldId;
        $response = $this->delete();

        return $response;
    }

    /**
     * @param  string $fieldId UUID
     * @return mixed
     */
    public function show($fieldId)
    {
        $this->id = $fieldId;
        $response = $this->get();

        return $response;
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    public function create($data)
    {
        $response = $this->post($data);

        return $response;
    }

    /**
     * @param  string $fieldId UUID
     * @param  array  $data
     * @return mixed
     */
    public function update($fieldId, $data)
    {
        $this->id = $fieldId;
        $response = $this->put($data);

        return $response;
    }

    /**
     * @param  int[]  $data UUID<string:int>
     * @return mixed
     */
    public function reorder($data)
    {
        $this->id = __METHOD__;
        $response = $this->put($data);

        return $response;
    }


}