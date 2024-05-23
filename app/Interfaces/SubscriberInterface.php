<?php

namespace App\Interfaces;

interface SubscriberInterface
{
    public function CreateSubscriber($request);
    public function UpdateSubscriber($request ,$subscriber_id);
    public function DeleteSubscriber($subscriber_id);
    public function SearchByNameSubcriber($request);
    public function SearchAdvancedSubcriber($request);



}
