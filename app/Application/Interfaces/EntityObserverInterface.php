<?php

namespace App\Application\Interfaces;

interface EntityObserverInterface
{
    public function created(object $entity);

    public function updated(object $old, object $new);

    public function deleted(object $entity);
}
