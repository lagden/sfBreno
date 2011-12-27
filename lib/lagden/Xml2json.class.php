<?php
define ("DEBUG", false);

// Maximum Recursion Depth that we can allow.
define ("MAX_RECURSION_DEPTH_ALLOWED", 25);

// An empty string
define ("EMPTY_STR", "");

// SimpleXMLElement object property name for attributes
define ("SIMPLE_XML_ELEMENT_OBJECT_PROPERTY_FOR_ATTRIBUTES", "@attributes");

// SimpleXMLElement object name.
define ("SIMPLE_XML_ELEMENT_PHP_CLASS", "SimpleXMLElement");

class xml2json
{
    public static function transformXmlStringToJson($xmlStringContents)
    {
        $simpleXmlElementObject = simplexml_load_string($xmlStringContents);    
        if($simpleXmlElementObject == null)return(EMPTY_STR);

        $simpleXmlRootElementName = $simpleXmlElementObject->getName();
        // Uncomment this line to see the inner details of the SimpleXMLElement object.
        if(DEBUG)
        {
            // var_dump($simpleXmlRootElementName);
            // var_dump($simpleXmlElementObject);
        }

        $jsonOutput = EMPTY_STR;        
        // Let us convert the XML structure into PHP array structure.
        $array1 = static::convertSimpleXmlElementObjectIntoArray($simpleXmlElementObject);

        if(($array1 != null) && (sizeof($array1) > 0))
        {
            $jsonOutput = json_encode($array1);

            if(DEBUG)
            {
                // var_dump($array1);
                // var_dump($jsonOutput);
            }
        }
        return($jsonOutput);                    
    }

    public static function convertSimpleXmlElementObjectIntoArray($simpleXmlElementObject, &$recursionDepth=0)
    {
        if($recursionDepth > MAX_RECURSION_DEPTH_ALLOWED)return(null);
        if($recursionDepth == 0)
        {
            if(get_class($simpleXmlElementObject) != SIMPLE_XML_ELEMENT_PHP_CLASS)
            {
                return(null);
            }
            else
            {
                $callerProvidedSimpleXmlElementObject = $simpleXmlElementObject;
            }
        }

        if(is_object($simpleXmlElementObject))
        {
            if(get_class($simpleXmlElementObject) == SIMPLE_XML_ELEMENT_PHP_CLASS)
            {
                $copyOfsimpleXmlElementObject = $simpleXmlElementObject;
                $simpleXmlElementObject = get_object_vars($simpleXmlElementObject);
            }
        }

        if(is_array($simpleXmlElementObject))
        {
            $resultArray = array();
            if(count($simpleXmlElementObject) <= 0)
            {
                return (trim(strval($copyOfsimpleXmlElementObject)));
            }

            foreach($simpleXmlElementObject as $key=>$value)
            {
                $recursionDepth++;                  
                $resultArray[$key] = static::convertSimpleXmlElementObjectIntoArray($value, $recursionDepth);
                $recursionDepth--;
            }

            if($recursionDepth == 0)
            {
                $tempArray = $resultArray;
                $resultArray = array();
                $resultArray[$callerProvidedSimpleXmlElementObject->getName()] = $tempArray;
            }
            return ($resultArray);

        }
        else
        {
            return (trim(strval($simpleXmlElementObject)));
        }
    }
}