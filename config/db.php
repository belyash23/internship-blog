<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:@app/blog.db',
    'tablePrefix' => 'tbl_',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
