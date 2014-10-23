<?php

namespace Didya\Whoops;

use \Didya\SuggestionFinder;
use \Whoops\Handler\Handler;

/**
 * Wraps Didya's behavior around Whoops as the underlying
 * error handler. An instance of this class can be provided
 * to Whoops as an exception handler.
 *
 * @see \Whoops\Handler\Handler
 */
class ExceptionHandler extends Handler
{
    /**
     * @var \Didya\SuggestionFinder
     */
    protected $suggestionFinder;

    /**
     * @param \Didya\SuggestionFinder $finder
     */
    public function __construct(SuggestionFinder $finder)
    {
        parent::__construct();
        $this->suggestionFinder = $finder;
    }

    /**
     * @see \Whoops\Handler\Handler::handle
     */
    public function handle()
    {
        $inspector = $this->getInspector();
        $exception = $inspector->getException();

        $this->suggestionFinder->suggestForException($exception);
    }
}
