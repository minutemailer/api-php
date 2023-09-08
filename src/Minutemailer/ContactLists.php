<?php

namespace Minutemailer;

class ContactLists extends RestAPI
{
    public $endpoint = 'contact-lists';

    /**
     * @deprecated
     * @param mixed $data default null
     * @return ContactLists $this
     */
    public function subscribe($data = null)
    {
        $this->deprecated(__METHOD__, 'Contacts->create');

        return $this;
    }

    /**
     * @param int $limit default 10
     * @param int $page default 1
     * @param int $with_contacts_count 0|1 default 1
     * @param string $query
     * @param string[] $include_lists default []
     * @return mixed
     */
    public function getContactlists($limit = 10, $page = 1, $with_contacts_count = 1, $query = '', array $include_lists = array())
    {
        $data = array(
            'limit' => $limit,
            'page' => $page,
            'with_contacts_count' => $with_contacts_count,
        );
        if ($query != null) $data['query'] = $query;
        if (count($include_lists)) $data['include_lists'] = implode(',', $include_lists);
        $response = $this->get($data);

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

    /**
     * @param string[] $contact_lists
     * @return mixed
     */
    public function batchDelete($contact_lists)
    {
        $data = array(
            'contact_lists' => $contact_lists,
        );
        $this->segment = 'batch';
        $response = $this->delete($data);

        return $response;
    }

    /**
     * @param string $name
     * @param  array $metadata
     * @return mixed
     */
    public function create($name, array $metadata = array())
    {
        $data = array(
            'name' => $name,
            'metadata' => $metadata,
        );
        $response = $this->post($data);

        return $response;
    }

    /**
     * @param mixed $data
     */
    public function update($data)
    {
        $response = $this->put($data);

        return $response;
    }

    /**
     * @param string $contact_uuid
     * @return mixed
     */
    public function addContact($contact_uuid)
    {
        $this->segment = 'add-contact/' . $contact_uuid;
        $response = $this->put();

        return $response;
    }

    /**
     * @param string $contact_uuid
     * @param  mixed $data
     * @return mixed
     */
    public function updateContact($contact_uuid, $data)
    {
        $this->segment = 'contacts/' . $contact_uuid;
        $response = $this->put($data);

        return $response;
    }

    /**
     * @param string $contact_uuid
     * @return mixed
     */
    public function removeContact($contact_uuid)
    {
        $this->segment = 'remove-contact/' . $contact_uuid;
        $response = $this->put();

        return $response;
    }

    /**
     * @param string[] $contacts contact UUID<string>
     */
    public function batchAddContact($contacts)
    {
        $this->segment = 'batch-add-contacts';
        $response = $this->put(array('contacts' => $contacts));

        return $response;
    }

    /**
     * @param string[] $contacts contact UUID<string>
     */
    public function batchRemoveContact($contacts)
    {
        $this->segment = 'batch-remove-contacts';
        $response = $this->put(array('contacts' => $contacts));

        return $response;
    }
}
