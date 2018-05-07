<?php
namespace Bitsbybit\Math\Common\Data;

use Aws\Sdk as AwsSdk;
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
use Aws\DynamoDb\DynamoDbClient;

class DynamoDb
{
    /**
     * @var AwsSdk
     */
    private $sdk;

    /**
     * @var DynamoDbClient
     */
    private $dynamodb;

    /**
     * @var Marshaler
     */
    private $marshaler;

    public function __construct()
    {
        $this->sdk = new AwsSdk([
            'endpoint'   => 'http://localhost:8000',
            'region'   => 'us-west-2',
            'version'  => 'latest'
        ]);

        $this->dynamodb = $this->sdk->createDynamoDb();
        $this->marshaler = new Marshaler();
    }

    /**
     * @param array $params
     * @return bool
     * @throws ConfigException
     */
    public function createTable(array $params)
    {
        if( !isset($params['TableName']) ){
            throw new ConfigException("TableName is required to create a table.");
        }
        if( !isset($parmas['KeySchema']) ){
            throw new ConfigException("KeySchema is required to create a table.");
        }
        if( !isset($parmas['AttributeDefinitions']) ){
            throw new ConfigException("AttributeDefinitions is required to create a table.");
        }
        if( !isset($parmas['ProvisionedThroughput']) ){
            throw new ConfigException("ProvisionedThroughput is required to create a table.");
        }

        foreach( $params['KeySchema'] as $key ){
            if( !isset($key['AttributeName']) ){
                throw new ConfigException("AttributeName is required for a key.");
            }
            if( !isset($key['KeyType']) ){
                throw new ConfigException("KeyType is required for a key.");
            }
            if( !in_array($key['KeyType'],['HASH','RANGE']) ){
                throw new ConfigException("Invalid KeyType for key.");
            }
        }

        foreach( $params['AttributeDefinitions'] as $key ){
            if( !isset($key['AttributeName']) ){
                throw new ConfigException("AttributeName is required for a definition.");
            }
            if( !isset($key['AttributeType']) ){
                throw new ConfigException("AttributeType is required for a definition.");
            }
            if( !in_array($key['AttributeType'],['N','S']) ){
                throw new ConfigException("Invalid AttributeType for definition.");
            }
        }

        if( !isset($params['ProvisionedThroughput']['ReadCapacityUnits']) ){
            throw new ConfigException("ReadCapacityUnits is required to create a table.");
        }
        if( !isset($parmas['ProvisionedThroughput']['WriteCapacityUnits']) ){
            throw new ConfigException("WriteCapacityUnits is required to create a table.");
        }

        try {
            $result = $this->dynamodb->createTable($params);
            return $result['TableDescription']['TableStatus'];
        } catch (DynamoDbException $e) {
            return -1;
        }
    }

    /**
     * @param $tableName
     * @param $jsonFile
     * @return int
     */
    public function loadData($tableName, $jsonFile)
    {
        $items = json_decode(file_get_contents($jsonFile), true);

        foreach ($items as $item) {

            $json = json_encode($item);

            $params = [
                'TableName' => $tableName,
                'Item' => $this->marshaler->marshalJson($json)
            ];

            try {
                $this->dynamodb->putItem($params);
            } catch (DynamoDbException $e) {
                echo "Unable to add movie:\n";
                echo $e->getMessage() . "\n";
            }
        }

        return 0;
    }

    /**
     * @param $tableName
     * @param $item
     * @return int
     */
    public function createItem($tableName, $item)
    {
        $json = json_encode($item);
        $item = $this->marshaler->marshalJson($json);

        $params = [
            'TableName' => $tableName,
            'Item' => $item
        ];

        try {
            $this->dynamodb->putItem($params);
        } catch (DynamoDbException $e) {
            echo "Unable to add item:\n";
            echo $e->getMessage() . "\n";
        }
        return 0;
    }

