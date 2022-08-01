<?php
/**
 * Db.php
 * This is part of the myMVC module "DB"
 *
 * @module DB
 * @package DB\Model
 * @copyright ueffing.net
 * @author Guido K.B.W. Üffing <info@ueffing.net>
 * @license GNU GENERAL PUBLIC LICENSE Version 3. See application/doc/COPYING
 */

/**
 * @name $DBModel
 */
namespace DB\Model;

use DB\DataType\DB\ArrayObject;
use DB\DataType\DB\Constraint;
use DB\DataType\DB\Foreign;
use DB\DataType\DB\TableDataType;
use MVC\DataType\DTArrayObject;
use MVC\DataType\DTKeyValue;
use MVC\Error;
use MVC\Event;
use MVC\Generator\DataType;
use MVC\Log;
use MVC\Registry;
use MVC\Request;

/**
 * Class Db
 * @package DB\Model
 */
class Db
{
    /**
     * @var string
     */
    protected $sTableName = '';

    /**
     * @var string
     */
    protected $sCacheKeyTableName = '';

    /**
     * @var string
     */
    protected $sCacheValueTableName = '';

    /**
     * @var array
     */
    protected $aFieldArrayComplete = array();

    /**
     * @var \DB\Model\DbPDO
     */
	protected $oDbPDO;

    /**
     * @var bool
     */
	protected static $bCaching = true;

    /**
     * @see README.md
     * @var array
     */
	protected $aConfig = array();

    /**
     * These Fieldnames are reserved and may not be part of setup
     * as they will be created and added automatically.
     * You can override this behaviour by using method `setReservedFieldNameArray()` and passing
     * an empty array to it: $oDb->setReservedFieldNameArray(array());
     * @var array
     */
	protected $aReservedFieldName = array(
	    'id',
        'stampChange',
        'stampCreate'
    );

    /**
     * array of sql types and their php equivalents
     * @var array
     */
    protected static $aSqlType = array(
        'char' => 'string',
        'varchar' => 'string',
        'binary' => 'string',
        'varbinary' => 'string',
        'tinyblob' => 'string',
        'blob' => 'string',
        'mediumblob' => 'string',
        'longblob' => 'string',
        'tinytext' => 'string',
        'text' => 'string',
        'mediumtext' => 'string',
        'longtext' => 'string',
        'enum' => 'string',
        'set' => 'string',

        'date' => 'string',
        'time' => 'string',
        'datetime' => 'string',
        'timestamp' => 'string',
        'year' => 'string',

        'tinyint' => 'int',
        'smallint' => 'int',
        'mediumint' => 'int',
        'int' => 'int',
        'bigint' => 'int',
        'float' => 'float',
        'double' => 'double',

        'bit' => 'boolean',
        'boolean' => 'boolean',
        'bool' => 'boolean',

        'geometry' => 'string',
        'point' => 'string',
        'linestring' => 'string',
        'polygon' => 'string',
        'geometrycollection' => 'string',
        'multilinestring' => 'string',
        'multipoint' => 'string',
        'multipolygon' => 'string',

        'json' => 'string',
    );

    /**
     * Db constructor.
     * @param array $aFields
     * @param array $aDbConfig
     * @param array $aAlterTable
     * @throws \ReflectionException
     */
	public function __construct ($aFields = array(), $aDbConfig = array(), $aAlterTable = array())
	{
        $this->aFieldArrayComplete = $aFields;
        $this->aConfig = $aDbConfig;
	    $this->sTableName = self::createTableName(get_class($this));
        $this->sCacheKeyTableName = __CLASS__ . '.' . $this->sTableName;
        $this->sCacheValueTableName = func_get_args();
        Log::write(__METHOD__, $this->sTableName . '.log');

        // init DB
        $sRegistryKey = self::createTableName(__CLASS__) . '.DbPDO';

        if (\MVC\Registry::isRegistered($sRegistryKey))
        {
            $this->oDbPDO = \MVC\Registry::get($sRegistryKey);
        }
        else
        {
            $this->oDbPDO = new DbPDO($this->aConfig);
            \MVC\Registry::set($sRegistryKey, $this->oDbPDO);
        }

        $this->setCachingState();
        $this->setSqlLoggingState();

        if ($this->sCacheValueTableName !== \Cachix::getCache($this->sCacheKeyTableName))
        {
            (false === filter_var($this->checkIfTableExists ($this->sTableName), FILTER_VALIDATE_BOOLEAN)) ? $this->createTable($this->sTableName, $aFields, $aAlterTable) : false;
            $this->synchronizeFields();

            if (true === self::$bCaching)
            {
                \Cachix::saveCache(
                    $this->sCacheKeyTableName,
                    $this->sCacheValueTableName
                );
            }
        }

	}

