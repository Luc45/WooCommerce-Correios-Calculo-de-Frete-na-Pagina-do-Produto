<?php

namespace CFPP\Exceptions;

class CFPPException extends \Exception
{
    /**
     * Generate the base code for each supported class
     *
     * @param $class_name
     * @return int
     */
    protected static function generateCode($class_name)
    {
        switch ($class_name) {
            case 'CostsException':                      return 100; break;
            case 'FactoryException':                    return 200; break;
            case 'HandlerException':                    return 300; break;
            case 'MinimumRequirementNotMetException':   return 400; break;
            case 'PackageException':                    return 500; break;
            case 'PayloadException':                    return 600; break;
            case 'ShippingCalculatorException':         return 700; break;
            case 'ShippingMethodsException':            return 800; break;
            case 'ShippingZoneException':               return 900; break;
            case 'ValidationErrorException':            return 1000; break;
            default:
                error_log('Undefined exception code for class ' . $class_name);
                return 0;
                break;
        }
    }
}