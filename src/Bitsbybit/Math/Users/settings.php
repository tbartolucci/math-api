<?php
return [
    'dynamoTable' => getenv('dynamo_table_name'),
    'cognitoPoolId' => getenv('cognito_app_client_id')
];
