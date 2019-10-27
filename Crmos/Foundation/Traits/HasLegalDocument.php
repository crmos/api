<?php

namespace Crmos\Foundation\Traits;

use Crmos\Foundation\Models\LegalDocument;

trait HasLegalDocument
{
    public function legalDocuments()
    {
        return $this->morphMany(LegalDocument::class, 'hasLegalDocuments', 'entity_type', 'entity_id');
    }
}
