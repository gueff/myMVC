<?php

/**
 * @name $MVCDBDataTypeSQL
 */
namespace MVC\DB\DataType\SQL;

use MVC\DataType\DTValue;
use MVC\MVCTrait\TraitDataType;

class FieldType
{
	use TraitDataType;

	public const DTHASH = '7426be04244222050f2020d3ca94e371';

	/**
	 * FieldType constructor.
	 * @param array $aData
	 * @throws \ReflectionException 
	 */
	public function __construct(array $aData = array())
	{
		$oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('FieldType.__construct.before', $oDTValue);
		$aData = $oDTValue->get_mValue();


		foreach ($aData as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod))
			{
				$this->$sMethod($mValue);
			}
		}

		$oDTValue = DTValue::create()->set_mValue($aData); \MVC\Event::run('FieldType.__construct.after', $oDTValue);
	}

    /**
     * @param array $aData
     * @return FieldType
     * @throws \ReflectionException
     */
    public static function create(array $aData = array())
    {
        $oDTValue = DTValue::create()->set_mValue($aData);
		\MVC\Event::run('FieldType.create.before', $oDTValue);
		$oObject = new self($oDTValue->get_mValue());
        $oDTValue = DTValue::create()->set_mValue($oObject); \MVC\Event::run('FieldType.create.after', $oDTValue);

        return $oDTValue->get_mValue();
    }

	/**
     * @param array $mValue
     * @return TypeChar
     */
    public static function typeChar($mValue = array()) : TypeChar
	{
		$mVar = new TypeChar($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeVarchar
     */
    public static function typeVarchar($mValue = array()) : TypeVarchar
	{
		$mVar = new TypeVarchar($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeBinary
     */
    public static function typeBinary($mValue = array()) : TypeBinary
	{
		$mVar = new TypeBinary($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeVarbinary
     */
    public static function typeVarbinary($mValue = array()) : TypeVarbinary
	{
		$mVar = new TypeVarbinary($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeTinyblob
     */
    public static function typeTinyblob($mValue = array()) : TypeTinyblob
	{
		$mVar = new TypeTinyblob($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeBlob
     */
    public static function typeBlob($mValue = array()) : TypeBlob
	{
		$mVar = new TypeBlob($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeMediumblob
     */
    public static function typeMediumblob($mValue = array()) : TypeMediumblob
	{
		$mVar = new TypeMediumblob($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeLongblob
     */
    public static function typeLongblob($mValue = array()) : TypeLongblob
	{
		$mVar = new TypeLongblob($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeTinytext
     */
    public static function typeTinytext($mValue = array()) : TypeTinytext
	{
		$mVar = new TypeTinytext($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeText
     */
    public static function typeText($mValue = array()) : TypeText
	{
		$mVar = new TypeText($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeMediumtext
     */
    public static function typeMediumtext($mValue = array()) : TypeMediumtext
	{
		$mVar = new TypeMediumtext($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeLongtext
     */
    public static function typeLongtext($mValue = array()) : TypeLongtext
	{
		$mVar = new TypeLongtext($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeEnum
     */
    public static function typeEnum($mValue = array()) : TypeEnum
	{
		$mVar = new TypeEnum($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeSet
     */
    public static function typeSet($mValue = array()) : TypeSet
	{
		$mVar = new TypeSet($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeDate
     */
    public static function typeDate($mValue = array()) : TypeDate
	{
		$mVar = new TypeDate($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeTime
     */
    public static function typeTime($mValue = array()) : TypeTime
	{
		$mVar = new TypeTime($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeDatetime
     */
    public static function typeDatetime($mValue = array()) : TypeDatetime
	{
		$mVar = new TypeDatetime($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeTimestamp
     */
    public static function typeTimestamp($mValue = array()) : TypeTimestamp
	{
		$mVar = new TypeTimestamp($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeYear
     */
    public static function typeYear($mValue = array()) : TypeYear
	{
		$mVar = new TypeYear($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeTinyint
     */
    public static function typeTinyint($mValue = array()) : TypeTinyint
	{
		$mVar = new TypeTinyint($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeSmallint
     */
    public static function typeSmallint($mValue = array()) : TypeSmallint
	{
		$mVar = new TypeSmallint($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeMediumint
     */
    public static function typeMediumint($mValue = array()) : TypeMediumint
	{
		$mVar = new TypeMediumint($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeInt
     */
    public static function typeInt($mValue = array()) : TypeInt
	{
		$mVar = new TypeInt($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeBigint
     */
    public static function typeBigint($mValue = array()) : TypeBigint
	{
		$mVar = new TypeBigint($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeFloat
     */
    public static function typeFloat($mValue = array()) : TypeFloat
	{
		$mVar = new TypeFloat($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeDouble
     */
    public static function typeDouble($mValue = array()) : TypeDouble
	{
		$mVar = new TypeDouble($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeBit
     */
    public static function typeBit($mValue = array()) : TypeBit
	{
		$mVar = new TypeBit($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeBoolean
     */
    public static function typeBoolean($mValue = array()) : TypeBoolean
	{
		$mVar = new TypeBoolean($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeBool
     */
    public static function typeBool($mValue = array()) : TypeBool
	{
		$mVar = new TypeBool($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeGeometry
     */
    public static function typeGeometry($mValue = array()) : TypeGeometry
	{
		$mVar = new TypeGeometry($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypePoint
     */
    public static function typePoint($mValue = array()) : TypePoint
	{
		$mVar = new TypePoint($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeLinestring
     */
    public static function typeLinestring($mValue = array()) : TypeLinestring
	{
		$mVar = new TypeLinestring($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypePolygon
     */
    public static function typePolygon($mValue = array()) : TypePolygon
	{
		$mVar = new TypePolygon($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeGeometrycollection
     */
    public static function typeGeometrycollection($mValue = array()) : TypeGeometrycollection
	{
		$mVar = new TypeGeometrycollection($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeMultilinestring
     */
    public static function typeMultilinestring($mValue = array()) : TypeMultilinestring
	{
		$mVar = new TypeMultilinestring($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeMultipoint
     */
    public static function typeMultipoint($mValue = array()) : TypeMultipoint
	{
		$mVar = new TypeMultipoint($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeMultipolygon
     */
    public static function typeMultipolygon($mValue = array()) : TypeMultipolygon
	{
		$mVar = new TypeMultipolygon($mValue);

		return $mVar;
	}

	/**
     * @param array $mValue
     * @return TypeJson
     */
    public static function typeJson($mValue = array()) : TypeJson
	{
		$mVar = new TypeJson($mValue);

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
		foreach ($this->getPropertyArray() as $sKey => $mValue)
		{
			$sMethod = 'set_' . $sKey;

			if (method_exists($this, $sMethod)) 
			{
				$this->$sMethod('');
			}
		}

		return $this;
	}

}
