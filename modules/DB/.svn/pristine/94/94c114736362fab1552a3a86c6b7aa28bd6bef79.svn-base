<?php

/**
 * @name $DBDataTypeSQL
 */
namespace DB\DataType\SQL;

class FieldType
{
	const DTHASH = '7c4d911d185cba488398b5ac6f004307';

	/**
	 * FieldType constructor.
	 * @param array $aData
	 */
	public function __construct(array $aData = array())
	{

		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}
	}

    /**
     * @param array $aData
     * @return FieldType
     */
    public static function create(array $aData = array())
    {
        $oObject = new self($aData);

        return $oObject;
    }

	/**
     * @param array $aValue
     * @return TypeChar
     */
    public static function typeChar($aValue = array())
	{
		$mVar = new TypeChar($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeVarchar
     */
    public static function typeVarchar($aValue = array())
	{
		$mVar = new TypeVarchar($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeBinary
     */
    public static function typeBinary($aValue = array())
	{
		$mVar = new TypeBinary($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeVarbinary
     */
    public static function typeVarbinary($aValue = array())
	{
		$mVar = new TypeVarbinary($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeTinyblob
     */
    public static function typeTinyblob($aValue = array())
	{
		$mVar = new TypeTinyblob($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeBlob
     */
    public static function typeBlob($aValue = array())
	{
		$mVar = new TypeBlob($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeMediumblob
     */
    public static function typeMediumblob($aValue = array())
	{
		$mVar = new TypeMediumblob($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeLongblob
     */
    public static function typeLongblob($aValue = array())
	{
		$mVar = new TypeLongblob($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeTinytext
     */
    public static function typeTinytext($aValue = array())
	{
		$mVar = new TypeTinytext($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeText
     */
    public static function typeText($aValue = array())
	{
		$mVar = new TypeText($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeMediumtext
     */
    public static function typeMediumtext($aValue = array())
	{
		$mVar = new TypeMediumtext($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeLongtext
     */
    public static function typeLongtext($aValue = array())
	{
		$mVar = new TypeLongtext($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeEnum
     */
    public static function typeEnum($aValue = array())
	{
		$mVar = new TypeEnum($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeSet
     */
    public static function typeSet($aValue = array())
	{
		$mVar = new TypeSet($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeDate
     */
    public static function typeDate($aValue = array())
	{
		$mVar = new TypeDate($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeTime
     */
    public static function typeTime($aValue = array())
	{
		$mVar = new TypeTime($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeDatetime
     */
    public static function typeDatetime($aValue = array())
	{
		$mVar = new TypeDatetime($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeTimestamp
     */
    public static function typeTimestamp($aValue = array())
	{
		$mVar = new TypeTimestamp($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeYear
     */
    public static function typeYear($aValue = array())
	{
		$mVar = new TypeYear($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeTinyint
     */
    public static function typeTinyint($aValue = array())
	{
		$mVar = new TypeTinyint($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeSmallint
     */
    public static function typeSmallint($aValue = array())
	{
		$mVar = new TypeSmallint($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeMediumint
     */
    public static function typeMediumint($aValue = array())
	{
		$mVar = new TypeMediumint($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeInt
     */
    public static function typeInt($aValue = array())
	{
		$mVar = new TypeInt($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeBigint
     */
    public static function typeBigint($aValue = array())
	{
		$mVar = new TypeBigint($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeFloat
     */
    public static function typeFloat($aValue = array())
	{
		$mVar = new TypeFloat($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeDouble
     */
    public static function typeDouble($aValue = array())
	{
		$mVar = new TypeDouble($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeBit
     */
    public static function typeBit($aValue = array())
	{
		$mVar = new TypeBit($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeBoolean
     */
    public static function typeBoolean($aValue = array())
	{
		$mVar = new TypeBoolean($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeBool
     */
    public static function typeBool($aValue = array())
	{
		$mVar = new TypeBool($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeGeometry
     */
    public static function typeGeometry($aValue = array())
	{
		$mVar = new TypeGeometry($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypePoint
     */
    public static function typePoint($aValue = array())
	{
		$mVar = new TypePoint($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeLinestring
     */
    public static function typeLinestring($aValue = array())
	{
		$mVar = new TypeLinestring($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypePolygon
     */
    public static function typePolygon($aValue = array())
	{
		$mVar = new TypePolygon($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeGeometrycollection
     */
    public static function typeGeometrycollection($aValue = array())
	{
		$mVar = new TypeGeometrycollection($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeMultilinestring
     */
    public static function typeMultilinestring($aValue = array())
	{
		$mVar = new TypeMultilinestring($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeMultipoint
     */
    public static function typeMultipoint($aValue = array())
	{
		$mVar = new TypeMultipoint($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeMultipolygon
     */
    public static function typeMultipolygon($aValue = array())
	{
		$mVar = new TypeMultipolygon($aValue);

		return $mVar;
	}

	/**
     * @param array $aValue
     * @return TypeJson
     */
    public static function typeJson($aValue = array())
	{
		$mVar = new TypeJson($aValue);

		return $mVar;
	}

	/**
	 * @return false|string JSON
	 */
	public function __toString()
	{
        return $this->getPropertyJson();
	}

	/**
	 * @return false|string
	 */
	public function getPropertyJson()
	{
        return json_encode($this->getPropertyArray());
	}

	/**
	 * @return array
	 */
	public function getPropertyArray()
	{
        return get_object_vars($this);
	}

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function getConstantArray()
	{
		$oReflectionClass = new \ReflectionClass($this);
		$aConstant = $oReflectionClass->getConstants();

		return $aConstant;
	}

	/**
	 * @return $this
	 */
	public function flushProperties()
	{
		foreach ($this->getPropertyArray() as $sKey => $aValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod)) 
			{
				$this->$sMethod('');
			}
		}

		return $this;
	}

	/**
	 * @return string JSON
	 */
	public function getDataTypeConfigJSON()
	{
		return '{"name":"FieldType","file":"FieldType.php","extends":"","namespace":"DB\\\\DataType\\\\SQL","constant":[],"property":[{"key":"typeChar","var":"TypeChar","value":"new TypeChar()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeVarchar","var":"TypeVarchar","value":"new TypeVarchar()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeBinary","var":"TypeBinary","value":"new TypeBinary()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeVarbinary","var":"TypeVarbinary","value":"new TypeVarbinary()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeTinyblob","var":"TypeTinyblob","value":"new TypeTinyblob()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeBlob","var":"TypeBlob","value":"new TypeBlob()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeMediumblob","var":"TypeMediumblob","value":"new TypeMediumblob()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeLongblob","var":"TypeLongblob","value":"new TypeLongblob()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeTinytext","var":"TypeTinytext","value":"new TypeTinytext()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeText","var":"TypeText","value":"new TypeText()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeMediumtext","var":"TypeMediumtext","value":"new TypeMediumtext()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeLongtext","var":"TypeLongtext","value":"new TypeLongtext()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeEnum","var":"TypeEnum","value":"new TypeEnum()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeSet","var":"TypeSet","value":"new TypeSet()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeDate","var":"TypeDate","value":"new TypeDate()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeTime","var":"TypeTime","value":"new TypeTime()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeDatetime","var":"TypeDatetime","value":"new TypeDatetime()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeTimestamp","var":"TypeTimestamp","value":"new TypeTimestamp()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeYear","var":"TypeYear","value":"new TypeYear()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeTinyint","var":"TypeTinyint","value":"new TypeTinyint()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeSmallint","var":"TypeSmallint","value":"new TypeSmallint()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeMediumint","var":"TypeMediumint","value":"new TypeMediumint()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeInt","var":"TypeInt","value":"new TypeInt()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeBigint","var":"TypeBigint","value":"new TypeBigint()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeFloat","var":"TypeFloat","value":"new TypeFloat()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeDouble","var":"TypeDouble","value":"new TypeDouble()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeBit","var":"TypeBit","value":"new TypeBit()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeBoolean","var":"TypeBoolean","value":"new TypeBoolean()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeBool","var":"TypeBool","value":"new TypeBool()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeGeometry","var":"TypeGeometry","value":"new TypeGeometry()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typePoint","var":"TypePoint","value":"new TypePoint()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeLinestring","var":"TypeLinestring","value":"new TypeLinestring()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typePolygon","var":"TypePolygon","value":"new TypePolygon()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeGeometrycollection","var":"TypeGeometrycollection","value":"new TypeGeometrycollection()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeMultilinestring","var":"TypeMultilinestring","value":"new TypeMultilinestring()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeMultipoint","var":"TypeMultipoint","value":"new TypeMultipoint()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeMultipolygon","var":"TypeMultipolygon","value":"new TypeMultipolygon()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false},{"key":"typeJson","var":"TypeJson","value":"new TypeJson()","visibility":"public","static":true,"setter":false,"getter":false,"explicitMethodForValue":true,"listProperty":false,"createStaticPropertyGetter":false,"setValueInConstructor":false}],"createHelperMethods":true}';
	}

}
