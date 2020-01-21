<?php

use AlfredBez\BetterExceptions\ExceptionHandler;
use PHPUnit\Framework\TestCase;

class ExceptionHandlerTest extends TestCase {

    protected function throwDummyException($dummyArgument)
    {
        throw new Exception();
    }

    public function testExceptionShowsFullParameters()
    {
        $argumentToCheck = 'This is a very long argument which should be cropped';
        try {
            $this->throwDummyException($argumentToCheck);
        } catch (Exception $exception) {
            $handler = new ExceptionHandler();
            $stacktrace = $handler->getTraceAsString($exception);

            $this->assertStringContainsString($argumentToCheck, $stacktrace);

            $standardStacktrace = $exception->getTraceAsString();
            $this->assertStringNotContainsString($argumentToCheck, $standardStacktrace);
        }
    }

    /**
     * @dataProvider variousDatatypesProvider
     */
    public function testWorksWithVariousDatatypes($argumentToCheck, $expectedString)
    {
        try {
            $this->throwDummyException($argumentToCheck);
        } catch (Exception $exception) {
            $handler = new ExceptionHandler();
            $stacktrace = $handler->getTraceAsString($exception);
            $stacktrace = substr($stacktrace, 0, strpos($stacktrace, '#1'));

            $this->assertStringContainsString($expectedString, $stacktrace);
        }
    }

    public function variousDatatypesProvider()
    {
        return [
            'true' => [true, 'true'],
            'false' => [false, 'false'],
            'array' => [[1, 2, 3], 'Array'],
            'null' => [null, 'NULL'],
            'class' => [new stdClass(), stdClass::class],
            'resource' => [tmpfile(), 'stream'],
            'float' => [123.12, '123.12'],
            'int' => [123, '123'],
        ];
    }
}