    /**
     * Sets Caching state due to config
     */
    protected function setCachingState()
    {
        self::$bCaching = (isset($this->aConfig['caching']['enabled'])) ? $this->aConfig['caching']['enabled'] : false;
    }

    /**
     * Sets SQL state due to config
     */
    protected function setSqlLoggingState()
    {
        $sSql = '';
        (isset($this->aConfig['logging']['log_output'])) ? $sSql.= "SET GLOBAL log_output = '" . strtoupper($this->aConfig['logging']['log_output']) . "';" : false;
        (isset($this->aConfig['logging']['general_log'])) ? $sSql.= "SET GLOBAL general_log = '" . strtoupper($this->aConfig['logging']['general_log']) . "';" : false;
        (isset($this->aConfig['logging']['general_log_file'])) ? $sSql.= "SET GLOBAL general_log_file = '" . $this->aConfig['logging']['general_log_file'] . "';" : false;
        $oStmt = $this->oDbPDO->prepare($sSql);

        try
        {
            $oStmt->execute();
        }
        catch (\Exception $oException)
        {
            \MVC\Error::exception($oException);
        }
    }

    /**
     * @param Foreign $oDtDbForeign
     * @return bool
     * @throws \ReflectionException
     */
    protected function setForeignKey(Foreign $oDtDbForeign)
    {
        $sSql = "
            ALTER TABLE `" . $this->sTableName . "`
                ADD `" . $oDtDbForeign->get_sForeignKey() . "` " . $oDtDbForeign->get_sForeignKeySQL() . ";

            ALTER TABLE `" . $this->sTableName . "`
                ADD INDEX `" . $oDtDbForeign->get_sForeignKey() . "` (`" . $oDtDbForeign->get_sForeignKey() . "`);

            ALTER TABLE `" . $this->sTableName . "`
                ADD CONSTRAINT FOREIGN KEY (`" . $oDtDbForeign->get_sForeignKey() . "`)
                REFERENCES `" . $oDtDbForeign->get_sReferenceTable() . "` (`" . $oDtDbForeign->get_sReferenceKey() . "`)
                " . $oDtDbForeign->get_sOnDelete() . " " . $oDtDbForeign->get_sOnUpdate() . ";";

        $sCacheKey = __METHOD__ . '.' . $this->sTableName . '.' . md5(serialize($oDtDbForeign));

        // add to final, completed  field array
        if (false === in_array($oDtDbForeign->get_sForeignKey(), $this->aFieldArrayComplete))
        {
            $this->aFieldArrayComplete[$oDtDbForeign->get_sForeignKey()] = $oDtDbForeign->get_sForeignKey();
        }

        if ($sSql !== \Cachix::getCache($sCacheKey))
        {
            $oStmt = $this->oDbPDO->prepare($sSql);

            try
            {
                $oStmt->execute();
            }
            catch (\Exception $oException)
            {
                \MVC\Error::exception($oException);
                return false;
            }

            \Cachix::saveCache(
                $sCacheKey,
                $sSql
            );
        }

        return true;
    }

    /**
     * @param array $aReservedFieldName
     */
    protected function setReservedFieldNameArray(array $aReservedFieldName = array())
    {
        $this->aReservedFieldName = $aReservedFieldName;
    }

    /**
     * @return array
     */
    protected function getReservedFieldNameArray()
    {
        return $this->aReservedFieldName;
    }

    /**
     * generates a DataType Class on the DB Table
     * @return bool
     * @throws \ReflectionException
     */
    protected function generateDataType()
    {
        $sClassName = $this->getGenerateDataTypeClassName();

        $aDTConfig = array(
            'dir' => Registry::get('MVC_MODULES') . '/' . Request::getInstance()->getModule() . '/DataType/',
            'unlinkDir' => false,
            'class' => array(array(
                'name' => $sClassName,
                'file' => $sClassName . '.php',
                'extends' => '\\DB\\DataType\\DB\\TableDataType',
                'namespace' => Request::getInstance()->getModule() . '\DataType',
                'constant' => array(),
                'property' => array()
            ))
        );

        $aTableDataTypeProperty = array_keys(TableDataType::create()->getPropertyArray());
        $aField = $this->getFieldInfo('', false);

        foreach ($aField as $sKey => $aValue)
        {
            // skip building properties which are already part of extended class
            if (in_array($sKey, $aTableDataTypeProperty))
            {
                continue;
            }

            $aDTConfig['class'][0]['property'][] = array('key' => $sKey, 'var' => $aValue['php']);
        }

        $bSuccess = DataType::create()->initConfigArray($aDTConfig);

        return $bSuccess;
    }

