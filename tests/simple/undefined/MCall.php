<?php

namespace Tests\Simple\Undefined;

class MCall
{
    /**
     * @return mixed
     */
    public function a()
    {
        return $this->b();
    }

    /**
     * @return mixed
     */
    public function c()
    {
        return $this->a();
    }

    /**
     * @param $var1
     * @return mixed
     */
    public function testMethodWithOneRequiredParameter($var1)
    {
        return $var1 + 1;
    }

    /**
     * @param $var1
     * @return bool
     */
    public function testMethodWithOneRequiredParameterWithoutUsing($var1)
    {
        return true;
    }

    /**
     * @return string
     */
    public function testSuccessProperty()
    {
        $property = new Property();
        return $property->b();
    }

    /**
     * @return mixed
     */
    public function testCallFromUnusedVariable()
    {
        return $unusedVariable->b();
    }
}
