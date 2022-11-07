<?php

namespace App\Misc;

use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Spatie\Multitenancy\Models\Tenant;

class MyTenantFinder extends TenantFinder
{
    use UsesTenantModel;

    /**
     * This tenant finder is the type that determines the tenant from the segments of the URL. E.g https://domain.com/tenant-domain/home
     * @param Request $request
     * @return Tenant|null
     */
    public function findForRequest(Request $request): ?Tenant
    {
        /*
         * // Use this if you want to use subdomain approach
         $host = $request->getHost();
         return $this->getTenantModel()::whereDomain($host)->first();
        */
        $domain = \Illuminate\Support\Facades\Request::segment(1);

        if ($domain) {
            return $this->getTenantModel()::whereDomain($domain)->first();
        }

        return null;
    }
}