    /**
     * @return string
     */
    protected function getGenerateDataTypeClassName()
    {
        $sClassName = str_replace('\\', '', str_replace('_', '', 'DT' . get_class($this)));

        return $sClassName;
    }

    public static function getSqlTypeArray()
    {
        return self::$aSqlType;
    }

    /**
     * @param array $aField
     * @return bool equal
     */
    protected function bFieldsAreEqual(array $aField = array())
    {
        $aParamFieldKey = array_keys($aField);
        $aDbFieldKey = array_keys($this->getFieldInfo());
        $mDiff1 = array_diff($aParamFieldKey, $aDbFieldKey);
        $mDiff2 = array_diff($aDbFieldKey, $aParamFieldKey);

        return (empty($mDiff1) && empty($mDiff2));
    }

    /**
     * @param $sTable
     * @return bool
     * @throws \ReflectionException
     */
	protected function checkIfTableExists ($sTable)
	{
		try
		{						
			// Select 1 from table_name will return false if the table does not exist.
			$aResult = $this->oDbPDO->fetchAll ("DESCRIBE `" . $sTable . "`");
		}
		catch (\Exception $oException)
		{		
			Error::exception($oException);

			return false;
		}
		
		if (empty($aResult))
		{
			return false;
		}

		return true;
	}

	/**
     * Creates InnoDB Table
     * @example $aFields
     * array(
     *      , 'url'                 => 'varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL'
     *      , 'dateTimeInvalid'     => 'datetime'
     *      , 'jsonContext'         => 'text'
     *      , 'deliverable'         => 'int(1)'
     *      , 'dateTimeDelivered'   => 'datetime'
     * );
     * @param $sTable
     * @param $aFields
     * @param array $aAlterTable
     * @return bool|false|\PDOStatement
     * @throws \ReflectionException
     */
	protected function createTable ($sTable, $aFields, $aAlterTable = array())
	{
        $mState = false;

        // drop, create, add id
		$sSql = "
            DROP TABLE IF EXISTS `" . $sTable . "`; 
            CREATE TABLE IF NOT EXISTS `" . $sTable . "` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            ";

		// iterate fields
		foreach ($aFields as $sKey => $sValue)
		{
		    // skip these
		    if (in_array($sKey, $this->aReservedFieldName))
            {
                continue;
            }

			$sSql.= "`" . $sKey . "` " . $sValue . ",\n";
		}

		// add stamps + set primary key
		$sSql.= "`stampChange` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				`stampCreate` timestamp NOT NULL DEFAULT '" . date ('Y-m-d H:i:s') . "',
				PRIMARY KEY (`id`)";

		// set engine
		$sSql.="\n) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;";

		// additional commands
        foreach ($aAlterTable as $sValue)
        {
            $sSql.= "ALTER TABLE `" . $sTable . "` ADD " . $sValue . ";\n";
        }

		try
		{
			$mState = $this->oDbPDO->query ($sSql);
		}
		catch (\Exception $oException)
		{
			\MVC\Error::exception($oException);
		}

		return $mState;
	}

