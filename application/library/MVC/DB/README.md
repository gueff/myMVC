
# myMVC_module_DB

- [1. Requirements](#1)
- [2. Repository](#2)
- [3. Creation](#3)
  - [3.1. Create DB Config](#3-1)
  - [3.2. Creating a concrete Table Class](#3-2)
  - [3.3. Creating a DBInit class that is used for each DB access](#3-3)
  - [3.4. Let generate an openapi yaml schema file for data type classes](#3-4)
- [4. Usage](#4)
  - [4.1. create](#4-1)
  - [4.2. retrieve](#4-2)
  - [4.3. update](#4-3)
  - [4.4. delete](#4-4)
  - [4.5. count](#4-5)
  - [4.6. checksum](#4-6)
  - [4.7. getFieldInfo](#4-7)
  - [4.8. SQL](#4-8)
- [5. Events](#5)
  - [5.1. Logging SQL](#5-1)

---

<a id="1"></a>

## 1. Requirements

- Linux
- php >= 8
  - `pdo` extension
- myMVC 3.x
  - `git clone --branch 3.x https://github.com/gueff/myMVC.git myMVC_3.x`
  - Docs: <https://mymvc.ueffing.net/>
  - github: <https://github.com/gueff/myMVC/tree/3.3.x>

---

<a id="2"></a>

## 2. Repository

- <https://github.com/gueff/myMVC_module_DB>

---

<a id="3"></a>

## 3. Creation

<a id="3-1"></a>

### 3.1. Create DB Config


In your main module's config folder create your DB Config.
(@see https://mymvc.ueffing.net/3.3.x/configuration#Modules-config-folder)


_Db Config example for `develop` environments_
~~~php
//-------------------------------------------------------------------------------------
// Module DB

$aConfig['MODULE']['DB'] = array(

    'db' => array(
        'type' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'username' => getenv('db.username'),
        'password' => getenv('db.password'),
        'dbname' => getenv('db.dbname'),
        'charset' => 'utf8'
    ),
    'caching' => array(
        'enabled' => true,
        'lifetime' => '7200'
    ),
    'logging' => array(
        'log_output' => 'FILE',

        // consider to turn it on for develop and test environments only
        'general_log' => strtoupper('on'), # on | off

        // 1) make sure write access is given to the folder
        // as long as the db user is going to write and not the webserver user
        // 2) consider a logrotate mechanism for this logfile as it may grow quickly
        'general_log_file' => '/tmp/' . getenv('db.dbname') . '.log',
    )
);
~~~
- here we make use of `getenv()`, which means we store our secrets in the `/.env` file.


<a id="3-2"></a>

### 3.2. Creating a concrete Table Class

_PHP Class_
as a Representation of the DB Table


_file: `modules/Foo/Model/Table/User.php`_
~~~php
<?php

namespace Foo\Model\Table;

use DB\Model\Db;


class User extends Db
{
    /**
     * @var array
     */
    protected $aField = array(
        'email'     => "varchar(255) COLLATE utf8_general_ci NOT NULL",
        'active'    => "int(1) DEFAULT '0' NOT NULL",
        'uuid'      => "varchar(36) COLLATE utf8_general_ci COMMENT 'uuid permanent' NOT NULL",
        'uuidtmp'      => "varchar(36) COLLATE utf8_general_ci COMMENT 'uuid; changes on create|login' NOT NULL",
        'password'  => "varchar(60) COLLATE utf8_general_ci COMMENT 'password_hash()' NOT NULL",
        'nickname'  => "varchar(10) COLLATE utf8_general_ci NOT NULL",
        'forename'  => "varchar(25) COLLATE utf8_general_ci NOT NULL",
        'lastname'  => "varchar(25) COLLATE utf8_general_ci NOT NULL",
    );

    /**
     * @param array $aDbConfig
     * @throws \ReflectionException
     */
    public function __construct(array $aDbConfig = array())
    {
        // basic creation of the table
        parent::__construct(
            $this->aField,
            $aDbConfig
        );
    }
}
~~~

- creates the Table `FooModelTableUser`
  - Table has several fields from `email` ... `lastname` as declared in property `$aField`
    - 🛈 The Table fields `id`, `stampChange` and `stampCreate` are added automatically
    - do not add these fields by manually
- generates a DataType Class `DataType/DTFooModelTableUser.php`

---

**Creating a Table and adding a Foreign Key**


_file: `modules/Foo/Model/Table/User.php`_
~~~php
<?php

namespace Foo\Model\Table;

use DB\Model\Db;
use DB\DataType\DB\Foreign;

class User extends Db
{
    /**
     * @var array
     */
    protected $aField = array(
        'email'     => "varchar(255) COLLATE utf8_general_ci NOT NULL",
        'active'    => "int(1) DEFAULT '0' NOT NULL",
        'uuid'      => "varchar(36) COLLATE utf8_general_ci COMMENT 'uuid permanent' NOT NULL",
        'uuidtmp'      => "varchar(36) COLLATE utf8_general_ci COMMENT 'uuid; changes on create|login' NOT NULL",
        'password'  => "varchar(60) COLLATE utf8_general_ci COMMENT 'password_hash()' NOT NULL",
        'nickname'  => "varchar(10) COLLATE utf8_general_ci NOT NULL",
        'forename'  => "varchar(25) COLLATE utf8_general_ci NOT NULL",
        'lastname'  => "varchar(25) COLLATE utf8_general_ci NOT NULL",
    );

    /**
     * @param array $aDbConfig
     * @throws \ReflectionException
     */
    public function __construct(array $aDbConfig = array())
    {
        // basic creation of the table
        parent::__construct(
            $this->aField,
            $aDbConfig
        );
        $this->setForeignKey(
            Foreign::create()
                ->set_sForeignKey('id_FooModelTableGroup')
                ->set_sReferenceTable('FooModelTableGroup')
        );
    }
}
~~~

- creates the Table `FooModelTableUser`
  - Table has several fields from `email` ... `lastname` as declared in property `$aField`
    - 🛈 The Table fields `id`, `stampChange` and `stampCreate` are added automatically
    - do not add these fields by manually
- The foreign key `id_FooModelTableGroup` -pointing to table `FooModelTableGroup`- is added by method `setForeignKey()`
- generates a DataType Class `DataType/DTFooModelTableUser.php`

---

<a id="3-3"></a>

### 3.3. Creating a DBInit class that is used for each DB access


_file: `modules/Foo/Model/DB.php`_
~~~php
<?php

/**
 * - register your db table classes as static properties.
 * - add a doctype to each static property
 * - these doctypes must contain the vartype information about the certain class
 * @example
 *      @var Foo\Model\Table\User
 *      public static $oFooModelTableUser;
 * ---
 * [!]  it is important to declare the vartype expanded with a full path
 *      avoid to make use of `use ...` support
 *      otherwise the classes could not be read correctly
 */

namespace Foo\Model;

use DB\Model\DbInit;
use DB\Trait\DbInitTrait;

class DB extends DbInit
{
    use DbInitTrait;

    /**
     * @var \Foo\Model\Table\User
     */
    public static $oFooModelTableUser;
}
~~~

---

<a id="3-4"></a>

### 3.4. Let generate an openapi yaml schema file for data type classes

create a file `db.php` (you can name it as you like) in the event folder of your myMVC module and declare the bindings as follows.

_file `/modules/{MODULE}/etc/event/db.php`_
~~~php
<?php

\MVC\Event::processBindConfigStack([

    // let create an openapi yaml file
    // according to DB Table DataType Classes
    // when the DataBase Tables setup changes
    'db.model.db.construct.saveCache' => array(
        function(string $sTableName = '') {

            // one-timer
            if (false === \MVC\Registry::isRegistered('DB::openapi'))
            {
                \MVC\Registry::set('DB::openapi', true);

                // generate /modules/{MODULE}/DataType/DTTables.yaml
                $sYamlFile =\DB\Model\Openapi::createDTYamlOnDTClasses(
                    // pass instance of your concrete DB Class
                    \Foo\Model\DB::init()
                );
            }
        }
    ),
]);
~~~

---

<a id="4"></a>

## 4. Usage


In your main **Controller** class just create a new Instanciation of your DBInit class.
A good place is the `__construct()` method.

~~~php
namespace Foo\Controller;

use Foo\Model\DB;

public function __construct ()
{
    DB::init();
}
~~~

after that you can access your TableClass from everywhere - even from frontend templates:


_Usage_
~~~php
DB::$oFooModelTableUser->...<method>...
~~~

<a id="4-1"></a>

### 4.1. create

_`create` (INSERT)_
therefore an object of its related Datatype must be instaciated and given to the method `create`.
Here e.g. with Datatype "DTFooModelTableUser" to TableClass "modules/Foo/Model/DB/TableUser":

~~~php
DB::$oFooModelTableUser->create(
    DTFooModelTableUser::create()
        ->set_id_FooModelTableGroup(1)
        ->set_uuid(Strings::uuid4())
        ->set_email('foo@example.com')
        ->set_forename('foo')
        ->set_lastname('bar')
        ->set_nickname('foo')
        ->set_password(password_hash('...password...', PASSWORD_DEFAULT))
        ->set_active(1)
        ->set_stampChange(date('Y-m-d H:i:s'))
        ->set_stampCreate(date('Y-m-d H:i:s'))
);
~~~


<a id="4-2"></a>

#### 4.2. retrieve

`retrieveTupel` asks for a specific Tupel and returns the DataType Object according to the requested Table.


_`retrieveTupel` - identified by `id`_
~~~php
/** @var \Foo\DataType\DTFooModelTableUser $oDTFooModelTableUser */
$oDTFooModelTableUser = DB::$oFooModelTableUser->retrieveTupel(
    DTFooModelTableUser::create()
        ->set_id(2)
)
~~~
- get User Object whose id=2


`retrieve` returns an array of DataType Objects according to the requested Table.

_`retrieve`: get all Datasets_
~~~php
/** @var \Foo\DataType\DTFooModelTableUser[] $aDTFooModelTableUser */
$aDTFooModelTableUser = DB::$oFooModelTableUser->retrieveTupel();
~~~

_`retrieve`: get specific Datasets_
~~~php
/** @var \Foo\DataType\DTFooModelTableUser[] $aDTFooModelTableUser */
$aDTFooModelTableUser = DB::$oFooModelTableUser->retrieve(
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('stampChange')
                ->set_mOptional1('LIKE')
                ->set_sValue('2021-06-19')
            );
);
~~~

_`retrieve`: get Datasets with sort order_
~~~php
/** @var \Foo\DataType\DTFooModelTableUser[] $aDTFooModelTableUser */
$aDTFooModelTableUser = DB::$oFooModelTableUser->retrieve(
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('email')
                ->set_mOptional1('LIKE')
                ->set_sValue('%@example.com%')
        ),
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sValue('ORDER BY id ASC')
        )
);
~~~

_`retrieve`: get first 30 Datasets (LIMIT 0,30)_
~~~php
/** @var \Foo\DataType\DTFooModelTableUser[] $aDTFooModelTableUser */
$aDTFooModelTableUser = DB::$oFooModelTableUser->retrieve(
    null,
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sValue('LIMIT 0,30')
        )
)
~~~


<a id="4-3"></a>

#### 4.3. update


_`updateTupel`: update a specific Tupel - identified by `id`_
~~~php
// get Tupel
/** @var \Foo\DataType\DTFooModelTableUser $oDTFooModelTableUser */
$oDTFooModelTableUser = DB::$oFooModelTableUser->retrieveTupel(
    DTFooModelTableUser::create()->set_id(2)
)

// modify Tupel
$oDTFooModelTableUser->set_nickname('XYZ');

// update Tupel
/** @var boolean $bSuccess */
$bSuccess = DB::$oFooModelTableUser->updateTupel(
    $oDTFooModelTableUser
);
~~~
- the equivalent dataset tupel with object's `id` will be updated.

_`update`: update all Tupel which are affected by the where clause_
~~~php
/** @var boolean $bSuccess */
$bSuccess = DB::$oFooModelTableUser->update(
    DTFooModelTableUser::create()
        ->set_active('1'),
    // where
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('active')
                ->set_mOptional1('=')
                ->set_sValue('0')
        )
);
~~~


<a id="4-4"></a>

#### 4.4. delete

_`deleteTupel`: delete this specific Tupel - identified by `id`_
~~~php
/** @var boolean $bSuccess */
$bSuccess = DB::$oFooModelTableUser->deleteTupel(
    DTFooModelTableUser::create()
        ->set_id(2)
)
~~~

_`delete`: delete all Tupel which are affected by the where clause_
~~~php
$bSuccess = DB::$oFooModelTableUser->delete(
    // where
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('stampCreate')
                ->set_mOptional1('<')
                ->set_sValue('2023-06-19 00:00:00')
        )
);
~~~

<a id="4-5"></a>

### 4.5. count

~~~php
// Amount of all Datasets
$iAmount = DB::$oFooModelTableUser->count();

// Amount of specific Datasets
$iAmount = DB::$oFooModelTableUser->count(
    DTArrayObject::create()
        ->add_aKeyValue(
            DTKeyValue::create()
                ->set_sKey('stampChange')
                ->set_mOptional1('=')
                ->set_sValue('2021-06-19')
    )
);
~~~

<a id="4-6"></a>

### 4.6. checksum

~~~php
// Returns a checksum of the table
$iChecksum = DB::$oFooModelTableUser->checksum();
~~~

<a id="4-7"></a>

### 4.7. getFieldInfo

returns array with table fields info

~~~php
$aFieldInfo = DB::$oFooModelTableUser->getFieldInfo();
~~~

_example return_

~~~
// type: array, items: 9
[
    'id_FooModelTableGroup' => [
        'Field' => 'id_FooModelTableGroup',
        'Type' => 'int(11)',
        'Null' => 'YES',
        'Key' => 'MUL',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'int',
    ],
    'email' => [
        'Field' => 'email',
        'Type' => 'varchar(255)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'string',
    ],
    'active' => [
        'Field' => 'active',
        'Type' => 'int(1)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => '0',
        'Extra' => '',
        'php' => 'int',
    ],
    'uuid' => [
        'Field' => 'uuid',
        'Type' => 'varchar(36)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'string',
    ],
    'uuidtmp' => [
        'Field' => 'uuidtmp',
        'Type' => 'varchar(36)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'string',
    ],
    'password' => [
        'Field' => 'password',
        'Type' => 'varchar(60)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'string',
    ],
    'nickname' => [
        'Field' => 'nickname',
        'Type' => 'varchar(10)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'string',
    ],
    'forename' => [
        'Field' => 'forename',
        'Type' => 'varchar(25)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'string',
    ],
    'lastname' => [
        'Field' => 'lastname',
        'Type' => 'varchar(25)',
        'Null' => 'NO',
        'Key' => '',
        'Default' => NULL,
        'Extra' => '',
        'php' => 'string',
    ],
]
~~~

<a id="4-8"></a>

#### 4.8. SQL

_`SQL` example using `$oPDO` query .. fetch_
~~~php
/**
 * @return \Foo\DataType\DTFooModelTableUser
 * @throws \ReflectionException
 */
public function getUserObject()
{
    // get result & cast to datatype object
    $oDTFooModelTableUser = DTFooModelTableUser::create(
        (array) DB::$oPDO
            ->query("SELECT * FROM `FooModelTableUser` WHERE `id` = '1'")
            ->fetch(\PDO::FETCH_ASSOC)
    );
    
    return $oDTFooModelTableUser
}
~~~
~~~
// type: object
\Foo\DataType\DTFooModelTableUser::__set_state(array(
      'id' => 1,
      'stampChange' => '2023-09-28 10:18:03',
      'stampCreate' => '2023-09-28 10:16:14',
      'id_TableGroup' => 1,
      'email' => 'admin@example.com',
      'active' => 1,
      'uuid' => '8b838038-5dd7-11ee-8620-2cf05d0841fd',
      'uuidtmp' => '8b838839-5dd7-11ee-8620-2cf05d0841fd',
      'password' => '*******************************************',
      'nickname' => 'admin',
      'forename' => 'foo',
      'lastname' => 'bar',
))
~~~

_`SQL` example using `$oPDO` query .. fetchAll_
~~~php
/**
 * @return array|\Foo\DataType\DTFooModelTableUser[]
 * @throws \ReflectionException
 */
public function getUserObjectsArray()
{
    // get result & cast all results to datatype objects
    $aDTFooModelTableUser = array_map(
        function($aData){
            return DTFooModelTableUser::create($aData);
        },
        (array) DB::$oPDO
            ->query("SELECT * FROM `FooModelTableUser` WHERE `active` = '1'")
            ->fetchAll(\PDO::FETCH_ASSOC)
    );
    
    return $aDTFooModelTableUser
}
~~~
~~~
// type: array, items: 2
[
    0 => [
    \Foo\DataType\DTFooModelTableUser::__set_state(array(
          'id' => 1,
          'stampChange' => '2023-09-28 10:18:03',
          'stampCreate' => '2023-09-28 10:16:14',
          'id_TableGroup' => 1,
          'email' => 'admin@example.com',
          'active' => 1,
          'uuid' => '8b838038-5dd7-11ee-8620-2cf05d0841fd',
          'uuidtmp' => '8b838839-5dd7-11ee-8620-2cf05d0841fd',
          'password' => '*******************************************',
          'nickname' => 'admin',
          'forename' => 'foo',
          'lastname' => 'bar',
    )],
    1 => [
    \Foo\DataType\DTFooModelTableUser::__set_state(array(
          'id' => 2,
          'stampChange' => '2023-09-28 10:18:03',
          'stampCreate' => '2023-09-28 10:16:14',
          'id_TableGroup' => 1,
          'email' => 'foo@example.com',
          'active' => 1,
          'uuid' => '1b838038-5dd7-11ee-8620-2cf05d0841fd',
          'uuidtmp' => '2b838839-5dd7-11ee-8620-2cf05d0841fd',
          'password' => '*******************************************',
          'nickname' => 'foo',
          'forename' => 'foo2',
          'lastname' => 'bar2',
    )],
]
~~~

---

<a id="5"></a>

## 5. Events

~~~text
db.model.db.construct.saveCache
db.model.db.setSqlLoggingState.exception
db.model.db.setForeignKey.exception
db.model.db.checkIfTableExists.exception
db.model.db.createTable.exception
db.model.db.synchronizeFields.exception
db.model.db.synchronizeFields.delete.exception
db.model.db.synchronizeFields.insert.exception
db.model.db.synchronizeFields.update.exception
db.model.db.create.before
db.model.db.create.sql
db.model.db.createTable.sql
db.model.db.insert.sql
db.model.db.create.exception
db.model.db.create.after
db.model.db.retrieve.sql
db.model.db.retrieve.exception
db.model.db.count.sql
db.model.db.count.exception
db.model.db.update.sql
db.model.db.update.exception
db.model.db.delete.sql
db.model.db.delete.exception
~~~

<a id="5-1"></a>

### 5.1. Logging SQL

you can log SQL queries by listening to events.

create a file `sql.php` in the event folder of your myMVC module
and declare the bindings as follows.

_`/modules/{MODULE}/etc/event/sql.php`_
~~~php
#-------------------------------------------------------------
# declare bindings

$aEvent = [
    'db.model.db.create.sql' => array(
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write($oDTArrayObject->getDTKeyValueByKey('sSql')->get_sValue(), 'sql.log');
        }
    ),
    'db.model.db.insert.sql' => array(
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write($oDTArrayObject->getDTKeyValueByKey('sSql')->get_sValue(), 'sql.log');
        }
    ),
    'db.model.db.retrieve.sql' => array(
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write($oDTArrayObject->getDTKeyValueByKey('sSql')->get_sValue(), 'sql.log');
        }
    ),
    'db.model.db.update.sql' => array(
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write($oDTArrayObject->getDTKeyValueByKey('sSql')->get_sValue(), 'sql.log');
        }
    ),
    'db.model.db.delete.sql' => array(
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write($oDTArrayObject->getDTKeyValueByKey('sSql')->get_sValue(), 'sql.log');
        }
    ),
    'db.model.db.createTable.sql' => array(
        function(\MVC\DataType\DTArrayObject $oDTArrayObject) {
            \MVC\Log::write($oDTArrayObject->getDTKeyValueByKey('sSql')->get_sValue(), 'sql.log');
        }
    ),
];

#-------------------------------------------------------------
# process: bind the declared ones

\MVC\Event::processBindConfigStack($aEvent);
~~~