    /**
     * @param $tableName
     * @param array $key
     * @return \Aws\Result|int
     */
    public function getItem($tableName, array $key)
    {
        $json = json_encode($key);
        $key = $this->marshaler->marshalJson($json);

        $params = [
            'TableName' => $tableName,
            'Key' => $key
        ];

        try {
            return $this->dynamodb->getItem($params);

        } catch (DynamoDbException $e) {
            echo "Unable to get item:\n";
            echo $e->getMessage() . "\n";
        }

        return 0;
    }

    public function updateItem($tableName, array $key, array $data)
    {
        $tableName = 'Movies';

        $year = 2015;
        $title = 'The Big New Movie';

        $key = $this->marshaler->marshalJson('
            {
                "year": ' . $year . ', 
                "title": "' . $title . '"
            }
        ');


        $eav = $this->marshaler->marshalJson('
            {
                ":r": 5.5 ,
                ":p": "Everything happens all at once.",
                ":a": [ "Larry", "Moe", "Curly" ]
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key,
            'UpdateExpression' =>
                'set info.rating = :r, info.plot=:p, info.actors=:a',
            'ExpressionAttributeValues'=> $eav,
            'ReturnValues' => 'UPDATED_NEW'
        ];

        try {
            $result = $this->dynamodb->updateItem($params);
            echo "Updated item.\n";
            print_r($result['Attributes']);

        } catch (DynamoDbException $e) {
            echo "Unable to update item:\n";
            echo $e->getMessage() . "\n";
        }
    }


    public function updateItemWhere()
    {
       $tableName = 'Movies';

        $year = 2015;
        $title = 'The Big New Movie';

        $key = $this->marshaler->marshalJson('
            {
                "year": ' . $year . ', 
                "title": "' . $title . '"
            }
        ');

        $eav = $this->marshaler->marshalJson('
            {
                ":num": 3
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key,
            'UpdateExpression' => 'remove info.actors[0]',
            'ConditionExpression' => 'size(info.actors) > :num',
            'ExpressionAttributeValues'=> $eav,
            'ReturnValues' => 'UPDATED_NEW'
        ];

        try {
            $result = $this->dynamodb->updateItem($params);
            echo "Updated item. ReturnValues are:\n";
            print_r($result['Attributes']);

        } catch (DynamoDbException $e) {
            echo "Unable to update item:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function incrementAtomicCounter()
    {
        $tableName = 'Movies';

        $year = 2015;
        $title = 'The Big New Movie';

        $key = $this->marshaler->marshalJson('
            {
                "year": ' . $year . ', 
                "title": "' . $title . '"
            }
        ');

        $eav = $this->marshaler->marshalJson('
            {
                ":val": 1
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key,
            'UpdateExpression' => 'set info.rating = info.rating + :val',
            'ExpressionAttributeValues'=> $eav,
            'ReturnValues' => 'UPDATED_NEW'
        ];

        try {
            $result = $this->dynamodb->updateItem($params);
            echo "Updated item. ReturnValues are:\n";
            print_r($result['Attributes']);

        } catch (DynamoDbException $e) {
            echo "Unable to update item:\n";
            echo $e->getMessage() . "\n";
        }
    }

    public function deleteItem()
    {
        $tableName = 'Movies';

        $year = 2015;
        $title = 'The Big New Movie';

        $key = $this->marshaler->marshalJson('
            {
                "year": ' . $year . ', 
                "title": "' . $title . '"
            }
        ');

        $eav = $this->marshaler->marshalJson('
            {
                ":val": 5 
            }
        ');

        $params = [
            'TableName' => $tableName,
            'Key' => $key,
            'ConditionExpression' => 'info.rating <= :val',
            'ExpressionAttributeValues'=> $eav
        ];

        try {
            $result = $this->dynamodb->deleteItem($params);
            echo "Deleted item.\n";

        } catch (DynamoDbException $e) {
            echo "Unable to delete item:\n";
            echo $e->getMessage() . "\n";
        }
    }
}