    /**
     * @return bool
     * @throws \ReflectionException
     */
	protected function synchronizeFields ()
	{
		$sSql = "SHOW COLUMNS FROM " . $this->sTableName;

		try
		{
			$aColumn = $this->oDbPDO->fetchAll ($sSql);
		}
		catch (\Exception $oException)
		{
			\MVC\Error::exception($oException);
			
			return false;
		}

		if (empty($aColumn))
		{
			return false;
		}

        $aColumnFinal = array();

		foreach ($aColumn as $aValue)
		{
			if (!in_array ($aValue['Field'], self::getReservedFieldNameArray()))
			{
				$aColumnFinal[$aValue['Field']] = $aValue;
			}
		}

		$sCacheSyncKey = __METHOD__ . '.' . $this->sTableName;
		$sCacheSyncValue = serialize($aColumnFinal) . '.' . serialize($this->sCacheValueTableName);

        if ($sCacheSyncValue === \Cachix::getCache($sCacheSyncKey))
        {
            return true;
        }

        \Cachix::saveCache($sCacheSyncKey, $sCacheSyncValue);

		DELETE: {

		    // array1 has to be in array2
            $aDelete = array_diff_key($this->aFieldArrayComplete, $aColumnFinal);

			foreach ($aDelete as $sKey => $aValue)
			{
			    $oDTDBConstraint = $this->getConstraintInfo($aValue); # ['Field']);
                $sSql = '';

                if ('' !== $oDTDBConstraint->get_CONSTRAINT_NAME())
                {
                    $sSql.= "ALTER TABLE  `" . $this->sTableName  . "` DROP FOREIGN KEY `" . $oDTDBConstraint->get_CONSTRAINT_NAME() . "`;\n";
                    $sSql.= "ALTER TABLE  `" . $this->sTableName  . "` DROP INDEX `" . $oDTDBConstraint->get_CONSTRAINT_NAME() . "`;\n";
                }

				$sSql.= "ALTER TABLE  `" . $this->sTableName  . "` DROP  `" . $sKey . "`;\n";

				try
				{
					$this->oDbPDO->query ($sSql);
				}
				catch (\Exception $oException)
				{
					\MVC\Error::exception($oException);

					return false;
				}
			}
		}
		
		INSERT: {
			
			$aInsert = array_diff_key($this->getFieldArray(), $aColumnFinal);

			foreach ($aInsert as $sKey => $aValue)
			{
				$sSql = "ALTER TABLE  `" . $this->sTableName  . "` ADD  `" . $sKey . "` " . $aValue . " AFTER  `id`\n";

				try
				{
					$this->oDbPDO->query ($sSql);
				}
				catch (\Exception $oException)
				{
					\MVC\Error::exception($oException);
					
					return false;
				}			
			}		
		}
		
		UPDATE: {

            $sSql = '';

            foreach ($this->getFieldArray() as $sKey => $sValue)
            {
                $sSql.= "ALTER TABLE `" . $this->sTableName . "` CHANGE  `" . $sKey . "`\n`" . $sKey . "` " . $sValue . ";\n";
            }

            try
            {
                $this->oDbPDO->query ($sSql);
            }
            catch (\Exception $oException)
            {
                \MVC\Error::exception($oException);

                return false;
            }

		}
			
		return true;
	}

	/**
	 * returns settings array from extending child class, if set
	 * @return array
	 */
    protected function getFieldArray()
	{
        return (isset($this->aField)) ? $this->aField : array();
	}

    /**
     * @param string $sFieldName
     * @param bool $bAvoidReserved
     * @return array|mixed
     */
    public function getFieldInfo($sFieldName = '', $bAvoidReserved = true)
    {
        $aResult = array();
        $sSql = "SHOW FIELDS FROM " . $this->sTableName;
        ('' !== $sFieldName) ? $sSql.= " where Field =:sFieldName" : false;

        $oStmt = $this->oDbPDO->prepare($sSql);
        ('' !== $sFieldName) ? $oStmt->bindValue(':sFieldName', $sFieldName, \PDO::PARAM_STR) : false;

        $oStmt->execute();
        $aFieldName = ('' === $sFieldName) ? $oStmt->fetchAll(\PDO::FETCH_ASSOC) : $oStmt->fetch(\PDO::FETCH_ASSOC);

        if ('' === $sFieldName)
        {
            foreach ($aFieldName as $aValue)
            {
                if (true === $bAvoidReserved && in_array($aValue['Field'], $this->aReservedFieldName))
                {
                    continue;
                }

                $aResult[$aValue['Field']] = $aValue;
            }
        }
        else
        {
            $aResult = $aFieldName;
        }

        // add PHP Type equivalents
        foreach ($aResult as $sKey => $sValue)
        {
            $sType = preg_replace('/[^a-zA-Z]+/', '', trim(strtolower($sValue['Type'])));

            if (isset(self::$aSqlType[$sType]))
            {
                $aResult[$sKey]['php'] = self::$aSqlType[$sType];
            }
        }

        return $aResult;
    }

