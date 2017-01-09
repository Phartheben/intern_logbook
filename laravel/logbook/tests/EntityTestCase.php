<?php

class EntityTestCase extends TestCase
{
    protected function getMethods($className, $excludes = [])
    {
        if (is_string($className)) {
            $class = new $className;
        } else {
            $class = $className;
        }

        $methods = array_diff(get_class_methods($class), get_class_methods(get_parent_class($class)));
        $methods = array_diff($methods, $excludes);

        return $methods;
    }

    protected function validateTestSuite($className, $excludes = [])
    {
        $this->className = $className;
        $this->excludes  = $excludes;

        if (is_string($className)) {
            $class = new $className;
        } else {
            $class = $className;
        }

        $this->model       = $class;
        $this->tableFields = \DB::select("DESC ".$this->model->getTable());

        // assert primary key
        $this->assertPrimaryKey();

        // assert default values
        $this->assertTableDefaultValues();

        // assert timesatamps
        $this->assertTimestamps();

        // ---- assert methods
        // $this->assertMethods();
    }

    protected function assertPrimaryKey()
    {
        $fields = $this->tableFields;

        $keyFields = array_where($fields, function ($key, $value) {
            return $value->Key == 'PRI';
        });

        $autoIncrementFields = array_where($fields, function ($key, $value) {
            return $value->Key == 'PRI' && $value->Extra == 'auto_increment';
        });

        $modelId = $this->model->getKeyName();

        if (count($autoIncrementFields) == 1) {
            $tableId = array_get($autoIncrementFields, 0)->Field;

            $this->assertEquals($tableId, $modelId,
                sprintf("%s should set \$primaryKey = %s",
                    get_class($this->model),
                    $tableId)
                );

            $this->assertTrue($this->model->getIncrementing(),
                sprintf("%s should set \$incrementing = true", get_class($this->model))
                );
        } else {
            if (count($keyFields) == 1) {
                $tableId = array_get($keyFields, 0)->Field;

                $this->assertEquals($tableId, $modelId,
                    sprintf("%s should set \$primaryKey = %s",
                        get_class($this->model),
                        $tableId
                    ));

                $this->assertFalse($this->model->getIncrementing(),
                    sprintf("%s should set \$incrementing = false", get_class($this->model))
                    );
            } else {
                $this->assertNull($modelId,
                    sprintf("%s should set \$primaryKey = null", get_class($this->model))
                    );

                $this->assertFalse($this->model->getIncrementing(),
                    sprintf("%s should set \$incrementing = false", get_class($this->model))
                    );
            }
        }
    }

    protected function assertTableDefaultValues()
    {
        $fields = $this->tableFields;

        // filter only fields with value
        $defaults = [];
        foreach ($fields as $field) {
            if ($field->Default !== null) {
                $defaults[$field->Field] = $field->Default;
            }
        }

        $attributes = $this->model->getAttributes();

        ksort($defaults);
        ksort($attributes);
        $this->assertEquals($defaults, $attributes, 'Failed asserting model attributes');
    }

    protected function assertTimestamps()
    {
        $fields = $this->tableFields;

        $timestampFields = array_where($fields, function ($key, $value) {
            return in_array($value->Field, ['create_at', 'update_at']);
        });

        if (count($timestampFields) == 2) {
            $this->assertTrue($this->model->usesTimestamps(),
                sprintf("%s should set \$timestamps = true", get_class($this->model))
                );
        } else {
            $this->assertFalse($this->model->usesTimestamps(),
                sprintf("%s should set \$timestamps = false", get_class($this->model))
                );
        }
    }

    protected function assertMethods()
    {
        $methods = $this->getMethods($this->model, $this->excludes);

        // check date setter/getter
        $dates = array_diff($this->model->getDates(), ['create_at', 'update_at']);

        foreach ($dates as $date) {
            // getter
            $methodName = 'get'.studly_case($date).'Attribute';

            $this->assertTrue(in_array($methodName, $methods), $methodName.' date getter not defined');
            $methods = array_diff($methods, [$methodName]);

            // setter
            $methodName = 'set'.studly_case($date).'Attribute';

            $this->assertTrue(in_array($methodName, $methods), $methodName.' date setter not defined');
            $methods = array_diff($methods, [$methodName]);
        }

        // check for test method
        $testMethod = array_diff(get_class_methods($this), get_class_methods(get_parent_class($this)));
        foreach ($methods as $method) {
            $methodName = 'test'.studly_case($method);

            $this->assertTrue(in_array($methodName, $testMethod), $methodName.' not defined');
        }
    }
}
