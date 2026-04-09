<?php

namespace App\Services;

/**
 * GroqService — generates social media captions using the Groq API.
 *
 * Required .env:
 *   GROQ_API_KEY=
 *   GROQ_MODEL=llama3-8b-8192   (or any supported Groq model)
 */
class GroqService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.groq.key', '');
        $this->model  = config('services.groq.model', 'llama3-8b-8192');
    }

    /**
     * Generate an Instagram/Facebook caption for a post.
     *
     * @param  string  $title    Article title
     * @param  string  $excerpt  Article excerpt
     * @return string  Generated caption, or empty string on failure
     */
    public function generateCaption(string $title, string $excerpt): string
    {
        // TODO: implement Groq API call
        return '';
    }
}