    /**
     * @param string $sFieldName
     * @return Constraint
     * @throws \ReflectionException
     */
    protected function getConstraintInfo($sFieldName = '')
    {
        $aConstraint = array();
        $sSql = "
            SELECT 
                COLUMN_NAME, 
                CONSTRAINT_NAME, 
                REFERENCED_COLUMN_NAME, 
                REFERENCED_TABLE_NAME
            FROM information_schema.KEY_COLUMN_USAGE
            WHERE 1
            AND TABLE_NAME=:sTableName
            ";
        ('' !== $sFieldName) ? $sSql.= "AND COLUMN_NAME=:sFieldName\n" : false;
        $sSql.= ";";

        $oStmt = $this->oDbPDO->prepare($sSql);
        $oStmt->bindValue(':sTableName', $this->sTableName, \PDO::PARAM_STR);
        ('' !== $sFieldName) ? $oStmt->bindValue(':sFieldName', $sFieldName, \PDO::PARAM_STR) : false;

        try
        {
            $oStmt->execute();
            $aConstraint = ('' === $sFieldName) ? $oStmt->fetchAll(\PDO::FETCH_ASSOC) : $oStmt->fetch(\PDO::FETCH_ASSOC);
            (false === is_array($aConstraint)) ? $aConstraint = array() : false;
        }
        catch (\Exception $oException)
        {
            Error::exception($oException);
        }

        $oDTDBConstraint = new Constraint($aConstraint);

        return $oDTDBConstraint;
    }

    /**
     * @param string $sString
     * @return mixed|string
     */
    protected static function createTableName($sString = '')
	{
        ('' === $sString) ? $sString = __CLASS__ : false;
		$sString = str_replace('\\', '', $sString);
        $sString = str_replace('_', '', $sString);

		return $sString;
	}

    /**
     * @param TableDataType|null $oTableDataType
     * @return TableDataType
     * @throws \ReflectionException
     */
    public function create (TableDataType $oTableDataType = null)
    {
        if (null === $oTableDataType)
        {
            return $oTableDataType;
        }

        $aField = array_keys($oTableDataType->getPropertyArray());

        // STATEMENT
        $sSql = "INSERT INTO  `" . $this->sTableName . "` (";
        $sSqlExplain = $sSql;

        foreach ($aField as $iCnt => $sField)
        {
            if ('id' === $sField){continue;}
            $sSql.= "`" . $sField . "`,";
            $sSqlExplain.= "`" . $sField . "`,";;
        }

        $sSql = substr($sSql, 0, -1);
        $sSql.= "\n) VALUES (\n";
        $sSqlExplain.= ") VALUES (";;

        foreach ($aField as $iCnt => $sField)
        {
            if ('id' === $sField){continue;}
            $sSql.= ":" . $sField . ",";
            $sSqlExplain.= ":" . $sField . ",";
        }

        $sSql = substr($sSql, 0, -1);
        $sSql.= "\n);\n";
        $sSqlExplain.= "); ";

        Event::run(
            'db.model.db.create.sql',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('sSqlExplain')
                        ->set_sValue($sSqlExplain)
                )
        );

        $oStmt = $this->oDbPDO->prepare($sSql);

        // BINDINGS
        foreach ($aField as $iCnt => $sField)
        {
            if ('id' === $sField){continue;}

            $sMethod = 'get_' . $sField;
            $sValue = $oTableDataType->$sMethod();
            $sType = gettype($sValue);

            ('boolean' === $sType) ? $sDataType = \PDO::PARAM_ : false;
            ('integer' === $sType) ? $sDataType = \PDO::PARAM_INT : false;
            ('null' === $sType) ? $sDataType = \PDO::PARAM_NULL : false;
            ('string' === $sType) ? $sDataType = \PDO::PARAM_STR : false;
            (false === isset($sDataType)) ? $sDataType = \PDO::PARAM_STR : false;

            $oStmt->bindValue(
                ':' . $sField,
                $sValue,
                $sDataType
            );
        }

        try
        {
            // Create DB Entries
            $oStmt->execute();
            $iId = $this->oDbPDO->lastInsertId();
            $oTableDataType->set_id($iId);
        }
        catch (\Exception $oExc)
        {
            Error::exception($oExc);
        }

