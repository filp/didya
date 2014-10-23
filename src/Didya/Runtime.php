<?php

namespace Didya;

use \Didya\Whoops\ExceptionHandler;
use \Whoops\Run;

class Runtime
{
    /**
     * @var \Whoops\Run
     */
    protected $whoops;

    /**
     * Installs this instance as an error handler for Didya-related
     * things. Assumes this method has not been called before, and
     * no other instance is already installed.
     */
    public function install()
    {
        $this->setupWhoops();
    }

    /**
     * Returns the instance of Whoops used internally by
     * Didya.
     *
     * @return \Whoops\Run
     */
    public function getWhoopsInstance()
    {
        return $this->whoops;
    }

    /**
     * Sets up the suggestion finder instance that'll be passed to
     * the underlying error handler.
     *
     * @return \Didya\SuggestionFinder
     */
    protected function setupSuggestionFinder()
    {
      return new SuggestionFinder;
    }

    /**
     * Sets up an instance of Whoops.
     *
     * Didya uses Whoops internally to capture errors and analyze them.
     *
     * @return \Whoops\Run
     */
    protected function setupWhoops()
    {
        $this->whoops = new \Whoops\Run;
        $this->whoops->pushHandler($this->setupHandler());

        // Do not allow this instance of whoops to quit execution,
        // in case there's additional error handling setup.
        $this->whoops->allowQuit(false);
        $this->whoops->sendHttpCode(false);

        return $this->whoops->register();
    }

    /**
     * Instantiates the ExceptionHandler used by Whoops to
     * handle errors and exceptions.
     *
     * @return \Didya\Whoops\ExceptionHandler
     */
    protected function setupHandler()
    {
        return new ExceptionHandler($this->setupSuggestionFinder());
    }

    /**
     * Sets up a Didya instance to handle the errors we're interested in.
     *
     * @return \Didya\Runtime
     */
    public static function install()
    {
        $didya = new self();
        $didya->install();

        return $didya;
    }
}
