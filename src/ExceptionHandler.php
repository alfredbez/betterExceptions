<?php

namespace AlfredBez\BetterExceptions;

class ExceptionHandler {
    public function getTraceAsString(\Exception $exception) {
        $trace = '';
        $count = 0;
        foreach ($exception->getTrace() as $frame) {
            $args = [];
            if (isset($frame['args'])) {
                foreach ($frame['args'] as $arg) {
                    if (is_string($arg)) {
                        $args[] = "'$arg'";
                    } elseif (is_array($arg)) {
                        $args[] = 'Array';
                    } elseif ($arg === null) {
                        $args[] = 'NULL';
                    } elseif (is_bool($arg)) {
                        $args[] = $arg ? 'true' : 'false';
                    } elseif (is_object($arg)) {
                        $args[] = get_class($arg);
                    } elseif (is_resource($arg)) {
                        $args[] = get_resource_type($arg);
                    } else {
                        $args[] = $arg;
                    }
                }
            }
            $args = implode(', ', $args);
            $trace .= sprintf( "#%s %s(%s): %s(%s)\n",
                                     $count,
                                     $frame['file'],
                                     $frame['line'],
                                     $frame['function'],
                                     $args );
            $count++;
        }

        return $trace;
    }
}