        return $oTableDataType;
    }

    /**
     * Simple key{token}value Getter
     * @param DTArrayObject $oDTArrayObject
     * @param DTArrayObject $oDTArrayObjectOption
     * @return DB\DataType\DB\TableDataType[]
     * @example
        * $oDTArrayObject = \MVC\DataType\DTArrayObject::create()
            * ->add_aKeyValue(
                * \MCC\DataType\DTKeyValue::create()
                    * ->set_sKey(DTLCPModelTableLCP::getPropertyName_deliverable())
                    * ->set_mOptional1('=')
                    * ->set_sValue(1)
            * )
            * ->add_aKeyValue(
                * \MCC\DataType\DTKeyValue::create()
                    * ->set_sKey(DTLCPModelTableLCP::getPropertyName_dateTimeDelivered())
                    * ->set_mOptional1('=')
                    * ->set_sValue('0000-00-00 00:00:00')
        * );
        * $oDB->getArrayOfDTObjectsOnKeyHasValue($oDTDBArrayObject);
     */

    /**
     * @param DTArrayObject|null $oDTArrayObject
     * @param DTArrayObject|null $oDTArrayObjectOption
     * @return array
     * @throws \ReflectionException
     */
    public function retrieve(DTArrayObject $oDTArrayObject = null, DTArrayObject $oDTArrayObjectOption = null)
    {
        $aObject = array();
        $sDTClassName = Request::getInstance()->getModule() . '\DataType\\' . $this->getGenerateDataTypeClassName();
        $aPossibleToken = array('=', '<', '<=', '>', '>=', 'LIKE', '!=');

        $sSql = "SELECT * FROM `" . $this->sTableName . "` \nWHERE  1\n";
        $sSqlExplain = $sSql;

        // add requirements
        if (true === ($oDTArrayObject instanceof DTArrayObject))
        {
            foreach ($oDTArrayObject->get_aKeyValue() as $iKey => $oDTKeyValue)
            {
                (empty($oDTKeyValue->get_mOptional1())) ? $oDTKeyValue->set_mOptional1('=') : false;

                if (false === in_array(strtoupper($oDTKeyValue->get_mOptional1()), $aPossibleToken))
                {
                    return new $sDTClassName();
                }

                $sSql.= "\nAND `" . $oDTKeyValue->get_sKey() . "` " . $oDTKeyValue->get_mOptional1() . " :" . $oDTKeyValue->get_sKey();
                $sSqlExplain.= "AND `" . $oDTKeyValue->get_sKey() . "` " . $oDTKeyValue->get_mOptional1() . " '" . $oDTKeyValue->get_sValue() . "' ";
            }
        }

        // options
        if (true === ($oDTArrayObjectOption instanceof DTArrayObject))
        {
            foreach ($oDTArrayObjectOption->get_aKeyValue() as $iKey => $oDTKeyValue)
            {
                $sSql.= "\n" . $oDTKeyValue->get_sValue() . " \n";
                $sSqlExplain.= $oDTKeyValue->get_sValue() . ' ';
            }
        }

        $sSqlExplain = str_replace("\n", ' ', htmlentities(stripslashes($sSqlExplain)));

        Event::run(
            'db.model.db.retrieve.sql',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('sSqlExplain')
                        ->set_sValue($sSqlExplain)
            )
        );

        $oStmt = $this->oDbPDO->prepare($sSql);

        // bind Values
        foreach ($oDTArrayObject->get_aKeyValue() as $iKey => $oDTKeyValue)
        {
            $iPdoParam = 0;
            ('integer' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
            ('string' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
            ('object' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
            ('boolean' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
            ('null' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

            $oStmt->bindValue(
                ':' . $oDTKeyValue->get_sKey(),
                $oDTKeyValue->get_sValue(),
                $iPdoParam
            );
        }

        try
        {
            $oStmt->execute();
            $aFetchAll = $oStmt->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($aFetchAll as $aData)
            {
                $oObject = new $sDTClassName();

                // set types properly
                foreach ($aData as $sKey => $sValue)
                {
                    $sGetter = 'get_' . $sKey;
                    $sSetter = 'set_' . $sKey;
                    $sHasToBeType = (method_exists($oObject, $sGetter)) ? gettype($oObject->$sGetter()) : 'string';
                    settype($sValue, $sHasToBeType);

                    if (true === method_exists($oObject, $sSetter))
                    {
                        $oObject->$sSetter($sValue);
                    }
                }

                $aObject[] = $oObject;
            }
        }
        catch (\Exception $oExc)
        {
            Error::exception($oExc);
        }

        return $aObject;
    }

    /**
     * @param DTArrayObject|null $oDTArrayObject
     * @param DTArrayObject|null $oDTArrayObjectOption
     * @return int
     * @throws \ReflectionException
     */
    public function count(DTArrayObject $oDTArrayObject = null, DTArrayObject $oDTArrayObjectOption = null)
    {
        $sDTClassName = Request::getInstance()->getModule() . '\DataType\\' . $this->getGenerateDataTypeClassName();
        $aPossibleToken = array('=', '<', '<=', '>', '>=', 'LIKE', '!=');

        $sSql = "SELECT COUNT(id) AS iAmount FROM `" . $this->sTableName . "` \nWHERE  1\n";
        $sSqlExplain = $sSql;

        // add requirements
        if (true === ($oDTArrayObject instanceof DTArrayObject))
        {
            foreach ($oDTArrayObject->get_aKeyValue() as $iKey => $oDTKeyValue)
            {
                (empty($oDTKeyValue->get_mOptional1())) ? $oDTKeyValue->set_mOptional1('=') : false;

                if (false === in_array(strtoupper($oDTKeyValue->get_mOptional1()), $aPossibleToken))
                {
                    return new $sDTClassName();
                }

                $sSql.= "\nAND `" . $oDTKeyValue->get_sKey() . "` " . $oDTKeyValue->get_mOptional1() . " :" . $oDTKeyValue->get_sKey();
                $sSqlExplain.= "AND `" . $oDTKeyValue->get_sKey() . "` " . $oDTKeyValue->get_mOptional1() . " '" . $oDTKeyValue->get_sValue() . "' ";
            }
        }

        // options
        if (true === ($oDTArrayObjectOption instanceof DTArrayObject))
        {
            foreach ($oDTArrayObjectOption->get_aKeyValue() as $iKey => $oDTKeyValue)
            {
                $sSql.= "\n" . $oDTKeyValue->get_sValue() . " \n";
                $sSqlExplain.= $oDTKeyValue->get_sValue() . ' ';
            }
        }

        $sSqlExplain = str_replace("\n", ' ', htmlentities(stripslashes($sSqlExplain)));

        Event::run(
            'db.model.db.count.sql',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('sSqlExplain')
                        ->set_sValue($sSqlExplain)
                )
        );

        $oStmt = $this->oDbPDO->prepare($sSql);

        // bind Values
        if (true === ($oDTArrayObject instanceof DTArrayObject))
        {
            foreach ($oDTArrayObject->get_aKeyValue() as $iKey => $oDTKeyValue)
            {
                $iPdoParam = 0;
                ('integer' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
                ('string' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
                ('object' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
                ('boolean' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
                ('null' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

                $oStmt->bindValue(
                    ':' . $oDTKeyValue->get_sKey(),
                    $oDTKeyValue->get_sValue(),
                    $iPdoParam
                );
            }
        }

        try
        {
            $oStmt->execute();
            $aFetchAll = $oStmt->fetchAll(\PDO::FETCH_ASSOC);
            $iAmount = (int) current($aFetchAll)['iAmount'];
        }
        catch (\Exception $oExc)
        {
            Error::exception($oExc);
        }

        /** integer */
        return $iAmount;
    }


    /**
     * UPDATE table SET x = y WHERE id
     * @param TableDataType|null $oTableDataType
     * @param DTArrayObject|null $oDTArrayObjectSet
     * @param DTArrayObject|null $oDTArrayObjectWhere
     * @return bool
     * @throws \ReflectionException
     */
    public function update (TableDataType $oTableDataType = null, DTArrayObject $oDTArrayObjectSet = null, DTArrayObject $oDTArrayObjectWhere = null)
    {
        if (is_null($oTableDataType) || is_null($oDTArrayObjectSet))
        {
            return false;
        }

        $sSql = "UPDATE `" . $this->sTableName . "` SET \n";
        $sSqlExplain =  $sSql;

        /**
         * @var integer $iKey
         * @var  DTKeyValue $oDTKeyValueSet
         */
        foreach ($oDTArrayObjectSet->get_aKeyValue() as $iKey => $oDTKeyValueSet)
        {
            $sSql.= '`' . $oDTKeyValueSet->get_sKey() . '` = :' . $oDTKeyValueSet->get_sKey() . ",";
            $sSqlExplain.= '`' . $oDTKeyValueSet->get_sKey() . '` = ' . "'" . $oDTKeyValueSet->get_sValue() . "',";
        }

        $sSql = substr($sSql, 0,-1) . "\n";
        $sSqlExplain = substr($sSqlExplain, 0,-1) . "\n";

        /**
         * default: where id = id
         */
        if (is_null($oDTArrayObjectWhere))
        {
            $sWhere = "WHERE `id` = '" . (int) $oTableDataType->get_id() . "'\n";
        }
        else
        {
            $sWhere = "WHERE 1\n";

            foreach ($oDTArrayObjectWhere->get_aKeyValue() as $iKey => $oDTDBKeyValueWhere)
            {
                $sWhere.= 'AND `' . $oDTDBKeyValueWhere->get_sKey() . '` = ' . "'" . $oDTDBKeyValueWhere->get_sValue() . "' \n";
            }
        }

        $sSql.= $sWhere;
        $sSqlExplain.= $sWhere;
        $sSqlExplain = str_replace("\n", ' ', htmlentities(stripslashes($sSqlExplain)));
        Event::run(
            'db.model.db.update.sql',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('sSqlExplain')
                        ->set_sValue($sSqlExplain)
            )
        );

        $oStmt = $this->oDbPDO->prepare($sSql);

        /**
         * @var integer $iKey
         * @var  DTKeyValue $oDTDBKeyValue
         */
        foreach ($oDTArrayObjectSet->get_aKeyValue() as $iKey => $oDTKeyValueSet)
        {
            $iPdoParam = 0;
            ('integer' === gettype($oDTKeyValueSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
            ('string' === gettype($oDTKeyValueSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
            ('object' === gettype($oDTKeyValueSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
            ('boolean' === gettype($oDTKeyValueSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
            ('null' === gettype($oDTKeyValueSet->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

            $oStmt->bindValue(
                ':' . $oDTKeyValueSet->get_sKey(),
                $oDTKeyValueSet->get_sValue(),
                $iPdoParam
            );
        }

        try
        {
            $oStmt->execute();
        }
        catch (\Exception $oExc)
        {
            \MVC\Error::exception($oExc);
            return false;
        }

        return true;
    }

    /**
     * @param DTArrayObject|null $oDTArrayObject
     * @return bool
     * @throws \ReflectionException
     */
    public function delete (DTArrayObject $oDTArrayObject = null)
    {
        if (is_null($oDTArrayObject))
        {
            return false;
        }

        $bDelete = false;
        $sSql = "DELETE FROM `" . $this->sTableName . "` WHERE 1\n";
        $sSqlExplain =  $sSql;

        /**
         * @var integer $iKey
         * @var  DTKeyValue $oDTKeyValue
         */
        foreach ($oDTArrayObject->get_aKeyValue() as $iKey => $oDTKeyValue)
        {
            $sSql.= 'AND `' . $oDTKeyValue->get_sKey() . '` = :' . $oDTKeyValue->get_sKey() . "\n";
            $sSqlExplain.= 'AND `' . $oDTKeyValue->get_sKey() . '` = ' . "'" . $oDTKeyValue->get_sValue() . "'\n";
        }

        $sSqlExplain = str_replace("\n", ' ', htmlentities(stripslashes($sSqlExplain)));
        Event::run(
            'db.model.db.delete.sql',
            DTArrayObject::create()
                ->add_aKeyValue(
                    DTKeyValue::create()
                        ->set_sKey('sSqlExplain')
                        ->set_sValue($sSqlExplain)
                )
        );

        $oStmt = $this->oDbPDO->prepare($sSql);

        // bind Values
        foreach ($oDTArrayObject->get_aKeyValue() as $iKey => $oDTKeyValue)
        {
            $iPdoParam = 0;
            ('integer' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_INT : false;
            ('string' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR : false;
            ('object' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_STR: false;
            ('boolean' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_BOOL : false;
            ('null' === gettype($oDTKeyValue->get_sValue())) ? $iPdoParam = \PDO::PARAM_NULL : false;

            $oStmt->bindValue(
                ':' . $oDTKeyValue->get_sKey(),
                $oDTKeyValue->get_sValue(),
                $iPdoParam
            );
        }

        try
        {
            $bDelete = $oStmt->execute();
        }
        catch (\Exception $oExc)
        {
            Error::exception($oExc);

            return false;
        }

        return $bDelete;
    }

    /**
     * auto delete caches
     */
	public function __destruct()
    {
        \Cachix::autoDeleteCache();
    }
}
