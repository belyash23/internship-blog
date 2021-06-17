<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:@app/blog.db',
    'tablePrefix' => 'tbl_',

    // Schema cache options (for production environment)
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
];
