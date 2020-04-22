<?php
namespace Illuminate\Database\Eloquent\Relations;

class NullRelation extends Relation
{
    public function getResults()
    {
        return null;
    }
}



