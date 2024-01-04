<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    public function __Construct(protected ApiClient $client)
    {
        //
    }
    public function subscribe(string $email, string $lists = null)
    {
        // ??= null coalescing assignment operator
        // if $lists is null then make it equal the value you give
        $lists ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($lists, [
            "email_address" => $email,
            "status" => 'subscribed'
        ]);
    }
}
