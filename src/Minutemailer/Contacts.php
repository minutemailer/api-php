<?php

namespace Minutemailer;

class Contacts extends RestAPI
{
    /**
     * @var string
     */
    public $endpoint = 'contacts';

    /**
     * @param int $limit default 10
     * @param int $page default 1
     * @param \DateTimeInterface|null $since default null
     * @param string[] $fields default []
     * @return mixed
     */
    public function get($limit = 10, $page = 1, $since = null, array $fields = array())
    {
        $data = array(
            'limit' => $limit,
            'page' => $page,
        );
        if ($since instanceof \DateTimeInterface) $data['since'] = $since->format('Y-m-d');
        if (count($fields) > 0) $data['fields'] = implode(',', $fields);
        $response = parent::get($data);

        return $response;
    }

    /**
     * @param string[] $contactIds UUID<string>
     * @param string[] $fields
     */
    public function batchShow(array $contactIds, array $fields)
    {
        $data = array(
            'contacts' => $contactIds,
            'fields' => $fields,
        );
        $this->id = 'batch-show';
        $response = $this->getWithBody($data);

        return $response;
    }

    /**
     * @param string[] $contactIds UUID<string>
     * @return mixed
     */
    public function batchDelete(array $contactIds)
    {
        $data = array(
            'contacts' => $contactIds,
        );
        $this->id = 'batch';
        $this->delete($data);
    }

    /**
     * @param string[] $contactIds UUID<string>
     * @param string $origin UUID
     * @param string $destination UUID
     * @return mixed
     */
    public function batchMove(array $contactIds, $origin, $destination)
    {
        $data = array(
            'contacts' => $contactIds,
            'origin' => $origin,
            'destination' => $destination,
        );
        $this->id = 'batch-move';
        $response = $this->put($data);

        return $response;
    }

    /**
     * @param string $email
     * @param  array $fields
     * @param string[] $contactListIds UUID<string>
     * @return mixed
     */
    public function create($email, array $fields, $contactListIds)
    {
        $data = array(
            'email' => $email,
            'status' => 1,
            'contact_lists' => $contactListIds,
        );
        // Elevate top-level fields
        if (isset($fields['email'])) unset($fields['email']);
        if (isset($fields['status'])) unset($fields['status']);
        if (isset($fields['contact_lists'])) unset($fields['contact_lists']);
        foreach (['first_name', 'last_name', 'phone', 'address', 'postal_code', 'city', 'note'] as $key) {
            if (!empty($fields[$key])) {
                $data[$key] = $fields[$key];
                unset($fields[$key]);
            }
        }
        if (count($fields) > 0) {
            $data['fields'] = $fields;
        }

        $response = $this->post($data);
        return $response;
        
    }

    /**
     * @param  array $fields
     * @return mixed
     */
    public function update(array $fields)
    {
        $data = array();
        // Elevate top-level fields
        foreach (['email', 'first_name', 'last_name', 'phone', 'address', 'postal_code', 'city', 'note', 'status'] as $key) {
            if (!empty($fields[$key])) {
                $data[$key] = $fields[$key];
                unset($fields[$key]);
            }
        }
        $data['fields'] = $fields;
        $response = $this->put($data);

        return $response;
    }

    /**
     * @param  array $data
     * @return mixed
     */
    public function unsubscribe()
    {
        $this->segment = __METHOD__;
        $response = $this->put();

        return $response;
    }

    /**
     * @return mixed
     */
    public function options()
    {
        $response = $this->get();

        return $response;
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $response = $this->get();

        return $response;
    }

}