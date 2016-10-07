<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;

class Acl
{
    /**
     * @var AclRule[]
     */
    private $rules = [];

    /**
     * @param AclRule $rule
     */
    public function addRule(AclRule $rule)
    {
        $this->rules[] = $rule;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function complies(Request $request): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule->complies($request)) {
                return false;
            }
        }
        return true;
    }
}
