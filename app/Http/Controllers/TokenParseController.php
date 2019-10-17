<?php

namespace App\Http\Controllers;

class TokenParseController
{
    /**
     * @var $parser
     */
    private $parser;
    
    /**
     * Create a new TokenParseController object.
     *
     * @param object $parser
     *
     * @return void
     */
    public function __construct($parser)
    {
        $this->parser = $parser;
    }
    
    /**
     * Get user's id form JWT token.
     *
     * @param string $token
     *
     * @return int|string
     */
    public function getIdFromToken(string $token)
    {
        return $this->parser->parse($token)->getClaim('sub');
    }
}
