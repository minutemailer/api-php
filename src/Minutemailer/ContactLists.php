<?php

namespace Minutemailer;

class ContactLists extends RestAPI
{
    public $endpoint = 'contactlists';

    public function subscribe($data)
    {
        $this->segment = 'subscribe';
        $response = $this->post($data);

        return $response;
    }
}
