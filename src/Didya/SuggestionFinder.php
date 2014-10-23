<?php

namespace Didya;

use \Exception;

/**
 * Analyzes an exception and detects if the user has possibly
 * made a spelling mistake for a function, method, variable
 * or constant name.
 */
class SuggestionFinder
{
    /**
     * The name of the property containing the exception message.
     */
    const MESSAGE_PROP = "message";

    /**
     * @param Exception $exception
     */
    public function suggestForException(Exception $exception)
    {
        // If this exception is not of the kind we care about, bail out
        if (!$this->isPossibleToSuggest($exception)) {
          return false;
        }

        $this->hijackExceptionMessage(
          $exception, "Something clever will eventually be here."
        );
    }

    /**
     * Uses reflection to hijack the message for the given exception,
     * appending the value given in the $append argument.
     *
     * @param Exception $exception
     * @param string $append
     * @return string The new exception message
     */
    protected function hijackExceptionMessage(Exception $exception, $append)
    {
        // oh no
        $reflectionClass = new ReflectionClass($exception);
        $reflectionProp = $reflectionClass->getProperty(self::MESSAGE_PROP);

        // Modify the message content:
        $reflectionProp->setAccessible(true);

        $reflectionProp->setValue(
          $exception, $exception->getMessage() . "\n$append"
        );

        $reflectionProp->setAccessible(false);

        return $exception->getMessage();
    }

    /**
     * Check if the given Exception is one of a kind for which
     * suggestions can be provided - undefined function, variable, etc.
     *
     * @param Exception $exception
     * @return bool
     */
    protected function isPossibleToSuggest(Exception $exception)
    {
        // TODO: Use string matching to verify if its a thing we care about?
        //       Seems kinda dodgy, but I cannot find any other way to detect
        //       exactly what kind of error we're dealing with. Sigh.

        return true;
    }
}
