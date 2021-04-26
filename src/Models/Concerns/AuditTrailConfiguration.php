<?php

namespace Aedart\Audit\Models\Concerns;

use Aedart\Support\Helpers\Config\ConfigTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Concerns Audit Trail Configuration
 *
 * @author Alin Eugen Deac <ade@rspsystems.com>
 * @package Aedart\Audit\Models\Concerns
 */
trait AuditTrailConfiguration
{
    use ConfigTrait;

    /**
     * Returns Audit Trail model class path
     *
     * @return string
     */
    public function auditTrailModel(): string
    {
        return $this->getConfig()->get('audit-trail.models.audit_trail');
    }

    /**
     * Returns Audit Trail model instance
     *
     * @return \Aedart\Audit\Models\AuditTrail
     */
    public function auditTrailModelInstance()
    {
        return $this->auditTrailModel()::make();
    }

    /**
     * Returns Application User Model class path
     *
     * @return string
     */
    public function auditTrailUserModel(): string
    {
        return $this->getConfig()->get('audit-trail.models.user');
    }

    /**
     * Returns Application User Model instance
     *
     * Warning: Method does NOT return current authenticated user;
     * it only returns an empty user model instance!
     *
     * @return Model|Authenticatable
     */
    public function auditTrailUserModelInstance()
    {
        // NOTE: We cannot rely on the "make()" method being available
        // for the user model. So we create a new instance the old
        // fashion way...
        $class = $this->auditTrailUserModel();
        return new $class();
    }

    /**
     * Returns table name of the audit trail(s) table
     *
     * @return string
     */
    public function auditTrailTable(): string
    {
        return $this->getConfig()->get('audit-trail.table');
    }
}